<?php

class User_BusquedaController extends Mtt_Controller_Action {

    protected $_busqueda;

    public function init() 
        {
        parent::init();
        $this->_busqueda = new Mtt_Models_Bussines_Busqueda();
        }

    public function indexAction() 
        {
        
        $search = new Zend_Session_Namespace( 'MTT' );
        unset($search->Search->Id);
        $search->Search = NULL;
        $form = new Mtt_Form_Search();
        $this->view->assign('frmSearch', $form);
        }

    public function nuevoAction() 
        {
        
        }

    public function findAction() 
        {
        
        $search = new Zend_Session_Namespace( 'MTT' );
        
        if ($this->_request->isPost() || !($search->Search=== NULL))
            {
            if($this->_request->isPost()){
                $criterio = $this->_request->getPost();
                //asignar valores a Session
                $this->_busqueda->setSearch($criterio);
            } 
            //Obtener busquedas en Session
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
                    , $busqueda->precio_fin);
            $resultados->setCurrentPageNumber(
                        $this->_getParam('page', 1)
            );
            
            $form = new Mtt_Form_SaveSearch();
            $this->view->assign('frmSaveSearch', $form);
            $this->view->assign('resultados', $resultados);
      
            }
        else 
            {

            $this->_helper->FlashMessenger($this->_translate->translate('no efectuo la busqueda'));
            $this->_redirect('/user/busqueda');
            }
        
        }
        

    public function savesearchAction() 
        {
        $search = new Zend_Session_Namespace( 'MTT' );
        //$this->_helper->layout()->disableLayout();
       
        if(isset( $search->Search))
            {
            $data = (array)$search->Search;
            $data['usuario_id'] = $this->authData['usuario']->id;
            
            if(isset($search->Search->Id))
                {
                $this->_busqueda->updateBusqueda($data, $search->Search->Id);
                } 
            else 
                {
                
                $this->_busqueda->saveBusqueda($data);    
                }
  
            $this->_redirect('/user/busqueda/listsearch');
            }
        }        
        
        
        

    public function listsearchAction() 
        {
        
        $busquedas = $this->_busqueda->pagListSearchByUserId( 
                $this->authData['usuario']->id
        );
        
        $busquedas->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'busquedas', $busquedas);
       
        }

    public function verAction() {

        $id = intval($this->_request->getParam('id'));
        $criterio = $this->_busqueda->getFindId($id);

        $equipo = new Mtt_Models_Bussines_Equipo();
        $resultados = $equipo->pagListResultSearch(
                $criterio->palabras_busqueda
                , $criterio->modelo
                , $criterio->fabricante
                , $criterio->categoria_id
                , $criterio->anio_inicio
                , $criterio->anio_fin
                , $criterio->precio_inicio
                , $criterio->precio_fin
        );
        $resultados->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign('resultados', $resultados);
    }

    public function editarAction() {

        $id = intval($this->_getParam('id'));

        $form = new Mtt_Form_Search();

        $busqueda = $this->_busqueda->getFindId($id);

        if (!is_null($busqueda)) 
            {
            $search = new Zend_Session_Namespace( 'MTT' );
            $search->Search->Id = $id;
            $form->setDefaults($busqueda->toArray());
            $this->view->assign('form', $form);
            } 
        else 
            {
            $this->_helper->FlashMessenger($this->_translate->translate('No existe esa busqueda'));
            $this->_redirect($this->URL);
            }
    }

    public function borrarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_busqueda->desactivarBusqueda($id);
        $this->_helper->FlashMessenger($this->_translate->translate('Busqueda Borrado'));
        $this->_redirect('/user/busqueda/listsearch');
    }

}

