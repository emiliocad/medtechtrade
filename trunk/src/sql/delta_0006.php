<?php
class Delta_0006 extends Mtt_Migration_Delta
{
    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "agregar campo active tabla busqueda";

    public function up()
    {
        $sql =
            "ALTER TABLE `medtechtrade`.`busqueda`     
                ADD COLUMN `active` INT DEFAULT '1' NOT NULL 
                AFTER `usuario_id`;";
        
        $this->_db->query($sql);
        return true;
    }
}
