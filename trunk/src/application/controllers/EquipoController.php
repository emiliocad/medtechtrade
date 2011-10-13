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
                            
                        });
                        
                        $("#searchEquipments").click(function() {
                            $( "#search" ).dialog({
                                height: 350,
                                width: 369,
                                modal: true
                            });
                        });
                        
                        '
        );

        $this->_equipo->updateView( $id );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );

        $form = new Mtt_Form_SearchGeneral();
        $this->view->assign( 'formSearch' , $form );

        /*         * * */

        if ( Zend_Auth::getInstance()->hasIdentity() )
            {
            $_reserva = new Mtt_Models_Bussines_Reserva();

            $dataReservado = $_reserva->getIdByEquipmentUser(
                    $this->authData['usuario']->id , $id ,
                    Mtt_Models_Table_TipoReserva::RESERVED );

            $dataFavorito = $_reserva->getIdByEquipmentUser(
                    $this->authData['usuario']->id , $id ,
                    Mtt_Models_Table_TipoReserva::FAVORITE );

            $this->view->assign( 'reservado' , $dataReservado );

            $this->view->assign( 'favorito' , $dataFavorito );
            }
        /**/
        }


    public function equipcategoriaAction()
        {

        $slug = $this->_getParam( 'slug' , null );
        
        $categoria = new Mtt_Models_Bussines_Categoria();
        $data = $categoria->getCategoriaBySlug( $slug );

        $id = $data->id;

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
        $equipos = $this->_equipo->pagListEquipByCategory( $id ,
            Mtt_Models_Bussines_PublicacionEquipo::Activada );
        $equipos->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'productos' , $equipos
        );
        $this->view->assign(
                'slug' , $slug
        );
        }


    public function pdfAction()
        {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $pdf1 = Zend_Pdf::load(
                        APPLICATION_PATH . '/../templates/template2.pdf'
        );

        $page = $pdf->newPage( Zend_Pdf_Page::SIZE_A4 ); // 595 x842
        $font = Zend_Pdf_Font::fontWithName( Zend_Pdf_Font::FONT_HELVETICA );
//        $pdf->pages[] = $page;
//        $page->setFont($font, 20);$page->drawText('Zend: PDF', 10, 822);
//        $page->setFont($font, 12);$page->drawText('Comentarios', 10, 802);
//        $pdfData = $pdf->render();

        $page = $pdf1->pages[0];

        /* ficha de equipo */
        $page->setFont( $font , 18 );
        $page->drawText( $this->_translate->translate( 'ficha del equipo' ) ,
                                                       116 , 639 );
        /* end ficha de equipo */

        /* cuerpo del equipo */

        $page->setFont( $font , 12 );
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'nombre del producto' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el producto' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'modelo' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el modelo' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'origen' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'origen' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/
        /*cabecera*/
        $page->drawText( $this->translate->translate( 'manufactur' ) , 116 , 639 );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , 116 , 650 );
        /**/

        $page->drawText( 'dos' , 116 , 607 );
        $page->drawText( '3' , 116 , 575 );
        $page->drawText( '4' , 116 , 543 );
        $page->drawText( 'zEND' , 200 , 200 );

        /* fin del equipo */
        $pdfData = $pdf1->render();

        header( "Content-type: application/x-pdf" );
        header( "Content-Disposition: inline; filename=result.pdf" );
        $this->_response->appendBody( $pdfData );


        $id = $this->_request->getParam( 'id' );

        $this->view->assign(
                'producto' , $this->_equipo->getProduct( $id )
        );


//        $html = $this->view->render( 'equipo/ver.phtml' );
//
//        require_once(APPLICATION_PATH . "/../library/Dompdf/dompdf_config.inc.php");
//        $informe = new DOMPDF();
//        $informe->set_paper( 'A4' , 'portrait' );
//        $informe->load_html( $html );
//        $informe->render();
//        $informe->stream( 'Medtechtrade.pdf' ); //->output()
        }


    }

