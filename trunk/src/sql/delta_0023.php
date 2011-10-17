<?php


class Delta_0023
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Insertando Integrate a Paises";


    public function up()
        {
        $sql = "
             UPDATE paises SET integrate = 1 WHERE id IN (1,24,79,5,161)
            ";

        $this->_db->query( $sql );

        return true;
        }


    }
