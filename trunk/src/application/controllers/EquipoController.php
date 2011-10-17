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

        $producto = $this->_equipo->getProduct( $id );

        if ( $producto->publicacionid ==
                Mtt_Models_Table_PublicacionEquipo::Activada )
            {
            $this->_equipo->updateView( $id );

            $this->view->assign(
                    'producto' , $producto
            );

            $form = new Mtt_Form_SearchGeneral();
            $this->view->assign( 'formSearch' , $form );

            /*             * * */

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
        else
            {
            $this->_redirect( '/default/usuario/no-autorizado' );
            }
        }


    public function verdisableAction()
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
                        '
        );

        $producto = $this->_equipo->getProduct( $id );

        if ( $producto->publicacionid !=
                Mtt_Models_Table_PublicacionEquipo::Activada )
            {
            //$this->_equipo->updateView($id);

            $this->view->assign(
                    'producto' , $producto
            );

            $form = new Mtt_Form_SearchGeneral();
            $this->view->assign( 'formSearch' , $form );
            }
        else
            {
            $this->_redirect( '/default/usuario/no-autorizado' );
            }
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
                                                           Mtt_Models_Bussines_PublicacionEquipo::Activada
        );
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
                        APPLICATION_PATH . '/../templates/template2-vacio.pdf'
        );

        $page = $pdf1->newPage( Zend_Pdf_Page::SIZE_A4 ); // 595 x842
        $font = Zend_Pdf_Font::fontWithName( Zend_Pdf_Font::FONT_TIMES );
//        $pdf->pages[] = $page;
//        $page->setFont($font, 20);$page->drawText('Zend: PDF', 10, 822);
//        $page->setFont($font, 12);$page->drawText('Comentarios', 10, $pdfY2);
//        $pdfData = $pdf->render();

        $page = $pdf1->pages[0];

        /* ficha de equipo */
        $page->setFont( $font , 18 );
        $page->drawText(
                ucwords( $this->_translate->translate( 'ficha del equipo' ) ) ,
                                                       85 , 650 );
        /* end ficha de equipo */

        /* cuerpo del equipo */

        $pdfX = 635;
        $aumento = 14;
        $pdfY = 270;
        $pdfYCabecera = 80;
        $page->setFont( $font , 12 );
        /* cabecera */

        $page->drawText( ucwords( $this->_translate->translate( 'manufactur' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/

        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'nombre del producto' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el producto' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;

        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'modelo' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el modelo' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'origen' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'origen' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'articulo id' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento - 3;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'fecha de creacion' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'peso estimado' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'lenght' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'width' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento - 2;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'height' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'box size' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'condicion de calidad' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'offerer name' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'offerer city' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'amount of equipment' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'descripcion' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText( ucwords( $this->_translate->translate( 'selling price' ) ) ,
                                                                $pdfYCabecera ,
                                                                $pdfX );
        /* valor del manufacturer */
        $page->drawText( 'aca va el manufacturer' , $pdfY , $pdfX );
        /**/




        /* fin del equipo */
        $pdfData = $pdf1->render();

        header( "Content-type: application/x-pdf" );
        header( "Content-Disposition: inline; filename=informeMedtechtrade.pdf" );
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

