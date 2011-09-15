<?php

require('Zend/Loader/Autoloader.php');
$loader = Zend_Loader_Autoloader::getInstance();

class Model extends Zend_Db_Table_Abstract {
    public function __construct(){
        $this->_config = new Zend_Config_Ini('cli.ini', 'config');
        $this->_db = Zend_Db::factory($this->_config->resources->db);
        parent::__construct($this->_db);
    }
}

class Postulacion extends Model {
    protected $_name = 'postulacion';
}

class Aviso extends Model {
    protected $_name = 'aviso';
}

class Posstulante extends Model {
    protected $_name = 'postulante';
}


class CLI {
    const MIDDLE_TABLES = 15;
    const ROWS_IN_MIDDLE_TABLES = 500;
    const ECHO_MODE = false;
    const MYSQL_ENGINE = 'MyISAM';
    const POSTULANTE = 'postulante';
    const AVISO = 'aviso';
    const POSTULACION = 'postulacion';
    const AVG_POSTUL_X_AVISO = 100;
    const MYSQL_BIN = "c:\\wamp\\bin\\mysql\\mysql5.5.8\\bin\\mysql.exe";

    // query mode
    const QMODE_ZEND_DB = 1;
    const QMODE_INIT_BATCH = 2;
    const QMODE_ADD_BATCH_LINE = 4;
    const QMODE_CLOSE_BATCH = 8;
    const BATCH_FILENAME = 'batch.sql';

    protected $_config;
    protected $_db;
    protected $_masks = array(
        self::AVISO => "Se requiere \"%s\"",
        self::POSTULANTE => '%s'
    );
    protected $_nrows = array(
        self::AVISO => 100, // 50000
        self::POSTULANTE => 500 // 50000
    );
    protected $_cache_values = array();
    protected $_middle_table_field_list;
    protected $_np;  // # postulaciones a realizadas
    protected $_fp;  // # file handler

    public function __construct() {
        $this->_config = new Zend_Config_Ini('cli.ini', 'config');
        $this->_db = Zend_Db::factory($this->_config->resources->db);
        $this->_np = $this->_nrows[self::AVISO] * self::AVG_POSTUL_X_AVISO;
    }

    public function main() {
        $allowed_commands = array('resetdb', 'generate', 'avisos', 'test');
        $cmd = $_SERVER['argc'] > 1 ? $_SERVER['argv'][1] : '';

        if (in_array($cmd, $allowed_commands)) {
            list($usec, $sec) = explode(" ", microtime());
            $start = (float) $usec + (float) $sec;
            $this->$cmd();
            list($usec, $sec) = explode(" ", microtime());
            $total_time = round((float) $usec + (float) $sec - $start, 4);
            echo "Execution Time   \t$total_time seconds " . PHP_EOL;
        } else {
            print PHP_EOL . "Usage: " . basename(__FILE__) . " [ " . implode(' | ', $allowed_commands) . " ]" . PHP_EOL;
        }
    }

    public function resetdb() {
        $tables = $this->_db->query("SHOW TABLES")->fetchAll();
        foreach ($tables as $table) {
            $table_name = $table["Tables_in_" . $this->_config->resources->db->params->dbname];
            $this->sql("DROP TABLE IF EXISTS $table_name");
        }
    }

    public function generate() {
        $this->show_vars();
        $this->generate_middle();
        $this->generate_match_table(self::AVISO);
        $this->generate_match_table(self::POSTULANTE);
        $this->generate_union_table(self::POSTULACION);
    }

    public function test() {
        $_postulacion = new Postulacion();
        $r = $_postulacion->fetchAll(array('id<?'=>5))->toArray();
        $r = $this->_db
                ->select()
                ->from(array('x'=>'postulacion'),array('id','match'))
                ->join(array('a'=>'aviso'),'x.id_aviso=a.id',array('aviso'=>'a.name'))
                ->join(array('p'=>'postulante'),'x.id_postulante=p.id',array('postulante'=>'p.name'))
                ->where('x.id<5')
                //->toArray()
        ;
        print_r($this->_db->fetchAll($r));
    }

    private function sql($sql, $qmode = self::QMODE_ZEND_DB) {
        switch ($qmode) {
            case self::QMODE_ZEND_DB:
                if (self::ECHO_MODE) {
                    echo $sql;
                }
                if ($this->_db->query($sql)) {
                    if (self::ECHO_MODE) {
                        echo "... OK" . PHP_EOL;
                    }
                } else {
                    echo "... FAIL!!!" . PHP_EOL;
                    exit;
                }
                break;
            case self::QMODE_INIT_BATCH:
                if (file_exists(self::BATCH_FILENAME))
                    unlink(self::BATCH_FILENAME);
                touch(self::BATCH_FILENAME);
                $this->_fp = fopen(self::BATCH_FILENAME, "w");
                break;
            case self::QMODE_ADD_BATCH_LINE:
                fwrite($this->_fp, $sql . PHP_EOL);
                break;
            case self::QMODE_CLOSE_BATCH:
                fclose($this->_fp);
                $cmd = sprintf(
                                "%s --user=%s --password=%s %s < %s",
                                self::MYSQL_BIN,
                                $this->_config->resources->db->params->username,
                                $this->_config->resources->db->params->password,
                                $this->_config->resources->db->params->dbname,
                                self::BATCH_FILENAME
                );
                system($cmd);
                break;
        }
    }

    private function show_vars() {
        echo "Tablas Comunes: \t" . self::MIDDLE_TABLES . " tablas" . PHP_EOL;
        echo "Filas en TC:  \t\t" . self::ROWS_IN_MIDDLE_TABLES . " filas" . PHP_EOL;
        echo "Verbose:  \t\t" . (self::ECHO_MODE ? 'Si' : 'No') . PHP_EOL;
        echo "MySQL Engine:  \t\t" . self::MYSQL_ENGINE . PHP_EOL;
        echo "Avisos:  \t\t" . $this->_nrows[self::AVISO] . PHP_EOL;
        echo "Postulantes:  \t\t" . $this->_nrows[self::POSTULANTE] . PHP_EOL;
        echo "Prom. Post. x Aviso:  \t" . self::AVG_POSTUL_X_AVISO . PHP_EOL;
        echo "# de Postulaciones:  \t" . $this->_np . PHP_EOL;
    }

    private function generate_middle() {
        foreach (range(1, self::MIDDLE_TABLES) as $i) {
            $this->create_middle_table("middle_$i");
            $this->fill_middle_table("middle_$i", self::ROWS_IN_MIDDLE_TABLES);
        }
    }

    private function create_middle_table($name) {
        $this->sql("DROP TABLE IF EXISTS $name");
        $this->sql(
                "CREATE TABLE $name (" .
                "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, " .
                "name VARCHAR(50) NOT NULL" .
                ") ENGINE = " . self::MYSQL_ENGINE . ";"
        );
    }

    private function fill_middle_table($name, $n) {
        foreach (range(1, $n) as $i) {
            $value = "value$i";
            $this->sql("INSERT INTO $name (name) VALUES ('$value')");
        }
    }

    private function generate_match_table($name) {
        $this->create_match_table($name);
        foreach (range(1, $this->_nrows[$name]) as $i) {
            $this->fill_match_table($name);
        }
    }

    private function create_match_table($name) {
        $sql = "CREATE TABLE $name ( ";
        $sql .= "id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
        foreach (range(1, self::MIDDLE_TABLES) as $i) {
            $sql .= "id_middle_$i INT NOT NULL, ";
        }
        $sql .= "name VARCHAR(100) NOT NULL ";
        $sql .= ") ENGINE = " . self::MYSQL_ENGINE . "; ";
        $this->sql($sql);
    }

    private function fill_match_table($name) {
        if (is_null($this->_middle_table_field_list)) {
            $this->_middle_table_field_list =
                    "id_middle_" .
                    implode(", id_middle_", range(1, self::MIDDLE_TABLES));
        }

        if (!array_key_exists($name, $this->_cache_values)) {
            $row_names = file_get_contents("$name.txt");
            $row_names_array = explode(PHP_EOL, $row_names);
            $this->_cache_values[$name] = array();
            foreach ($row_names_array as $row_name) {
                $this->_cache_values[$name][] = sprintf($this->_masks[$name], $row_name);
            }
        }
        $sql = "INSERT INTO $name (";
        $sql .= $this->_middle_table_field_list . ", name";
        $sql .= ") VALUES (";
        foreach (range(1, self::MIDDLE_TABLES) as $i) {
            $sql .= rand(1, self::ROWS_IN_MIDDLE_TABLES) . ", ";
        }
        $sql .= "'" . $this->_cache_values[$name][array_rand($this->_cache_values[$name])] . "'";
        $sql .= ") ";
        $this->sql($sql);
    }

    private function generate_union_table($name) {
        $this->create_union_table($name);
        $p = array(); // postulaciones realizadas
        $i = 0; // # postulaciones realizadas
        $this->sql(null, self::QMODE_INIT_BATCH);
        while ($i < $this->_np) {
            $aid = rand(1, $this->_nrows[self::AVISO]);
            $pid = rand(1, $this->_nrows[self::POSTULANTE]);
            $pc = "pcache" . $aid;
            if (!( isset($$pc) && array_key_exists($pid, $$pc) )) {
                $this->fill_union_table($name, $aid, $pid, self::QMODE_ADD_BATCH_LINE);
                if (!isset($$pc)) {
                    $$pc = array();
                }
                array_push($$pc, array($pid => true));
                $i++;
            }
        }
        $this->sql(null, self::QMODE_CLOSE_BATCH);
    }

    private function create_union_table($name) {
        $this->sql(sprintf("DROP TABLE IF EXISTS %s", $name));
        $this->sql(
                sprintf(
                        "CREATE TABLE %s (" .
                        "id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, " .
                        "id_%s INT NOT NULL, " .
                        "id_%s INT NOT NULL, " .
                        "`%s` FLOAT NULL" .
                        ") ENGINE = %s;",
                        $name,
                        self::AVISO,
                        self::POSTULANTE,
                        "match",
                        self::MYSQL_ENGINE
                )
        );
    }

    private function fill_union_table($name, $aid, $pid, $qmode=self::QMODE_ZEND_DB) {
        $this->sql(
                sprintf(
                        "INSERT INTO %s (id_%s, id_%s) VALUES ('%s','%s');",
                        $name,
                        self::AVISO,
                        self::POSTULANTE,
                        $aid,
                        $pid
                ),
                $qmode
        );
    }

}

$cli = new CLI;
$cli->main();
?>