<?php

class Delta_0016 
    extends Mtt_Migration_Delta {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Add Avatar";

    public function up() {
        $sql = "
            ALTER TABLE `medtechtrade`.`imagen`     
            ADD COLUMN `avatar` VARCHAR(255) NULL AFTER `active`;
            ";
        
        $this->_db->query($sql);
        
        return true;
    }

}
