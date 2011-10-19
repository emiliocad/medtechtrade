<?php


class BusquedaController
        extends Mtt_Controller_Action
    {

    protected $_busqueda;
    protected $URL;


    public function init()
        {
        parent::init();
        $this->_busqueda = new Mtt_Models_Bussines_Busqueda();
        $this->URL = '/' . $this->getRequest()->getControllerName();
        parent::init();
        }


    public function indexAction()
        {
        
        }


    public function resultsearchAction()
        {

        $search = new Zend_Session_Namespace( 'MTT' );
        
        if ($this->_request->isPost() || !($search->Search=== NULL))
            {

            if($this->_request->isPost()){
                $criterio = $this->_request->getPost();
                $criterio['anio_fin'] = '-1';
                $criterio['precio_inicio'] = '-1';
                $criterio['precio_fin'] = '-1';
                //asignar valores a Session
                $this->_busqueda->setSearch($criterio);
            } 
            $busqueda = $this->_busqueda->getSearch(); 
            
            $equipo = new Mtt_Models_Bussines_Equipo();
            $resultados = $equipo->pagListResultSearch(
                    $busqueda->palabras_busqueda
                    , $busqueda->modelo
                    , $busqueda->fabricante
                    , $busqueda->categoria_id
                    , $busqueda->anio_inicio
                    , $busqueda->anio_fin
                    , $busqueda->precio_inicio 
                    , $busqueda->precio_fin );
            $resultados->setCurrentPageNumber(
                    $this->_getParam( 'page' , 1 )
            );
            $this->view->assign( 'productos' , $resultados );
            }
        else
            {
            $this->_helper->FlashMessenger('no efectuo la busqueda');
            $this->_redirect('/index');
            }
        }


    public function listsearchAction()
        {
        $listadoBusqueda = $this->_busqueda->listSearchByUserId(
                $this->authData['usuario']->id
        );

        $this->view->assign( 'busquedas' , $listadoBusqueda );
        }


    }

