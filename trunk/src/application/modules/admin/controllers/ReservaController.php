<?php

class Admin_ReservaController
        extends Mtt_Controller_Action
    {

    protected $_reserva;


    public function init()
        {
        parent::init();
        $this->_reserva = 
                new Mtt_Models_Bussines_Reserva();
        }


    public function indexAction()
        {
      
        }
        

    public function favoritosAction()
        {
        $this->view->assign(
                'favoritos' , 
                $this->_reserva->getReservaByUser(
                        $this->authData['usuario']->id, 
                        Mtt_Models_Bussines_TipoReserva::FAVORITE
                        
                )
        );
        }        
   


    public function equiposreservadosAction()
        {
        $this->view->assign(
                'equipos' , 
                $this->_reserva->getReservaByType(
                        Mtt_Models_Bussines_TipoReserva::RESERVED
                        
                )
        );
        }  
                
        
        
        
    public function reservasAction()
        {
        $this->view->assign(
                'favoritos' , 
                $this->_reserva->getReservaByUser(
                        $this->authData['usuario']->id, 
                        Mtt_Models_Bussines_TipoReserva::RESERVED
                        
                )
        );
        }  
      
        
    public function stadisticsreservasAction()
        {
         $this->view->headScript()->appendFile(
                 $this->view->
                 baseUrl()."/js/estadistica/fgCharting.jQuery.js");
         $this->view->headScript()->appendFile(
                 $this->view->
                 baseUrl()."/js/estadistica/excanvas-compressed.js");
         $this->view->jQuery()
                  ->addOnLoad(
                        '$(document).ready(function() {
                            if($.browser.msie) { 
                                setTimeout(function(){$.fgCharting();}, 2000);
                            } else {
                                $.fgCharting();
                            }	
                        });'
                );
         $this->view->assign( 'equipos' ,
                 $this->_reserva->listEquipMoreReserved( 10,
                 Mtt_Models_Table_TipoReserva::RESERVED        
                 )
         );
        }        


    public function stadisticsfavoritosAction()
        {
         $this->view->headScript()->appendFile(
                 $this->view->
                 baseUrl()."/js/estadistica/fgCharting.jQuery.js");
         $this->view->headScript()->appendFile(
                 $this->view->
                 baseUrl()."/js/estadistica/excanvas-compressed.js");
         $this->view->jQuery()
                  ->addOnLoad(
                        '$(document).ready(function() {
                            if($.browser.msie) { 
                                setTimeout(function(){$.fgCharting();}, 2000);
                            } else {
                                $.fgCharting();
                            }	
                        });'
                );
         $this->view->assign( 'equipos' ,
                 $this->_reserva->listEquipMoreReserved( 10,
                 Mtt_Models_Table_TipoReserva::FAVORITE
                 )
         );
        }                   
        
        
        
    public function agregarfavoritoAction( )
        {
        
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
                  
        $favorito = $this->_reserva->getReservaByEquipUser( 
                $this->authData['usuario']->id,
                $idEquipo,
                Mtt_Models_Table_TipoReserva::FAVORITE);
        
        if(count($favorito) == 0)
            {
            $data = array(
                'equipo_id' => $idEquipo,
                'usuario_id' => $this->authData['usuario']->id,
                'fechagrabacion' => date('Y-m-d H:i:s'),
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
        }
        

        
    public function agregarreservaAction( )
        {
        
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );
        
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
                  
        $reservaEquip = $this->_reserva->getReservaByEquipUser( 
                $this->authData['usuario']->id,
                $idEquipo,
                Mtt_Models_Table_TipoReserva::RESERVED);
        
        if(count($reservaEquip) == 0)
            {
            $data = array(
                'equipo_id' => $idEquipo,
                'usuario_id' => $this->authData['usuario']->id,
                'fechagrabacion' => date('Y-m-d H:i:s'),
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
        }


    public function borrarAction()
        {

        }
        
    


    


    }

