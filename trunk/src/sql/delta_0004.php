<?php
class Delta_0004 extends Mtt_Migration_Delta
{
    protected $_author = "Teresa Chunga Estrada";
    protected $_desc = "cambio de nombre de campo";

    public function up()
    {
        $sql =
            "ALTER TABLE busqueda  change categoria categoria_id int(11) NULL ;";
        $this->_db->query($sql);
        return true;
    }
}
