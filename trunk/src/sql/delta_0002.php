<?php
class Delta_0002 extends Mtt_Migration_Delta
{
    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "agregacion para slug para Equipos";

    public function up()
    {
        $sql =
            "ALTER TABLE equipo ADD slug VARCHAR(200) NOT null";
        $this->_db->query($sql);
        return true;
    }
}