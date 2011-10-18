<?php

/**
 * 
 */
class EquipoController extends Mtt_Controller_Action {

    protected $_equipo;

    public function init() {
        parent::init();
        $this->_equipo = new Mtt_Models_Catalog_Equipo();
    }

    /**
     * 
     */
    public function indexAction() {
        $formOrder = new Mtt_Form_OrderEquipo();

        $productos = $this->_equipo->showEquipos();

        $productos->setCurrentPageNumber(
                $this->_getParam('page', 1)
        );

        $this->view->assign('formOrder', $formOrder);
        $this->view->assign(
                'productos', $productos
        );
    }

    public function verAction() {

        $slug = $this->_getParam('slug', null);

        $id = $this->_equipo->getEquipmentBySlug($slug)->id;

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
                        
                        $(".device-action-friend").click(function(){
                            $("#dialogToSendFriend").dialog({
                                height: 160,
                                width: 360,
                                modal: true
                            });
                        });
                        $(".device-action-help").click(function(){
                            alert($(this).attr("href"));
                            $("#dialogHelp").dialog({
                                height: 200,
                                width: 540,
                                modal: true


                            });
                            
                        });
                        '
        );

        $producto = $this->_equipo->getProduct($id);

        if ($producto->publicacionid ==
                Mtt_Models_Table_PublicacionEquipo::Activada) {
            $this->_equipo->updateView($id);

            $this->view->assign(
                    'producto', $producto
            );

            $form = new Mtt_Form_SearchGeneral();
            $this->view->assign('formSearch', $form);

            $formEnviarAmigo = new Mtt_Form_EnviarAmigo();
            $this->view->assign('formEnviarAmigo', $formEnviarAmigo);
            /*             * * */

            if (Zend_Auth::getInstance()->hasIdentity()) {
                $_reserva = new Mtt_Models_Bussines_Reserva();

                $dataReservado = $_reserva->getIdByEquipmentUser(
                        $this->authData['usuario']->id, $id, Mtt_Models_Table_TipoReserva::RESERVED);

                $dataFavorito = $_reserva->getIdByEquipmentUser(
                        $this->authData['usuario']->id, $id, Mtt_Models_Table_TipoReserva::FAVORITE);

                $this->view->assign('reservado', $dataReservado);

                $this->view->assign('favorito', $dataFavorito);
            }
            /**/
        } else {
            $this->_redirect('/default/usuario/no-autorizado');
        }
    }

    public function verdisableAction() {

        $slug = $this->_getParam('slug', null);

        $id = $this->_equipo->getEquipmentBySlug($slug)->id;

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

        $producto = $this->_equipo->getProduct($id);

        if ($producto->publicacionid !=
                Mtt_Models_Table_PublicacionEquipo::Activada) {
            //$this->_equipo->updateView($id);

            $this->view->assign(
                    'producto', $producto
            );

            $form = new Mtt_Form_SearchGeneral();
            $this->view->assign('formSearch', $form);
        } else {
            $this->_redirect('/default/usuario/no-autorizado');
        }
    }

    public function equipcategoriaAction() {

        $slug = $this->_getParam('slug', null);

        $categoria = new Mtt_Models_Bussines_Categoria();
        $data = $categoria->getCategoriaBySlug($slug);

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
        $equipos = $this->_equipo->pagListEquipByCategory(
                $id, Mtt_Models_Bussines_PublicacionEquipo::Activada
        );
        $equipos->setCurrentPageNumber(
                $this->_getParam('page', 1)
        );
        $this->view->assign(
                'productos', $equipos
        );
        $this->view->assign(
                'slug', $slug
        );
    }

    public function sendtofriendAction() {
        $this->view->jQuery()->addJavascriptFile( '/js/equipo.js' );
    }
    
    public function pdfAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $idEquipo = $this->_request->getParam('id');

        $_equipo = new Mtt_Models_Bussines_Equipo();
        $dataEquipo = $_equipo->getProduct($idEquipo);



        $pdf1 = Zend_Pdf::load(
                        APPLICATION_PATH . '/../templates/template-2.pdf'
        );

        $page = $pdf1->newPage(Zend_Pdf_Page::SIZE_A4); // 595 x842
        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_TIMES);
//        $pdf->pages[] = $page;
//        $page->setFont($font, 20);$page->drawText('Zend: PDF', 10, 822);
//        $page->setFont($font, 12);$page->drawText('Comentarios', 10, $pdfY2);
//        $pdfData = $pdf->render();

        $page = $pdf1->pages[0];

        /* ficha de equipo */
        $page->setFont($font, 14);
        $page->setFillColor(new Zend_Pdf_Color_Html('#B91E1D'));
        $page->drawText(
                ucwords($this->_translate->translate('ficha del equipo')), 23, 696);
        /* end ficha de equipo */

        /* cuerpo del equipo */

        $pdfX = 675;
        $aumento = 16;
        $pdfY = 175;
        $pdfYCabecera = 33;
        $page->setFont($font, 11);
        $page->setFillColor(new Zend_Pdf_Color_Html('#355F91'));
        /* cabecera */

        $page->drawText(ucwords($this->_translate->translate('manufactur')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->fabricante, $pdfY, $pdfX);
        /**/

        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('nombre del producto')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->nombre, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;

        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('modelo')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->modelo, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('origen')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->pais, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('articulo id')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->id, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento - 3;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('fecha de creacion')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->fechafabricacion, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('peso estimado')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->pesoEstimado, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('lenght')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->sizeCaja, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('width')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->ancho, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento - 2;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('height')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->alto, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('box size')), $pdfYCabecera, $pdfX);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->sizeCaja, $pdfY, $pdfX);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('condicion de calidad')), $pdfYCabecera, 507);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->calidad, $pdfY, 507);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('offerer name')), $pdfYCabecera, 495);
        /* valor del manufacturer */
        $page->drawText('', $pdfY, 495);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('offerer city')), $pdfYCabecera, 480);
        /* valor del manufacturer */
        $page->drawText('', $pdfY, 480);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('amount of equipment')), $pdfYCabecera, 465);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->cantidad, $pdfY, 465);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('descripcion')), $pdfYCabecera, 433);
        /* TODO descripcion */
        $page->drawText("dkflksdjflksdjflkjsdlkfjsdlkfjsd <br/>   
            dskfjsdlkfjlsdkjfsdlkf ", $pdfY, 421);
        /**/
        $pdfX -= $aumento;
        /* cabecera */
        $page->drawText(ucwords($this->_translate->translate('selling price')), $pdfYCabecera, 339);
        /* valor del manufacturer */
        $page->drawText($dataEquipo->precioventa, $pdfY, 339);
        /**/




        /* fin del equipo */
        $pdfData = $pdf1->render();

        header("Content-type: application/x-pdf");
        header("Content-Disposition: inline; filename=informeMedtechtrade.pdf");
        $this->_response->appendBody($pdfData);

//
//        $id = $this->_request->getParam( 'id' );
//
//        $this->view->assign(
//                'producto' , $this->_equipo->getProduct( $id )
//        );
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

