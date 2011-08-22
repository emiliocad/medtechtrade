<?php

class CategoriaController extends Zend_Controller_Action
    {

    protected $_categoria;

    public function init()
        {
        parent::init();
        $this->_categoria = new Mtt_Models_Bussines_Categoria();
        }

    public function indexAction()
        {
        
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function registrarAction()
        {
        
        }

    public function verAction()
        {
        $id = $this->_getParam( 'id' , null );
        $stmt = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }

    }

?>
