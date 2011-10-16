<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_ConfigurarAlertas
        extends Mtt_Formy
    {

        
    protected $tipo;
    protected $detalle;
    protected $active;
    protected $submit;
   

    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmConfigurarAlertas' )
        ;
        
        $alertas = new Zend_Form_Element_MultiCheckbox( 'alertas' );
        
        $alertas->addMultiOption( Mtt_Models_Table_Alerta::Busqueda, 
                $this->_translate->translate('nuevo equipo en busqueda guardada')
        );
        $alertas->addMultiOption( Mtt_Models_Table_Alerta::Categoria, 
                $this->_translate->translate('nuevo equipo en categoria seleccionada')
        );
        $alertas->addMultiOption( Mtt_Models_Table_Alerta::Plataforma, 
                $this->_translate->translate('nuevo equipo en plataforma')
        );
        
        $this->addElement( $alertas );
        
       
        $categorias = new Zend_Form_Element_MultiCheckbox( 'categorias' );
        $_categorias = new Mtt_Models_Bussines_Categoria();

        foreach ( $_categorias->listCategory() as $cat )
            {
            $categorias->addMultiOption( $cat->id ,
                                       $cat->nombre );
            }
        $this->addElement( $categorias );
        
        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords($this->_translate->translate('save'))
                )
                ->setAttrib(
                        'class' , 'button'
                )
                ->setAttrib( 'type' , 'submit' )
        ;

        $this->addElement( $this->submit );
        
        
       /* $this->addElements(
                array(
                    $this->submit
                )
        );*/
        }


    }

