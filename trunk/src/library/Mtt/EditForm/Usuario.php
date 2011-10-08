<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO crear decoradores para este formulario
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
        $this->removeElement( $this->nombre->getName() );
        }


    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }

?>
