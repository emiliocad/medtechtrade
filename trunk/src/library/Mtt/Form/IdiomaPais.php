<?php


/**
 * 
 */
class Mtt_Form_IdiomaPais
        extends Mtt_Form
    {

    protected $idioma;
    protected $pais;
    protected $recordar;
    protected $submit;
    protected $_idioma;
    protected $_pais;
    protected $_data;


    /**
     *
     * @param type $data 
     */
    public function __construct( $data = null )
        {
        $this->_idioma = new Mtt_Models_Bussines_Idioma();
        $this->_pais = new Mtt_Models_Bussines_Paises();
        if ( isset( $data ) )
            {
            $this->_data = $data;
            }
        parent::__construct();
        }


    public function __destruct()
        {

        $this->_idioma = NULL;
        $this->_pais = NULL;
        }


    public function init()
        {

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmIdiomaPais' )
                ->setAction( '/default/idioma/index' )
        ;

        $this->pais = new Zend_Form_Element_Select( 'pais' );

        $this->pais->setLabel(
                        $this->_translate->translate( 'mi pais de residencia' )
                )
                ->addMultiOption( -1 ,
                                  $this->_translate->translate( 'escoger pais' )
                )
                ->addMultiOptions(
                        $this->_pais->getComboValuesIntegrate()
                )
                ->addValidator(
                        new Zend_Validate_InArray(
                                array_keys( $this->_pais->getComboValues() )
                        )
                )
                ->setAttrib( 'style' , 'width:100px' );

        if ( isset( $this->_data['pais'] ) )
            {
            $this->pais->setValue( $this->_data['pais'] );
            }

        ;
        $this->addElement( $this->pais );


        $this->idioma = new Zend_Form_Element_Select( 'idioma' );
        $this->idioma->setLabel(
                        $this->_translate->translate( 'mi idioma' )
                )
                ->addMultiOption( -1 ,
                                  $this->_translate->translate(
                                'escoger idioma' )
                )
                ->addMultiOptions(
                        $this->_idioma->getComboValuesPrefijo()
                )
                ->addValidator(
                        new Zend_Validate_InArray(
                                array_keys(
                                        $this->_idioma->getComboValuesPrefijo()
                                )
                        )
        );
        if ( isset( $this->_data['idioma'] ) )
            {
            $this->pais->setValue( $this->_data['idioma'] );
            }

        ;
        $this->addElement( $this->idioma );


        $this->recordar = new Zend_Form_Element_Checkbox( 'recordar' );
        $this->recordar->setLabel(
                $this->_translate->translate( 'recordar mi configuracion' )
        )
        ;
        $this->addElement( $this->recordar );


        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                $this->_translate->translate( 'siguiente' ) );
        $this->submit->setAttrib( 'type' , 'submit' )

        ;
        $this->addElement( $this->submit );
        }


    }

