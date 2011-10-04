<?php

class User_BusquedaController
        extends Mtt_Controller_Action
    {

    protected $_Busqueda;


    public function init()
        {
        parent::init();
        $this->_Busqueda = new Mtt_Models_Bussines_Busqueda();
        }


    public function indexAction()
        {
        
        $form = new Mtt_Form_Search();
        $this->view->assign('frmSearch', $form);

        }
   

    public function nuevoAction( )
        {
        
       
        }
        

    public function findAction() 
        {
        $criterio = $this->_request->getPost();
        $equipo = new Mtt_Models_Bussines_Equipo();
            

        $resultados = $equipo->searchEquip($criterio['keywords'], 
            $criterio['modelo'], $criterio['fabricante'], 
            $criterio['categoria_id'], $criterio['anioinicio_id'], 
            $criterio['aniofin_id'], $criterio['preciomin_id'], 
            $criterio['preciomax_id']);
        
        $form = new Mtt_Form_SaveSearch();
        $this->view->assign('frmSaveSearch', $form);
        
        $this->view->assign('criterio', $criterio);
        $this->view->assign('resultados', $resultados);
        
        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {
                unset( $criterio["buscar"] );
                $this->_Busqueda->saveBusqueda();
            }

        }
        


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_Busqueda->desactivaBusqueda( $id );
        $this->_helper->FlashMessenger( 'Busqueda Borrado' );
        $this->_redirect( $this->URL );
        }


    


    }

