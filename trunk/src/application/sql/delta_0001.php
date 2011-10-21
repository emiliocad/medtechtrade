<?php
class Delta_0001 extends My_Migration_Delta
{
    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Modificacion de la tabla experiencia";

    public function up()
    {
        $sql =
            "ALTER TABLE `experiencia` CHANGE `empresa` `otra_empresa` 
            VARCHAR( 75 ) NOT NULL ";
        $this->_db->query($sql);
        return true;
    }
}