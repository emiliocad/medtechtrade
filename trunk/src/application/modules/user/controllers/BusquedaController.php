<?php

class User_BusquedaController 
    extends Mtt_Controller_Action {

    protected $_Busqueda;

    public function init() {
        parent::init();
        $this->_Busqueda = new Mtt_Models_Bussines_Busqueda();
    }

    public function indexAction() {

        $form = new Mtt_Form_Search();
        $this->view->assign('frmSearch', $form);
    }

    public function nuevoAction() {
        
    }

    public function findAction() {

        if ($this->_request->getPost()) {

            $criterio = $this->_request->getPost();
            $equipo = new Mtt_Models_Bussines_Equipo();

            if (isset($criterio['buscar'])) {
                $resultados = $equipo->searchEquip(
                        $criterio['palabras_busqueda'], 
                        $criterio['modelo'], 
                        $criterio['fabricante'], 
                        $criterio['categoria_id'], 
                        $criterio['anio_inicio'], 
                        $criterio['anio_fin'], 
                        $criterio['precio_inicio'], 
                        $criterio['precio_fin']
                );

                $parameters_hid = implode(",", $criterio);

                $form = new Mtt_Form_SaveSearch();
                $form->parameters->setValue($parameters_hid);

                $this->view->assign('frmSaveSearch', $form);

                $this->view->assign('criterio', $criterio);
                $this->view->assign('resultados', $resultados);
            } else {
                $getDatos = $this->_request->getPost();
                
                $parameters = explode(",", $getDatos['parameters']);
                $busqueda = array(
                    'palabras_busqueda' => $parameters[0],  
                    'modelo' => $parameters[1],
                    'fabricante' => $parameters[2], 
                    'categoria_id' => $parameters[3], 
                    'anio_inicio' => $parameters[4], 
                    'anio_fin' => $parameters[5], 
                    'precio_inicio' => $parameters[6], 
                    'precio_fin' => $parameters[7],
                    'usuario_id' => $this->authData['usuario']->id
                );
               
                $this->_Busqueda->saveBusqueda($busqueda);
                $this->_redirect( '/user/busqueda/listsearch' );
            }
        }
    }

    public function listsearchAction() {
        $listadoBusqueda = $this->_Busqueda->listSearchByUserId(
                $this->authData['usuario']->id
        );

        $this->view->assign('busquedas', $listadoBusqueda);
    }

    
    public function verAction() {
        $id = intval($this->_request->getParam('id'));
        $criterio = $this->_Busqueda->listById($id);
        
        $equipo = new Mtt_Models_Bussines_Equipo();
        $resultados = $equipo->searchEquip(
                        $criterio->palabras_busqueda, 
                        $criterio->modelo, 
                        $criterio->fabricante, 
                        $criterio->categoria_id, 
                        $criterio->anio_inicio, 
                        $criterio->anio_fin, 
                        $criterio->precio_inicio, 
                        $criterio->precio_fin
                );
        $this->view->assign('resultados', $resultados);
    }    
    
    
    public function borrarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_Busqueda->desactivaBusqueda($id);
        $this->_helper->FlashMessenger('Busqueda Borrado');
        $this->_redirect($this->URL);
    }

}

