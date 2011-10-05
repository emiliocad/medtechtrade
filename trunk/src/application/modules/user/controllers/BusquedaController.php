<?php

class User_BusquedaController 
    extends Mtt_Controller_Action {

    protected $_busqueda;

    public function init() {
        parent::init();
        $this->_busqueda = new Mtt_Models_Bussines_Busqueda();
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
                
                $id = $parameters[9];
                
                //$parameters[8] captura el flag, si es 0 es un insert 
               
                if($parameters[8]== 0){
                    
                    $this->_busqueda->saveBusqueda($busqueda);
                
                } 
                //$parameters[8] captura el flag, si es 1 es un update
                if($parameters[8]== 1){
                    $this->_busqueda->updateBusqueda($busqueda, $id);
                }
               $this->_redirect( '/user/busqueda/listsearch' );

            }
        }
    }

    public function listsearchAction() {
        $listadoBusqueda = $this->_busqueda->listSearchByUserId(
                $this->authData['usuario']->id
        );

        $this->view->assign('busquedas', $listadoBusqueda);
    }

    
    public function verAction() {
        
        $id = intval($this->_request->getParam('id'));
        $criterio = $this->_busqueda->getFindId($id);
        
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
    
    

    public function editarAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Search();
        $form->flag->setValue(1);
        $form->id->setValue($id);

        $busqueda = $this->_busqueda->getFindId( $id );

        if ( !is_null( $busqueda ) )
            {
            
            $form->setDefaults( $busqueda->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 'No existe esa busqueda' );
            $this->_redirect( $this->URL );
            }
        }
    
    
    
    
    public function borrarAction() {
        $id = intval($this->_request->getParam('id'));
        $this->_busqueda->desactivarBusqueda($id);
        $this->_helper->FlashMessenger('Busqueda Borrado');
        $this->_redirect($this->URL);
    }

}

