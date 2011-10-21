<?php


class Delta_0009
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "agregando slug a Equipos";


    public function up()
        {
        $sql = "UPDATE equipo
SET equipo.slug = 'equipo-2'
WHERE equipo.id = '3'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'equipo-3'
WHERE equipo.id = '4'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'equipo-4'
WHERE equipo.id = '5'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'test-tsfs'
WHERE equipo.id = '6'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'prueba-equivo'
WHERE equipo.id = '9'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'test-2-x'
WHERE equipo.id = '10'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'test-tsfs2'
WHERE equipo.id = '11'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'test-tsfs3'
WHERE equipo.id = '12'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'stereo-xxxx'
WHERE equipo.id = '13'";
        $this->_db->query( $sql );
        $sql = "UPDATE equipo
SET equipo.slug = 'electrocardiograma'
WHERE equipo.id = '14'";
        $this->_db->query( $sql );
       
        return true;
        }


    }
