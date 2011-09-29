<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//TODO Crear Translate para Zend Form
class Mtt_Form_ActivarUsuario
        extends Zend_Form
    {


    public function init()
        {
       

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActivarUsuario' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
                ->setAction( '/admin/user/index')
        ;
        $this->addElementPrefixPath(
                'Mtt_Form_Decorator' , 'Mtt/Form/Decorator/' , 'decorator'
        );

        $usuarios = new Zend_Form_Element_MultiCheckbox( 'usuarios' );
        $_usuarios = new Mtt_Models_Bussines_Usuario();

        foreach ( $_usuarios->listarRegistrados() as $usuario )
            {
            $usuarios->addMultiOption( $usuario->id , $usuario->nombre . ' ' .
                    $usuario->apellido);
            }

        $this->addElement( $usuarios );


        //Submit
        $submit = new Zend_Form_Element_Submit( 'submit' );
        $submit->setAttrib( 'value' , 'Habilitar' );
        $this->addElement( $submit );
        }


    }