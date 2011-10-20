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


    public function verAction()
        {
        $slug = $this->_getParam( 'slug' , NULL );

        $data = $this->_categoria->getCategoriaBySlug( $slug );

        $id = $data->id;


        $order = $this->_getParam( 'order' , 'modelo' );


        $stmt = $this->_categoria->getProducts( $id , $order );

        $this->view->assign( 'productos' , $stmt );

        $stmtCategoria = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmtCategoria );

        $formOrder = new Mtt_Form_OrderEquipo();
        $this->view->assign( 'formOrder' , $formOrder );

        $_equipo = new Mtt_Models_Catalog_Equipo();
        $this->view->assign(
                'equipoOfert'
                , $_equipo->showEquiposOfersByCategory( $id )
        );
        
        //$url = new Zend_Session_Namespace( 'MTT' );
        //$url->url= $this->URL .'/'. $slug;
        
        }


    public function indexAction()
        {

        $id = intval( $this->_getParam( 'id' , null ) );


        $order = $this->_getParam( 'order' , 'modelo' );


        $stmt = $this->_categoria->getProducts( $id , $order );

        $this->view->assign( 'productos' , $stmt );



        $stmtCategoria = $this->_categoria->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmtCategoria );



        $formOrder = new Mtt_Form_OrderEquipo();
        $this->view->assign( 'formOrder' , $formOrder );

        $_equipo = new Mtt_Models_Catalog_Equipo();
        $this->view->assign(
                'equipoOfert'
                , $_equipo->showEquiposOfersByCategory( $id )
        );
        }


    }

