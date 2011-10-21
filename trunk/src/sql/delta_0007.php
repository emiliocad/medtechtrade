<?php


class Delta_0007
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Agregando Cambios A la 
        Tabla Moneda para Google Finance";


    public function up()
        {
        $sql =
                "ALTER TABLE moneda
                    ADD cambio NUMERIC(8,3)";

        $this->_db->query( $sql );
        $sql =
                "ALTER TABLE moneda
                        ADD fechacambio DATE";

        $this->_db->query( $sql );
        return true;
        }


    }
