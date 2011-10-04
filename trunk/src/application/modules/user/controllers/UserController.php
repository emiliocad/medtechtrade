<?php


class User_UserController
        extends Mtt_Controller_Action
    {

    protected $_user;


    public function init()
        {

        $this->_user = new Mtt_Models_Bussines_Usuario();
        parent::init();
        }


    public function indexAction()
        {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $usuario = $identity['usuario'];

        $this->view->assign( 'usuario' , $usuario );
        }


    public function editarAction()
        {

        $id = $this->authData['usuario']->id;

        $form = new Mtt_Form_Usuario();
        $form->removeElement( 'clave_2' );
        $form->removeElement( 'clave' );
        $form->removeElement( 'tipousuario_id' );
        $form->removeElement( 'login' );
        $form->submit->setLabel( 'Actualizar' );

        $usuario = $this->_user->getFindId( $id );

        $this->view->assign( 'usuario' , $usuario );

        if ( !is_null( $usuario ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {
                $this->_user->updateUsuario(
                        $form->getValues() , $id
                );
                $this->_helper->FlashMessenger(
                        $this->_translate->translate(
                                'Changed a User'
                        )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $usuario->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger(
                    $this->_translate->translate( 'No User' )
            );
            $this->_redirect( $this->URL );
            }
        }


    public function searchAction()
        {

        $form = new Mtt_Form_Search();
        $this->view->assign( 'frmSearch' , $form );

        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() ) )
            {
            
                $equipo = new Mtt_Models_Bussines_Equipo();
                $criterio= $this->_request->getPost() ;
             
                $equipo->searchEquip($criterio['keywords'], 
                        $criterio['modelo'], $criterio['fabricante'], 
                        $criterio['categoria_id'], 
                        $criterio['anioinicio_id'], 
                        $criterio['aniofin_id'], 
                        $criterio['preciomin_id'], 
                        $criterio['preciomax_id']);
              
            }
             $this->view->assign( 'form' , $this->_request->getPost()  );
        }


    public function changePasswordAction()
        {

        $id = $this->authData['usuario']->id;

        $form = new Mtt_Form_ChangePassword();



        $form->submit->setLabel(
                $this->_translate->translate(
                        'Change Password'
                )
        );

        $usuario = $this->_user->getFindId( $id );

        if ( !is_null( $usuario ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {

                $data = $form->getValues();
                $newClave = Mtt_Auth_Adapter_DbTable_Mtt::generatePassword(
                                $data['clave']
                );
                $this->_user->changePassword(
                        $id , $newClave
                );
                $this->_helper->FlashMessenger(
                        $this->_translate->translate(
                                'Changed a Password'
                        )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $usuario->toArray() );
            $this->view->assign( 'formUsuario' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger(
                    $this->_translate->translate(
                            'No se Pudo Cambiar'
                    )
            );
            $this->_redirect( $this->URL );
            }
        }


    }

