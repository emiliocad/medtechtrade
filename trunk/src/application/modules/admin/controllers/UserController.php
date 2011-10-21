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
        

        $usuarios = $this->_user->pagList();

        $usuarios->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );
        $this->view->assign(
                'usuarios' ,$usuarios
        );
        }


    public function detalleAction()
        {

        $this->_helper->layout->disableLayout();

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
        $equipos_user = $equipo->listEquipByUser( $id );
        $this->view->assign( 'equipos' , $equipos_user );

        //Listar preguntas que el usuario formulo
        $pregunta = new Mtt_Models_Bussines_Pregunta();
        $preguntas_user = $pregunta->listByUser( $id );
        $this->view->assign( 'preguntas' , $preguntas_user );

        //Listar reservas
        $reserva = new Mtt_Models_Bussines_Reserva();
        $reservas_user = $reserva->getReservaByUser( $id ,
                                                     Mtt_Models_Table_TipoReserva::RESERVED );
        $this->view->assign( 'reservas' , $reservas_user );

        //Listar operaciones
        $operacion = new Mtt_Models_Bussines_Operacion();
        $operaciones_user = $operacion->
                listByUserOperation( $id ,
                                     Mtt_Models_Table_EstadoOperacion::SALE
        );
        $this->view->assign( 'operaciones' , $operaciones_user );
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

        $form = new Mtt_EditForm_Usuario();
        $form->removeElement( 'clave_2' );
        //$form->submit->setLabel( 
        //ucwords($this->_translate->translate('actualizar')) );
        $usuario = $this->_user->getFindId( $id );

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
                        $this->_translate->translate( $this->_translate->translate('Changed a User' ))
                );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $usuario->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 
                    $this->_translate->translate( $this->_translate->translate('no es usuario') ) );
            $this->_redirect( $this->URL );
            }
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->deleteUsuario( $id );
        $this->_helper->FlashMessenger(
                $this->_translate->translate( 'usuario desactivado' )
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
                    $this->_translate->translate( 'se registro el usuario' )
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
        $idUser = intval( $this->_getParam( 'id' , null ) );
        $_operacion = new Mtt_Models_Bussines_Operacion();
        $stmt = $_operacion->paglistByUser( $idUser );

        $stmt->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );

        $this->view->assign( 'operaciones' , $stmt );
        }


    public function activarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->activarUsuario( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate( 'Usuario activado' ) 
        );
        $this->_redirect( $this->URL );
        }


    public function desactivarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_user->desactivarUsuario( $id );
        $this->_helper->FlashMessenger( 
                $this->_translate->translate( 'Usuario desactivado' ) 
        );
        $this->_redirect( $this->URL );
        }


    }

