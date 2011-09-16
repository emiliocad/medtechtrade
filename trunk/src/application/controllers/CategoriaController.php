<?php


class CategoriaController
        extends Mtt_Controller_Action
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
        $id = intval( $this->_getParam( 'id' , null ) );

        $stmt = $this->_categoria->getProducts( $id );

        $this->view->assign( 'productos' , $stmt );

        $stmtCategoria = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmtCategoria );

        $formOrder = new Mtt_Form_OrderEquipo();
        $this->view->assign( 'formOrder' , $formOrder);
        }


    public function paginadoAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $p = $this->_categoria->getPaginator( $id );
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->assign( 'equipos' , $p );
        }


    }

