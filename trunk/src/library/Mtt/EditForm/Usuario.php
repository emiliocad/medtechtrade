<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_EditForm_Usuario
        extends Mtt_Form_Usuario
    {


    public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmACtualizar' )
        ;
        
        $this->tratamiento->setOrder(0);
        $this->institucion->setOrder(1);
        $this->nombre->setOrder(2);
        $this->apellido->setOrder(3);
        $this->direccion->setOrder(4);
        $this->ciudad->setOrder(5);
        $this->codPostal->setOrder(6);
        $this->paises->setOrder(7);
        $this->telefono->setOrder(8);
        $this->fax->setOrder(9);
        $this->email->setOrder(10);
        $this->submit->setOrder(11);
        //$this->removeElement( $this->email->getName() );
        $this->removeElement( $this->login->getName() );
        $this->removeElement( $this->rol->getName() );
        $this->removeElement( $this->clave->getName() );
        $this->removeElement( $this->clave2->getName() );

        $this->submit->setLabel(
                ucwords(
                        $this->_translate->translate( 'actualizar' )
                )
        );
        }


    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }

?>
