<?php
class Delta_0006 extends Mtt_Migration_Delta
{
    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "agregar foreign key a busqueda";

    public function up()
    {
        $sql =
            "ALTER TABLE busqueda 
                ADD CONSTRAINT `fk_busqueda_categoria1` 
                FOREIGN KEY (`categoria_id`) 
                REFERENCES `categoria` (`id`) 
                ON DELETE NO ACTION 
                ON UPDATE NO ACTION;";
        
        $this->_db->query($sql);
        return true;
    }
}
