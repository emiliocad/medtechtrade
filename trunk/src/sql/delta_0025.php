<?php


class Delta_0025
        extends Mtt_Migration_Delta
    {

    protected $_author = self::SLOVACUS;
    protected $_desc = "cambiando prefijo a Idioma";


    public function up()
        {
        $sql = "
            UPDATE idiomas SET prefijo = 'en' WHERE id=1;
UPDATE idiomas SET prefijo = 'pl' WHERE id=2;
UPDATE idiomas SET prefijo = 'es' WHERE id=3;
UPDATE idiomas SET prefijo = 'de' WHERE id=4;
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
