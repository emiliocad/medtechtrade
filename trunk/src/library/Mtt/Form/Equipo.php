<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Equipo
        extends Zend_Form
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
                ->setAttrib( 'id' , 'frmEquipo' )
        ;

        $categoria = new Zend_Form_Element_Select( 'categoria_id' );
        $categoria->setLabel( 'Categoria' );
        $_categoria = new Mtt_Models_Bussines_Categoria();
        $values = $_categoria->getComboValues();
        $categoria->addMultiOption( -1 , '--- Categoria ---' );
        $categoria->addMultiOptions( $values );
        $this->addElement( $categoria );
        $categoria->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
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


        // Elemento: PrecioVenta
        $precioVenta = new Zend_Form_Element_Text( 'precioventa' );
        $precioVenta->setLabel( 'Precio de venta: ' );
        $precioVenta->setRequired( true );
        $v = new Zend_Validate_Between( array( 'min' => 0.1 ,
                    'max' => 9999999999 ) );
        $precioVenta->addValidator( $v );
        $v = new Zend_Validate_Float( new Zend_Locale( 'US' ) );
        $precioVenta->addValidator( $v );
        $precioVenta->setAttrib( 'maxlength' , '10' );
        $this->addElement( $precioVenta );

        // Elemento: PrecioCompra
        $precioCompra = new Zend_Form_Element_Text( 'preciocompra' );
        $precioCompra->setLabel( 'Precio de Compra' );
        $precioCompra->setRequired( true );
        $v = new Zend_Validate_Between( array( 'min' => 0.1 , 'max' => 9999 ) );
        $precioCompra->addValidator( $v );
        $v = new Zend_Validate_Float( new Zend_Locale( 'US' ) );
        $precioCompra->addValidator( $v );
        $precioCompra->setAttrib( 'maxlength' , '7' );
        $this->addElement( $precioCompra );


        $estadoEquipo = new Zend_Form_Element_Select( 'estadoequipo_id' );
        $estadoEquipo->setLabel( 'Estado Equipo:' );
        $_estadoEquipo = new Mtt_Models_Bussines_estadoEquipo();
        $values = $_estadoEquipo->getComboValues();
        $estadoEquipo->addMultiOption( -1 , '--- Estado Equipo ---' );
        $estadoEquipo->addMultiOptions( $values );
        $this->addElement( $estadoEquipo );
        $estadoEquipo->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
        );

        $publicacionEquipo = new Zend_Form_Element_Select( 'publicacionEquipo_id' );
        $publicacionEquipo->setLabel( 'Publicacion de Equipo:' );
        $_publicacionEquipo = new Mtt_Models_Bussines_PublicacionEquipo;
        $values = $_publicacionEquipo->getComboValues();
        $publicacionEquipo->addMultiOption( -1 , '--- Publicacion Equipo ---' );
        $publicacionEquipo->addMultiOptions( $values );
        $this->addElement( $publicacionEquipo );
        $publicacionEquipo->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
        );

        $fabricantes = new Zend_Form_Element_Select( 'fabricantes_id' );
        $fabricantes->setLabel( 'Fabricantes:' );
        $_fabricantes = new Mtt_Models_Bussines_Fabricante();
        $values = $_fabricantes->getComboValues();
        $fabricantes->addMultiOption( -1 , '--- Fabricantes ---' );
        $fabricantes->addMultiOptions( $values );
        $this->addElement( $fabricantes );
        $fabricantes->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
        );

        // Elemento: Nombre
        $tag = new Zend_Form_Element_Text( 'tag' );
        $tag->setLabel( 'Tag:' );
        $tag->setAttrib( 'maxlength' , '80' );
        $tag->setRequired( false );
        $this->addElement( $tag );

        $moneda = new Zend_Form_Element_Select( 'moneda_id' );
        $moneda->setLabel( 'Moneda:' );
        $_moneda = new Mtt_Models_Bussines_Moneda();
        $values = $_moneda->getComboValues();
        $moneda->addMultiOption( -1 , '--- Monedas ---' );
        $moneda->addMultiOptions( $values );
        $this->addElement( $moneda );
        $moneda->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
        );

        $pais = new Zend_Form_Element_Select( 'paises_id' );
        $pais->setLabel( 'Pais:' );
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $pais->addMultiOption( -1 , '--- Pais ---' );
        $pais->addMultiOptions( $values );
        $this->addElement( $pais );
        $pais->addValidator(
                new Zend_Validate_InArray( array_keys( $values ) )
        );
        
        // Elemento: Calidad
        $calidad = new Zend_Form_Element_Text( 'calidad' );
        $calidad->setLabel( 'Calidad' );
        $calidad->setAttrib( 'maxlength' , '50' );
        $calidad->setRequired( true );
        $v = new Zend_Validate_StringLength(
                        array( 'min' => 5 , 'max' => 50 )
        );
        $v->setMessage(
                "La Calidad del producto debe tener debe tener al menos
            %min% characters. '%value%' no cumple ese requisito" ,
                Zend_Validate_StringLength::TOO_SHORT
        );
        $calidad->addValidator( $v );
        $this->addElement( $calidad );

        // Elemento: cantidad
        $cantidad = new Zend_Form_Element_Text( 'cantidad' );
        $cantidad->setLabel( 'Cantidad: ' );
        $cantidad->setRequired( true );
        $v = new Zend_Validate_Between( array( 'min' => 1 , 'max' => 9999 ) );
        $cantidad->addValidator( $v );
        $cantidad->setAttrib( 'maxlength' , '7' );
        $this->addElement( $cantidad );


        // Elemento: modelo
        $modelo = new Zend_Form_Element_Text( 'modelo' );
        $modelo->setLabel( 'Modelo' );
        $modelo->setAttrib( 'maxlength' , '50' );
        $modelo->setRequired( true );
        $this->addElement( $modelo );

        // Elemento: fecha de Fabricacion
        $fechaFabricacion = new ZendX_JQuery_Form_Element_DatePicker(
                        'fechafabricacion',
                        array('jQueryParams' => array('defaultDate' => date('Y-m-D'),
                                'changeYear'=> 'true'))
        );
        $fechaFabricacion->setLabel( 'fecha de Fabricacion' );
        $fechaFabricacion->setJQueryParam( 'dateFormat' , 'yy.mm.dd' );
        $fechaFabricacion->setRequired( true );
        $this->addElement( $fechaFabricacion );



        $this->addElement( 'submit' , 'Enviar' );
        }


    }

