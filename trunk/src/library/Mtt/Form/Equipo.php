<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Form_Equipo extends Mtt_Form {

    protected $nombre;
    protected $precioVenta;
    protected $precioCompra;
    protected $categoria;
    protected $estadoEquipo;
    protected $fabricantes;
    protected $publicacionEquipo;
    protected $tag;
    protected $moneda;
    protected $pais;
    protected $calidad;
    protected $cantidad;
    protected $modelo;
    protected $fechaFabricacion;
    protected $documento;
    protected $sourceDocumento;
    protected $pesoEstimado;
    protected $size;
    protected $ancho;
    protected $alto;
    protected $sizeCaja;

    public function init() {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfig.ini', 'upload'
                )
        ;
        $data = $_conf->toArray();

        $this
                ->setMethod('post')
                ->setAttrib('id', 'frmEquipo')
        ;

        $this->categoria = new Zend_Form_Element_Select('categoria_id');
        $this->categoria->setRequired();
        $this->categoria->setLabel(
                $this->_translate->translate('categoria')
        )->setOrder(0);
        $_categoria = new Mtt_Models_Bussines_Categoria();
        $values = $_categoria->getComboValues();
        $this->categoria->addMultiOption(-1, 
                '--- ' . $this->_translate->translate('categoria') . '---'
        );
        $this->categoria->addMultiOptions($values);
        //$this->addElement($this->categoria);
        $this->categoria->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        // Elemento: Nombre
        $this->nombre = new Zend_Form_Element_Text('nombre');
        $this->nombre->setLabel(
                $this->_translate->translate('nombre')
        )->setOrder(1);;
        $this->nombre->setAttrib('maxlength', '50');
        $this->nombre->setRequired(true);
        $v = new Zend_Validate_StringLength(
                        array('min' => 5, 'max' => 50)
        );
        $v->setMessage(
                $this->_translate->translate("El nombre del Equipo debe 
                    tener debe tener al menos
                    %min% characters. ' % value % ' no cumple ese requisito"), 
                Zend_Validate_StringLength::TOO_SHORT
        );
        $this->nombre->addValidator($v);
        //$this->addElement($this->nombre);
        // Elemento: PrecioVenta
        $this->precioVenta = new Zend_Form_Element_Text('precioventa');
        $this->precioVenta->setLabel(
                $this->_translate->translate('precio de venta')
        )->setOrder(2);
        $this->precioVenta->setRequired(true);
        $v = new Zend_Validate_Between(array('min' => 0.1,
                    'max' => 9999999999));
        $this->precioVenta->addValidator($v);
        $v = new Zend_Validate_Float(new Zend_Locale('US'));
        $this->precioVenta->addValidator($v);
        $this->precioVenta->setAttrib('maxlength', '10');
        // $this->addElement($this->precioVenta);
        // Elemento: PrecioCompra
        $this->precioCompra = new Zend_Form_Element_Text('preciocompra');
        $this->precioCompra->setLabel(
                $this->_translate->translate('precio de compra')
        )->setOrder(3);
        $this->precioCompra->setRequired(true);
        $v = new Zend_Validate_Between(
                        array(
                            'min' => 0.1, 'max' => 9999999999
                        )
        );
        $this->precioCompra->addValidator($v);
        $v = new Zend_Validate_Float(new Zend_Locale('US'));
        $this->precioCompra->addValidator($v);
        $this->precioCompra->setAttrib('maxlength', '7');
        //$this->addElement($this->precioCompra);


        $this->estadoEquipo = new Zend_Form_Element_Select('estadoequipo_id');
        $this->estadoEquipo->setRequired();
        $this->estadoEquipo->setLabel(
                $this->_translate->translate('estado del equipo')
        )->setOrder(4);
        $_estadoEquipo = new Mtt_Models_Bussines_estadoEquipo();
        $values = $_estadoEquipo->getComboValues();
        $this->estadoEquipo->addMultiOption(-1, 
                '--- ' . $this->_translate->translate('estado equipo') . ' ---');
        $this->estadoEquipo->addMultiOptions($values);
        //$this->addElement($this->estadoEquipo);
        $this->estadoEquipo->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        $this->publicacionEquipo = new Zend_Form_Element_Select('publicacionEquipo_id');
        $this->publicacionEquipo->setRequired();
        $this->publicacionEquipo->setLabel(
                $this->_translate->translate('publicacion de equipo')
        )->setOrder(5);
        $_publicacionEquipo = new Mtt_Models_Bussines_PublicacionEquipo;
        $values = $_publicacionEquipo->getComboValues();
        $this->publicacionEquipo->addMultiOption(
                -1, '--- ' . $this->_translate->translate('publicacion equipo') .
                ' ---'
        );
        $this->publicacionEquipo->addMultiOptions($values);
        //$this->addElement($this->publicacionEquipo);
        $this->publicacionEquipo->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        $this->fabricantes = new Zend_Form_Element_Select('fabricantes_id');
        $this->fabricantes->setRequired();
        $this->fabricantes->setLabel(
                $this->_translate->translate('fabricantes')
        )->setOrder(6);
        $_fabricantes = new Mtt_Models_Bussines_Fabricante();
        $values = $_fabricantes->getComboValues();
        $this->fabricantes->addMultiOption(-1, 
                '--- ' . $this->_translate->translate('fabricantes') . ' ---');
        $this->fabricantes->addMultiOptions($values);
        //$this->addElement($this->fabricantes);
        $this->fabricantes->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        // Elemento: Nombre
        $this->tag = new Zend_Form_Element_Text('tag');
        $this->tag->setLabel(
                $this->_translate->translate('tag')
        )->setOrder(7);
        $this->tag->setAttrib('maxlength', '80');
        $this->tag->setRequired(false);
        //$this->addElement($this->tag);

        $this->moneda = new Zend_Form_Element_Select('moneda_id');
        $this->moneda->setRequired();
        $this->moneda->setLabel(
                $this->_translate->translate('moneda')
        )->setOrder(8);
        $_moneda = new Mtt_Models_Bussines_Moneda();
        $values = $_moneda->getComboValues();
        $this->moneda->addMultiOption(-1, 
                '--- ' . $this->_translate->translate('monedas') . '  ---'
        );
        $this->moneda->addMultiOptions($values);
        /* $this->addElement(
          $this->moneda
          ); */
        $this->moneda->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        $this->pais = new Zend_Form_Element_Select('paises_id');
        $this->pais->setRequired();
        $this->pais->setLabel(
                $this->_translate->translate('pais')
        )->setOrder(9);
        $_pais = new Mtt_Models_Bussines_Paises();
        $values = $_pais->getComboValues();
        $this->pais->addMultiOption(-1, 
                '--- ' . $this->_translate->translate('pais') . ' ---');
        $this->pais->addMultiOptions($values);
        //$this->addElement($this->pais);
        $this->pais->addValidator(
                new Zend_Validate_InArray(array_keys($values))
        );

        // Elemento: Calidad
        $this->calidad = new Zend_Form_Element_Text('calidad');
        $this->calidad->setLabel(
                $this->_translate->translate('calidad')
        )->setOrder(10);
        $this->calidad->setAttrib('maxlength', '50');
        $this->calidad->setRequired(true);
        $v = new Zend_Validate_StringLength(
                        array('min' => 5, 'max' => 50)
        );
        $v->setMessage(
                $this->_translate->translate(
                        "La Calidad del producto debe tener debe tener al menos
            %min% characters. '%value%' no cumple ese requisito"), 
                Zend_Validate_StringLength::TOO_SHORT
        );
        $this->calidad->addValidator($v);
        //$this->addElement($this->calidad);
        // 
        // Elemento: cantidad
        $this->cantidad = new Zend_Form_Element_Text('cantidad');
        $this->cantidad->setLabel(
                $this->_translate->translate('cantidad ')
        )->setOrder(11);
        $this->cantidad->setRequired(true);
        $v = new Zend_Validate_Between(array('min' => 1, 'max' => 9999));
        $this->cantidad->addValidator($v);
        $this->cantidad->setAttrib('maxlength', '7');
        //$this->addElement($this->cantidad);
        // 
        // Elemento: modelo
        $this->modelo = new Zend_Form_Element_Text('modelo');
        $this->modelo->setLabel($this->_translate->translate('modelo')
        )->setOrder(12);
        $this->modelo->setAttrib('maxlength', '50');
        $this->modelo->setRequired(true);
        // $this->addElement($this->modelo);
        // 
        // Elemento: fecha de Fabricacion
        $this->fechaFabricacion = new ZendX_JQuery_Form_Element_DatePicker(
                        'fechafabricacion',
                        array(
                            'jQueryParams' => array(
                                'defaultDate' => date('Y/m/d', time()),
                                'changeYear' => 'true'
                            )
                        )
        );
        $this->fechaFabricacion->setLabel(
                $this->_translate->translate('fecha de fabricacion')
        )->setOrder(13);
        $this->fechaFabricacion->loadDefaultDecorators();
        $this->fechaFabricacion->setJQueryParam('dateFormat', 'yy-mm-dd');
        $this->fechaFabricacion->setRequired(true);
        // $this->addElement($this->fechaFabricacion);
        
        //Elemento Size
        $this->size =  new Zend_Form_Element_Text('size');
        $this->size->setLabel(
                $this->_translate->translate('tamaño ')
        )->setOrder(14);
        $this->size->setRequired(true);
        $v = new Zend_Validate_Between(array('min' =>0.1, 'max' => 9999));
        $this->size->addValidator($v);
        $this->size->setAttrib('maxlength', '7');
        
        //Elemento : ancho
        $this->ancho =  new Zend_Form_Element_Text('ancho');
        $this->ancho->setLabel(
                $this->_translate->translate('ancho')
        )->setOrder(15);
        $this->ancho->setRequired(true);
        $v = new Zend_Validate_Between(array('min' =>0.1, 'max' => 9999));
        $this->ancho->addValidator($v);
        $this->ancho->setAttrib('maxlength', '7');
        
        //Elemento : alto
        $this->alto =  new Zend_Form_Element_Text('alto');
        $this->alto->setLabel(
                $this->_translate->translate('alto')
        )->setOrder(16);
        $this->alto->setRequired(true);
        $v = new Zend_Validate_Between(array('min' =>0.1, 'max' => 9999));
        $this->alto->addValidator($v);
        $this->alto->setAttrib('maxlength', '7');
        

        //Elemento : sizeCaja
        $this->sizeCaja =  new Zend_Form_Element_Text('sizeCaja');
        $this->sizeCaja->setLabel(
                $this->_translate->translate('tamaño de la caja')
        )->setOrder(17);
        $this->sizeCaja->setRequired(true);
        $v = new Zend_Validate_Between(array('min' =>0.1, 'max' => 9999));
        $this->sizeCaja->addValidator($v);
        $this->sizeCaja->setAttrib('maxlength', '7');        
        
         //Elemento PesoEstimado
        $this->pesoEstimado =  new Zend_Form_Element_Text('pesoEstimado');
        $this->pesoEstimado->setLabel(
                $this->_translate->translate('peso estimado ')
        )->setOrder(18);
        $this->pesoEstimado->setRequired(true);
        $v = new Zend_Validate_Between(array('min' =>0.1, 'max' => 9999));
        $this->pesoEstimado->addValidator($v);
        $this->pesoEstimado->setAttrib('maxlength', '7');
        
        
        $this->submit = new Zend_Form_Element_Button('submit');
        $this->submit->setLabel(
                        $this->_translate->translate('registrar')
                )
                ->setAttrib(
                        'class', 'button'
                )
                ->setAttrib('type', 'submit')
                ->setOrder(19)
        ;



        $this->addElements(
                array(
                    $this->nombre,
                    $this->categoria,
                    $this->precioVenta,
                    $this->precioCompra,
                    $this->estadoEquipo,
                    $this->publicacionEquipo,
                    $this->fabricantes,
                    $this->tag,
                    $this->moneda,
                    $this->pais,
                    $this->calidad,
                    $this->cantidad,
                    $this->fechaFabricacion,
                    $this->modelo,
                    $this->size,
                    $this->alto,
                    $this->ancho,
                    $this->sizeCaja,
                    $this->pesoEstimado,
                    $this->submit
                )
        );
    }

}

