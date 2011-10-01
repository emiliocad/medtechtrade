<?php
class Delta_0001 extends My_Migration_Delta
{
    protected $_author = "Julio Florian";
    protected $_desc = "Modificacion de la tabla postulante: solo un campo para ambos apellidos";

    public function up()
    {
        $sql =
            "ALTER TABLE `postulante` CHANGE `apellidom` `apellidos` 
            VARCHAR( 75 ) NOT NULL ";
        $this->_db->query($sql);
        
        $sql =
            "ALTER TABLE `postulante` DROP `apellidop`";
        $this->_db->query($sql);
        return true;
    }
}
