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


    public function preDispatch()
        {
//        $contextSwitch = $this->_helper->getHelper( 'contextSwitch' );
//        $contextSwitch->addActionContext(
//                        'borrarreserva' , 'json' , 'html' )
//                ->initContext();
        parent::preDispatch();
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

        $this->_helper->layout->setLayout( 'layoutListado' );
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
            }
        else
            {
            $this->_reserva->activarReserva(
                    $favorito[0]->id
            );
            }
        $this->_helper->FlashMessenger( 'Se agrego como Favorito' );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function agregarreservaAction()
        {

        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );

        $reservaEquip = $this->_reserva->getReservaByEquipUser(
                $this->authData['usuario']->id , $idEquipo ,
                Mtt_Models_Table_TipoReserva::RESERVED );

        if ( count( $reservaEquip ) == 0 )
            {
            $data = array(
                'equipo_id' => $idEquipo ,
                'usuario_id' => $this->authData['usuario']->id ,
                'fechagrabacion' => date( 'Y-m-d H:i:s' ) ,
                'tipo_reserva_id' => Mtt_Models_Table_TipoReserva::RESERVED
            );

            $this->_reserva->saveReserva( $data );
            }
        else
            {
            $this->_reserva->activarReserva(
                    $favorito[0]->id
            );
            }
        $this->_helper->FlashMessenger( 'Se agrego como la reserva' );
        $this->_redirect( $_SERVER['HTTP_REFERER'] );
        }


    public function borrarfavoritoAction()
        {

        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_reserva->desactivarReserva( $id );
        $this->_helper->FlashMessenger( 'Elemento Borrado' );
        $this->_redirect( $this->URL . "/favoritos" );
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
        //$this->_helper->FlashMessenger( 'reserva eliminada' );
//        $this->_redirect( $this->URL . "/favoritos" );
        }


    }

