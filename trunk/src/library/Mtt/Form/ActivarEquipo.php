<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_ActivarEquipo
        extends Mtt_Form
    {


    public function init()
        {

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActivarEquipo' )
                ->setAttrib( 'enctype' , 'multipart/form-data' )
        ;
        $this->addElementPrefixPath(
                'Mtt_Form_Decorator' , 'Mtt/Form/Decorator/' , 'decorator'
        );


        $equipos = new Zend_Form_Element_MultiCheckbox( 'equipos' );
        $_equipos = new Mtt_Models_Bussines_Equipo();

        foreach ( $_equipos->listEquipUnresolved() as $equipo )
            {
            $equipos->addMultiOption( $equipo->id ,
                                       $equipo->equipo );
            }

        $this->addElement( $equipos );


        //Submit
        $submit = new Zend_Form_Element_Button( 'submit' );
        $submit->setAttrib(
                        'value' ,
                        $this->_translate->translate( 'Habilitar'
                        )
                )
                ->setAttrib( 'class' , 'button' )
                ->setAttrib( 'type' , 'submit' )
        ;
        $this->addElement( $submit );
        }


    }
