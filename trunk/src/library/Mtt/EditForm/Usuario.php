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
        $this->removeElement( $this->email->getName() );
        $this->removeElement( $this->login->getName() );
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
