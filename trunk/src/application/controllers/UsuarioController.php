<?php

class UsuarioController extends Zend_Controller_Action
    {

    public function init()
        {
        parent::init();
        }

    public function indexAction()
        {
        
        }

    public function loginAction()
        {
        $frmlogin = new Mtt_Form_Login();
        $this->view->assign( 'formlogin' , $frmlogin );
        }

    public function paginadoAction()
        {
        $p = $this->_usuario->getPaginator();
        $p->setCurrentPageNumber( $this->_getParam( 'page' , 1 ) );
        $this->view->usuarios = $p;
        }

    public function signUpAction()
        {
        $this->view->headScript()->appendFile( '/js/user.sigunp.js' );
        $form = new Mtt_Form_Registrar();
        $values = $this->_request->getPost();
        if($this->_request->isPost() && $form->isValid($values) ){
            $categoria = $form->getValues();
            $categoria['activo'] = 1;
            $slugger = new My_Filter_Slug(array(
                'field' => 'slug',
                'model' => $this->_categoria
            ));
            $categoria['slug'] = $slugger->filter($form->getValue('nombre'));
            unset($categoria['token']);
            $this->_categoria->insert($categoria);
            $this->_helper->FlashMessenger('Se agregó una categoría');
            $this->_redirect($this->URL);
        }
        $this->view->form = $form;
        
        
        }

    }

?>
