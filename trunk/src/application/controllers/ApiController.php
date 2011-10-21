<?php


class ApiController
        extends Mtt_Controller_Action
    {


    public function init()
        {
        parent::init();
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        }


    public function validarLoginAction()
        {


        if ( $this->_request->isPost() )
            {
            $_usuario = new Mtt_Models_Bussines_Usuario();

            $form = new Mtt_Form_Registrar();
            $elementLogin = $form->getElement( 'login' );
            if ( $elementLogin->isValid( $this->_getParam( 'login' ) ) )
                {
                $msg = 'OK';
                }
            else
                {
                $msg = 'ERROR';
                }

//            $login = $this->_getParam('login');
//            if ($_usuario->disponibleLogin2($login)) {
//                $msg = 'OK';
//            } else {
//                $msg = 'ERROR';
//            }
            }
        else
            {
            $msg = 'ERROR';
            $login = '';
            }

        $datos = array( 'msg' => $msg , 'login' => $login );
        $json = Zend_Json::encode( $datos );
        $this->getResponse()->appendBody( $json );
        }


    public function validarRucAction()
        {
        
        }

    }

