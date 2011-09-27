<?php

class User_FavoritoEquipoUsuarioController
        extends Mtt_Controller_Action
    {

    protected $_favoritoEquipoUsuario;


    public function init()
        {
        parent::init();
        $this->_favoritoEquipoUsuario = 
                new Mtt_Models_Bussines_FavoritoEquipoUsuario();
        }


    public function indexAction()
        {
       
        }
   

    public function nuevoAction( )
        {
        
        $idEquipo = ( int ) ( $this->_getParam( 'id' , null ) );
        
        //$this->_helper->layout->disableLayout();
        //$this->_helper->viewRenderer->setNoRender();
        

                
        $favorito = $this->_favoritoEquipoUsuario->getByEquipoUser( 
                $this->authData['usuario']->id,
                $idEquipo );
        
        if(count($favorito) == 0)
            {
            $data = array(
                'equipo_id' => $idEquipo,
                'usuario_id' => $this->authData['usuario']->id,
                'fechagrabacion' => date('Y-m-d H:i:s')
            );

            $this->_favoritoEquipoUsuario->saveFavoritoEquipoUsuario( $data );
            } 
        else 
            {
            $this->_favoritoEquipoUsuario->activarFavoritoEquipoUsuario( 
                    $favorito[0]->id
            );
            }
        }


    public function borrarAction()
        {

        }


    


    }

