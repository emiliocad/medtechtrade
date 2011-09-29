<?php


class Admin_UserController
        extends Mtt_Controller_Action
    {

    protected $_user;


    public function init()
        {
        parent::init();
        $this->_user = new Mtt_Models_Bussines_Usuario();
        }


    public function indexAction()
        {
        $this->view->assign(
                'usuarios' , $this->_user->listar()
        );
        }
        
        

    public function detalleAction()
        {
        $id = intval( $this->_getParam( 'id' ) );
        $this->view->jQuery()
                ->addOnLoad(
                        ' $(document).ready(function() {
                            $("#tabs").tabs();
                          });'
                )
        ;
        //Editar datos del usuario
        $this->editarAction();
        
        //Listar equipos del Usuario
        $equipo = new Mtt_Models_Bussines_Equipo();
        $equipos_user = $equipo->listEquipByUser($id);
        $this->view->assign( 'equipos' , $equipos_user );
        
        //Listar preguntas que el usuario formulo
        $pregunta = new Mtt_Models_Bussines_Pregunta();
        $preguntas_user = $pregunta->listByUser($id);
        $this->view->assign( 'preguntas' , $preguntas_user );
        
        //Listar reservas
        $reserva = new Mtt_Models_Bussines_Reserva();
        $reservas_user = $reserva->getReservaByUser($id, 
            Mtt_Models_Table_TipoReserva::RESERVED);
        $this->view->assign( 'reservas' , $reservas_user );
        
        
        }
        
        
        
        


    public function activausuariosAction()
        {
        $form = new Mtt_Form_ActivarUsuario();
        $this->view->assign( 'frmActiveUser' , $form );

        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() ) )
            {

            $usuarios = $form->getValues();
            $ids = $usuarios['usuarios'];

            foreach ( $ids as $item )
                {
                $this->_user->habilitarUsuario( $item );
                }

            $this->_redirect( $this->URL );
            }
        }


    public function editarAction()
        {
        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Usuario();
        $form->removeElement( 'clave_2' );
        $form->submit->setLabel( 'Actualizar' );
        $usuario = $this->_user->getFindId( $id );

        if ( !is_null( $usuario ) )
            {
            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {
                $this->_fabricante->updateFabricante(
                        $form->getValues() , $id
                );
                $this->_helper->FlashMessenger(
                        $this->translate( 'Changed a User' )
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $usuario->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( $this->translate( 'No User' ) );
            $this->_redirect( $this->URL );
            }
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->deleteUsuario( $id );
        $this->_helper->FlashMessenger(
                $this->translate( 'Usuario Desactivado' )
        );
        $this->_redirect( $this->URL );
        }


//FIXME -verificar codigo para traducion
    public function nuevoAction()
        {
        $form = new Mtt_Form_Usuario();
        if ( $this->_request->isPost() &&
                $form->isValid( $this->_request->getPost() ) )
            {
            $user = $form->getValues();

            $this->_user->saveUsuario( $user );

            $this->_helper->FlashMessenger(
                    $this->translate( 'Se Registro el Usuario' )
            );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    //FIXME cambiar codigo de ver
    public function verAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_user->getCategoria( $id );
        $this->view->assign( 'categoria' , $stmt );
        }


    public function equipmentAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );

        $_equipo = new Mtt_Models_Bussines_Equipo();
        $stmt = $_equipo->listEquipByUser( $id );
        $this->view->assign( 'equipos' , $stmt );
        }


    public function operationAction()
        {
        $id = intval( $this->_getParam( 'id' , null ) );
        $_operacion = new Mtt_Models_Bussines_Operacion();
        $stmt = $_operacion->listByUser( $id );
        $this->view->assign( 'operaciones' , $stmt );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->activarUsuario( $id );
        $this->_helper->FlashMessenger( 'Usuario activado' );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->desactivarUsuario( $id );
        $this->_helper->FlashMessenger( 'Usuario Descativado' );
        $this->_redirect( $this->URL );
        }


    }

