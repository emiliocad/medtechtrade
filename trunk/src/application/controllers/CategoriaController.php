<?php

class CategoriaController extends Mtt_Controller_Action
    {

    protected $_categoria;
    protected $URL;

    public function init()
        {
        parent::init();
        $this->_categoria = new Mtt_Models_Bussines_Categoria();
        $this->URL = '/' . $this->getRequest()->getControllerName();
        }

    public function indexAction()
        {
        $id = $this->_getParam( 'id' , null );
        $stmt = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    public function paginadoAction()
        {
        
        }

    }

?>
