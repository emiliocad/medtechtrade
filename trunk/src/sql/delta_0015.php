<?php

class Delta_0015 
    extends Mtt_Migration_Delta {

    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "cambiar campo";

    public function up() {
        $sql = "
            ALTER TABLE `medtechtrade`.`alerta`     
                CHANGE `descripcion` `tipo` INT(11) NULL ;
            ";
        
        $this->_db->query($sql);
        
        return true;
    }

}
