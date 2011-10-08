<?php
/**
 * 
 */
class EquipoController
        extends Mtt_Controller_Action
    {

    protected $_equipo;


    public function init()
        {
        parent::init();
        $this->_equipo = new Mtt_Models_Catalog_Equipo();
        }


    /**
     * 
     */
    public function indexAction()
        {
        $formOrder = new Mtt_Form_OrderEquipo();

        $productos = $this->_equipo->showEquipos();

        $productos->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );



        $this->view->assign( 'formOrder' , $formOrder );
        $this->view->assign(
                'productos' , $productos
        );
        }


    public function verAction()
        {
        //$this->_helper->layout->disableLayout();
        //$this->_helper->viewRenderer->setNoRender();

        $id = ( int ) ( $this->_getParam( 'id' , null ) );

        $this->view
                ->headScript()
                ->appendFile( '/js/fancybox/jquery.fancybox-1.3.4.pack.js' ,
                              'text/javascript' );
        $this->view->headLink()
                ->appendStylesheet( '/js/fancybox/jquery.fancybox-1.3.4.css' );
        $this->view->jQuery()
                ->addOnLoad(
                        '$(document).ready(function() {
                            $(".fancy").fancybox();
                        });'
        );

        $this->_equipo->updateView( $id );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );
        }


    public function pdfAction()
        {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();


        $id = $this->_request->getParam( 'id' );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );

        //$this->view->venta = $this->_venta->fetchRow( 'id = ' . $id )->toArray();
        $html = $this->view->render( 'equipo/ver.phtml' );

        require_once(APPLICATION_PATH . "/../library/Dompdf/dompdf_config.inc.php");
        $pdf = new DOMPDF();
        $pdf->set_paper( 'A4' , 'portrait' );
        $pdf->load_html( $html );
        $pdf->render();
        $pdf->stream( 'Medtechtrade.pdf' ); //->output()
        }


    }

