<?php


class Delta_0003
        extends Mtt_Migration_Delta
    {

    protected $_author = "Luis Alberto Mayta Mamani";
    protected $_desc = "Colocando Campos Slug en Categoria";


    public function up()
        {
        $sql = "UPDATE categoria
SET categoria.slug = 'others'
WHERE categoria.id = '148'";
        $this->_db->query( $sql );

        $sql = "UPDATE categoria
SET categoria.slug = 'apparatus-general-lab'
WHERE categoria.id = '150'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'cardio-devices'
WHERE categoria.id = '151'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'balances'
WHERE categoria.id = '152'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'centrifugues'
WHERE categoria.id = '153'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'respirators'
WHERE categoria.id = '154'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'endoscopy-devices'
WHERE categoria.id = '155'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'microscopes'
WHERE categoria.id = '156'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'imaging-systems'
WHERE categoria.id = '157'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'chirurgical-devices'
WHERE categoria.id = '158'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'monitoring-devices'
WHERE categoria.id = '159'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'perfusors-pumps'
WHERE categoria.id = '160'";
        $this->_db->query( $sql );
        $sql = "UPDATE categoria
SET categoria.slug = 'ultrasound'
WHERE categoria.id = '161'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'incubators'
WHERE categoria.id = '162'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'autoclaves'
WHERE categoria.id = '163'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'coolers-freezers'
WHERE categoria.id = '164'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'medical-furnitures-beds'
WHERE categoria.id = '165'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'x-ray'
WHERE categoria.id = '168'";
        $this->_db->query( $sql );
        $sql =
                "UPDATE categoria
SET categoria.slug = 'neu-demoger-te'
WHERE categoria.id = '169'";
        $this->_db->query( $sql );

        return true;
        }


    }
