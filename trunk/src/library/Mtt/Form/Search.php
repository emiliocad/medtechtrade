<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_Search
        extends Mtt_Formy
    {


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmSearch' )
        ;

        //Busqueda
        $decorator = new Mtt_Form_Decorator_SimpleInput();
        $e = new Zend_Form_Element_Text( 'keywords' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'buscar por'
                )
        );
        $this->addElement( $e );

        /* Modelo */
        $e = new Zend_Form_Element_Text( 'modelo' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'modelo'
                )
        );
        $this->addElement( $e );


        /* Fabricante */
        $e = new Zend_Form_Element_Text( 'fabricante' );
        $e->setRequired();
        //$e->setDecorators( array( $decorator ) );
        $e->setLabel(
                $this->_translate->translate(
                        'fabricante'
                )
        );
        $this->addElement( $e );

        /* Categoria */
        $e = new Zend_Form_Element_Select( 'categoria_id' );
        $e->setLabel(
                $this->_translate->translate(
                        'categoria'
                )
        );
        $_categoria = new Mtt_Models_Bussines_Categoria();
        $values = $_categoria->getComboValues();
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'categorias'
                )
        );
        $e->addMultiOptions( $values );
        $this->addElement( $e );
        $e->addValidator( new Zend_Validate_InArray( array_keys( $values ) ) );
        
         /* año desde */
        // Creando array
        $ini_year = 1980;
        $year_fin = date( 'Y' );
        for ( $i = $ini_year; $i <= $year_fin; $i++ )
            {
            $anio[$i] = $i;
          
            }
            
        
        $e = new Zend_Form_Element_Select( 'anioinicio_id' );
        $e->setLabel(
                $this->_translate->translate(
                        'desde el año'
                )
        );
       
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'desde'
                )
        );
        $e->addMultiOptions( $anio );
        $this->addElement( $e );
        
        
         /* hasta */
        $e = new Zend_Form_Element_Select( 'aniofin_id' );
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'hasta'
                )
        );
        $e->addMultiOptions( $anio );
        $this->addElement( $e );

         /* precio desde */
        //Creando array precios
        $precio = array(
            '0' => 0,
            '100' => 100,
            '500' => 500,
            '1000' => 1000,
            '2000' => 2000,
            '5000' => 5000,
            '10000' => 10000,
            '50000' => 50000
           
        );
        $e = new Zend_Form_Element_Select( 'preciomin_id' );
        $e->setLabel(
                $this->_translate->translate(
                        'precio'
                )
        );
       
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'desde'
                )
        );
        $e->addMultiOptions( $precio );
        $this->addElement( $e );
        
        
         /* hasta */
        $e = new Zend_Form_Element_Select( 'preciomax_id' );     
        $e->addMultiOption( -1 ,
                            $this->_translate->translate(
                        'hasta'
                )
        );
        $e->addMultiOptions( $precio );
        $this->addElement( $e );
        

        $this->addElement( 'submit' ,
                           $this->_translate->translate(
                        'buscar'
                )
        );
        }


    }

