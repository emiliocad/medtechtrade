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

        $slug = $this->_getParam( 'slug' , null );

        $id = $this->_equipo->getEquipmentBySlug( $slug )->id;

        $this->view->jQuery()
                ->addJavascriptFile(
                        '/js/jquery.lightbox/jquery.lightbox-0.5.js'
                )
                ->addStylesheet(
                        '/js/jquery.lightbox/jquery.lightbox-0.5.css'
        );
        $this->view->jQuery()
                ->addOnLoad(
                        '$(document).ready(function() {
                            $("#device-foto-galery a").lightBox(
                            {fixedNavigation:true}
                            );
                        });'
        );

        $this->_equipo->updateView( $id );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );
        }



    public function equipcategoriaAction()
        {

        $slug = $this->_getParam( 'slug' , null );
        //$id = $this->_getParam( 'id' , null );

        $id = $this->_equipo->getEquipmentBySlug( $slug )->id;

        $this->view->jQuery()
                ->addJavascriptFile(
                        '/js/jquery.lightbox/jquery.lightbox-0.5.js'
                )
                ->addStylesheet(
                        '/js/jquery.lightbox/jquery.lightbox-0.5.css'
        );
        $this->view->jQuery()
                ->addOnLoad(
                        '$(document).ready(function() {
                            $("#device-foto-galery a").lightBox(
                            {fixedNavigation:true}
                            );
                        });'
        );

        //$this->_equipo->updateView( $id );
        $equipos = $this->_equipo->pagListEquipByCategory( $id, 
                Mtt_Models_Bussines_PublicacionEquipo::Activada );
        $equipos->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'productos' , $equipos
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

