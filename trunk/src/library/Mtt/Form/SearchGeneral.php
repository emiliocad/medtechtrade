<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_SearchGeneral
        extends Mtt_Formy
    {

    protected $palabrasBusqueda;
    protected $modelo;
    protected $fabricante;
    protected $categoria;
    protected $anioInicio;
    //protected $anioFin;
    //protected $precioInicio;
    //protected $precioFin;
    //protected $id;
    protected $submit;

    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmSearchGeneral' )
                ->setAction('/busqueda/resultsearch')
        ;
        
        
        //Busqueda
        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $this->palabrasBusqueda = new Zend_Form_Element_Text( 'palabras_busqueda' );
        //$e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->palabrasBusqueda ->setLabel(
                $this->_translate->translate(
                        'buscar por'
                )
        );
        //$this->addElement( $this->palabrasBusqueda  );

        /* Modelo */
        $this->modelo = new Zend_Form_Element_Text( 'modelo' );
        //$e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->modelo->setLabel(
                $this->_translate->translate(
                        'modelo'
                )
        );
        //$this->addElement( $this->modelo );


        /* Fabricante */
        $this->fabricante = new Zend_Form_Element_Text( 'fabricante' );
        //$e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $this->fabricante->setLabel(
                $this->_translate->translate(
                        'fabricante'
                )
        );
        //$this->addElement( $this->fabricante );

        /* Categoria */
        $this->categoria = new Zend_Form_Element_Select( 'categoria_id' );
        $this->categoria->setLabel(
                $this->_translate->translate(
                        'categoria'
                )
        );
        $_categoria = new Mtt_Models_Bussines_Categoria();
        $values = $_categoria->getComboValues();
        $this->categoria->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'todos'
                )
        );
        $this->categoria->addMultiOptions( $values );
        //$this->addElement( $this->categoria );
        
         /* año desde */
        // Creando array
        $ini_year = 1980;
        $year_fin = date( 'Y' );
        for ( $i = $ini_year; $i <= $year_fin; $i++ )
            {
            $anio[$i] = $i;
          
            }
            
        
        $this->anioInicio= new Zend_Form_Element_Select( 'anio_inicio' );
        $this->anioInicio->setLabel(
                $this->_translate->translate(
                        'desde el año'
                )
        );
       
        $this->anioInicio->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'desde'
                )
        );
        $this->anioInicio->addMultiOptions( $anio );
        //$this->addElement( $this->anioInicio );
        
        
         /* hasta */
        /*$this->anioFin = new Zend_Form_Element_Select( 'anio_fin' );
        $this->anioFin->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'hasta'
                )
        );
        $this->anioFin->addMultiOptions( $anio );*/
        //$this->addElement( $this->anioFin );

         /* precio desde */
        //Creando array precios
        /*$precio = array(
            '0' => 0,
            '100' => 100,
            '500' => 500,
            '1000' => 1000,
            '2000' => 2000,
            '5000' => 5000,
            '10000' => 10000,
            '50000' => 50000
           
        );
        $this->precioInicio = new Zend_Form_Element_Select( 'precio_inicio' );
        $this->precioInicio->setLabel(
                $this->_translate->translate(
                        'precio'
                )
        );
       
        $this->precioInicio->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'desde'
                )
        );
        $this->precioInicio->addMultiOptions( $precio );*/
        //$this->addElement( $this->precioInicio );
        
        
         /* hasta */
       /* $this->precioFin = new Zend_Form_Element_Select( 'precio_fin' );     
        $this->precioFin->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'hasta'
                )
        );
        $this->precioFin->addMultiOptions( $precio );
        //$this->addElement( $this->precioFin );
        
        $this->id = new Zend_Form_Element_Hidden('id'); */
        //$this->addElement( $this->id );
        

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords(
                                $this->_translate->translate( 'buscar' )
                        )
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' );



        $this->addElements(
                array(
                    $this->palabrasBusqueda ,
                    $this->modelo ,
                    $this->fabricante ,
                    $this->categoria ,
                    $this->anioInicio ,
                    //$this->anioFin ,
                    //$this->precioInicio ,
                    //$this->precioFin ,
                    //$this->id,
                    $this->submit
                )
        );
       
        }


    }
