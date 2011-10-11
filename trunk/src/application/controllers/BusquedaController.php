<?php

class BusquedaController 
    extends Mtt_Controller_Action {
    
    protected $_busqueda;
    protected $URL;

    public function init() {
        parent::init();
        $this->_busqueda = new Mtt_Models_Bussines_Busqueda();
        $this->URL = '/' . $this->getRequest()->getControllerName();
        parent::init();
    }

    public function indexAction() {
        
    }

    public function resultsearchAction() {

        if ($this->_request->isPost()) {

            //Obtener busquedas en Session
            $busqueda = $this->_request->getPost();

            $equipo = new Mtt_Models_Bussines_Equipo();
            $resultados = $equipo->pagListResultSearch(
                    $busqueda['palabras_busqueda']
                    , $busqueda['modelo']
                    , $busqueda['fabricante']
                    , $busqueda['categoria_id']
                    , $busqueda['anio_inicio']
                    , '-1'
                    , '-1'
                    , '-1');
            $resultados->setCurrentPageNumber(
                    $this->_getParam('page', 1)
            );
            $this->view->assign('productos', $resultados);
        } else {

            //$this->_helper->FlashMessenger('no efectuo la busqueda');
            //$this->_redirect('/index');
        }
    }


    public function listsearchAction() {
        $listadoBusqueda = $this->_busqueda->listSearchByUserId(
                $this->authData['usuario']->id
        );

        $this->view->assign('busquedas', $listadoBusqueda);
    }

}

