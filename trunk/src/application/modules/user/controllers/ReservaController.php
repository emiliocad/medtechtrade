<?php


class User_ReservaController
        extends Mtt_Controller_Action
    {

    protected $_reserva;
    public $ajaxable = array(
        'borrarreserva' => array( 'html' , 'json' )
    );


    public function init()
        {
        parent::init();


        $this->_reserva =
                new Mtt_Models_Bussines_Reserva();

        $this->_helper->getHelper( 'ajaxContext' )->initContext();
        }


    public function indexAction()
        {
        
        }


    public function favoritosAction()
        {
        $this->view->jQuery()
                ->addStylesheet(
                        $this->view->baseUrl() . '/css/reserva.css'
        );
        $reserva = $this->_reserva->pagListFavoritosByUser(
                $this->authData['usuario']->id ,
                Mtt_Models_Bussines_TipoReserva::FAVORITE
        );
        $reserva->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 ) );
        $this->view->assign(
                'favoritos' , $reserva
        );
        }


    public function reservasAction()
        {

        $this->view->jQuery()->addJavascriptFile( '/js/reserva.js' );
        $reserva = $this->_reserva->pagListFavoritosByUser(
                $this->authData['usuario']->id ,
                Mtt_Models_Bussines_TipoReserva::RESERVED
        );
        $reserva->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 ) );
        $this->view->assign(
                'favoritos' ,
                $reserva                
        );
        }


    public function stadisticsreservasAction()
        {
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() . "/js/statistic/js/jquery.js" );
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() . "/js/statistic/js/highcharts.js" );
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() .
                "/js/statistic/js/modules/exporting.js" );
        $this->view->assign( 'equipos' ,
                             $this->_equipo->listEquipMoreReserved( 10 ) );
        }


    public function stadisticsfavoritosAction()
        {
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() . "/js/statistic/js/jquery.js" );
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() . "/js/statistic/js/highcharts.js" );
        $this->view->headScript()->appendFile(
                $this->view->baseUrl() .
                "/js/statistic/js/modules/exporting.js" );
        $this->view->assign( 'equipos' ,
                             $this->_reserva->listEquipFavoritos( 10 ) );
        }


    public function agregarfavoritoAction()
        {

        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );

        $favorito = $this->_reserva->getReservaByEquipUser(
                $this->authData['usuario']->id , $idEquipo ,
                Mtt_Models_Table_TipoReserva::FAVORITE
        );

        if ( count( $favorito ) == 0 )
            {
            $data = array(
                'equipo_id' => $idEquipo ,
                'usuario_id' => $this->authData['usuario']->id ,
                'fechagrabacion' => date( 'Y-m-d H:i:s' ) ,
                'tipo_reserva_id' => Mtt_Models_Table_TipoReserva::FAVORITE
            );

            $this->_reserva->saveReserva( $data );
            $this->_helper->FlashMessenger( $this->_translate->translate('Se agrego como Favorito' ));
            }

        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function agregarreservaAction()
        {

        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );

        $reservaEquip = $this->_reserva->getReservaByEquipUser(
                $this->authData['usuario']->id , $idEquipo ,
                Mtt_Models_Table_TipoReserva::RESERVED );

        if ( count( $reservaEquip ) === 0 )
            {
            $data = array(
                'equipo_id' => $idEquipo ,
                'usuario_id' => $this->authData['usuario']->id ,
                'fechagrabacion' => date( 'Y-m-d H:i:s' ) ,
                'tipo_reserva_id' => Mtt_Models_Table_TipoReserva::RESERVED
            );

            $this->_reserva->saveReserva( $data );
            $this->_helper->FlashMessenger( $this->_translate->translate('Se agrego como la reserva' ));
            }


        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function borrarfavoritoAction()
        {

        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_reserva->desactivarReserva( $id );
        $this->_helper->FlashMessenger( $this->_translate->translate('se quito de favoritos' ));
        $this->_redirect( $this->URL . "/favoritos" );
        }


    public function quitarfavoritoAction()
        {
        $idEquipo = ( int ) $this->_getParam( 'id' , null );
        $data = $this->_reserva->getIdByEquipmentUser(
                $this->authData['usuario']->id , $idEquipo ,
                Mtt_Models_Table_TipoReserva::FAVORITE );

        $this->view->assign( 'data' , $data );

        $this->_reserva->deleteReserva(
                $data->id
        );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function quitarreservaAction()
        {
        $idEquipo = ( int ) $this->_getParam( 'id' , null );
        $data = $this->_reserva->getIdByEquipmentUser(
                $this->authData['usuario']->id , $idEquipo ,
                Mtt_Models_Table_TipoReserva::RESERVED );

        $this->view->assign( 'data' , $data );

        $this->_reserva->deleteReserva(
                $data->id
        );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function borrarreservaAction()
        {

        $id = ( int ) $this->_request->getParam( 'id' , null );
        //$id = $_GET['id'];
        //$this->_reserva->desactivarReserva( $id );
        $this->_reserva->deleteReserva( $id );
        $this->view->assign( 'id' , $id );
        if ( $this->_request->isXmlHttpRequest() )
            {

            $this->view->assign( 'sms' ,
                                 $this->_translate->translate(
                            'reserva eliminada'
                    )
            );
            }
        //$this->_helper->FlashMessenger( $this->_translate->translate('reserva eliminada') );
//        $this->_redirect( $this->URL . "/favoritos" );
        }


    }


