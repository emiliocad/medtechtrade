<?php


class EquipoController
        extends Mtt_Controller_Action
    {

    protected $_equipo;


    public function init()
        {
        parent::init();
        $this->_equipo = new Mtt_Models_Catalog_Equipo();
        }


    public function indexAction()
        {

        $productos = $this->_equipo->showEquipos();
        $productos->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'productos' , $productos
        );
        }


    public function verAction()
        {
        //$this->_helper->layout->disableLayout();
        //$this->_helper->viewRenderer->setNoRender();
        $id = ( int ) ( $this->_getParam( 'id' , null ) );

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

