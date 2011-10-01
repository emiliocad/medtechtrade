<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_ActivarUsuario
        extends Mtt_Form
    {


    public function init()
        {

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActivarUsuario' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
        ;
        $this->addElementPrefixPath(
                'Mtt_Form_Decorator' , 'Mtt/Form/Decorator/' , 'decorator'
        );


        $usuarios = new Zend_Form_Element_MultiCheckbox( 'usuarios' );
        $_usuarios = new Mtt_Models_Bussines_Usuario();

        foreach ( $_usuarios->listarRegistrados() as $usuario )
            {
            $usuarios->addMultiOption( $usuario->id ,
                                       $usuario->nombre . ' ' .
                    $usuario->apellido );
            }

        $this->addElement( $usuarios );


        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setAttrib( 'value' , 'Habilitar' )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $submit );
        }


    }
