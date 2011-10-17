<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Mtt_Form_ConfigurarAlertas
        extends Mtt_Formy
    {

    protected $_alerts;
    protected $tipo;
    protected $detalle;
    protected $active;
    protected $submit;


    public function __construct( $data = null )
        {
        parent::__construct( $data );
        if ( !is_null( $data ) )
            {
            $this->_alerts = $data;
            }
        }

    public function init() {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmConfigurarAlertas' )
        ;

        $alerta1 = new Zend_Form_Element_Checkbox( 'alerta1' );
        $alerta1->setLabel(
                $this->_translate->translate(
                        'nuevo equipo en busqueda guardada'
                )
        );

        $alerta1->setChecked($this->_alerts[1]);
        if ($this->_alerts[1]) {
            $alerta1->setAttrib('checked', 'checked');
        }
        $this->addElement($alerta1);

        $alerta2 = new Zend_Form_Element_Checkbox( 'alerta2' );
        $alerta2->setLabel(
                $this->_translate->translate(
                        'nuevo equipo en categoria seleccionada'
                )
        );
        $alerta2->setChecked( $this->_alerts[2] );

        $this->addElement( $alerta2 );

        $categorias = new Zend_Form_Element_MultiCheckbox( 'categorias' );
        $_categorias = new Mtt_Models_Bussines_Categoria();


        foreach ( $_categorias->listCategory() as $cat )
            {
            $categorias->addMultiOption( $cat->id , $cat->nombre );
            }
        $this->addElement( $categorias );

        $alerta3 = new Zend_Form_Element_Checkbox( 'alerta3' );
        $alerta3->setLabel(
                $this->_translate->translate(
                        'nuevo equipo en plataforma'
                )
        );
        $alerta3->setChecked( $this->_alerts[3] );
        $this->addElement( $alerta3 );

        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                        ucwords( $this->_translate->translate( 'save' ) )
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
          ); */
        }


    }

