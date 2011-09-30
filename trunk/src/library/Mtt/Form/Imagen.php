<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Imagen
        extends Mtt_Form
    {


    public function init()
        {
         $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini' , 'upload'
                )
        ;
        $data = $_conf->toArray();
        
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmImagen' )
                ->setAttrib( 'enctype' , 'multipart/form-data' );
        
        // Nombre
        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( 'Nombre *:' );
        $nombre->setRequired();
        $nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 2 ,
                            'max' => 50 ) )
        );
        //$nombre->addValidator( new Zend_Validate_Alnum( true ) );
        $nombre->addValidator(
                new Zend_Validate_Db_NoRecordExists(
                        array(
                            'table' => 'categoria' ,
                            'field' => 'nombre' ,
                        )
                )
        );

        //Imagen
        $imagen = new Zend_Form_Element_File( 'imagen' );
        $imagen->setValue( 'imagen' );
        $imagen->setLabel( 'Upload an image:' );

        $target = $nombre->getValue();
        $imagen->setDestination(
                APPLICATION_PATH . '/../public/media/catalog/product'
        );
        $imagen->addValidator( 'Count' , false , 1 );
        $imagen->addValidator( 'Size' , false , 1024000 )
                ->setValueDisabled( true );
        $imagen->addValidator(
                'Extension' , false , $data['extension']
        );

        $this->addElement(
                $imagen
        );

        // Elemento: Nombre
        $nombre = new Zend_Form_Element_Text( 'nombre' );
        $nombre->setLabel( 'Nombre' );
        $nombre->setAttrib( 'maxlength' , '50' );
        $nombre->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 50 )
        );
        $v->setMessage(
                "El nombre del producto debe tener debe tener al menos
            %min% characters. '%value%' no cumple ese requisito" ,
                Zend_Validate_StringLength::TOO_SHORT
        );
        $nombre->addValidator( $v );
        $this->addElement( $nombre );

        // Elemento: Descripcion
        $descripcion = new Zend_Form_Element_Text( 'descripcion' );
        $descripcion->setLabel( 'Descripcion:' );
        $descripcion->setAttrib( 'maxlength' , '80' );
        $descripcion->setRequired( false );
        $this->addElement( $descripcion );

        $this->addElement( 'submit' , 'Enviar' );
        }


    }

