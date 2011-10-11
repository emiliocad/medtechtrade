<?php


class User_EquipoController
        extends Mtt_Controller_Action
    {

    protected $_equipo;


    public function init()
        {
        parent::init();
        $this->_equipo = new Mtt_Models_Bussines_Equipo();
        }


    public function indexAction()
        {
        $this->_helper->layout->setLayout( 'layoutListado' );

        $equipos = $this->_equipo->pagListEquipByUser(
                $this->authData['usuario']->id
        );
        $equipos->setCurrentPageNumber(
                $this->_getParam( 'page' , 1 )
        );

        $this->view->assign( 'equipos' , $equipos );
        }


    public function questionAction()
        {
        
        }


    public function addtopofersAction()
        {
        
        }


    public function verAction()
        {
        /*$this->view->jQuery()
                ->addStylesheet(
                        $this->view->baseUrl() . '/css/reserva.css'
        );*/
        $id = intval( $this->_getParam( 'id' , null ) );
        $stmt = $this->_equipo->getProduct( $id );
        $this->view->assign( 'equipo' , $stmt );

        $modImagen = new Mtt_Models_Bussines_Imagen();
        $imagenes = $modImagen->listByEquip( $id );
        $this->view->assign( 'imagenes' , $imagenes );
        }


    public function verpendientesAction()
        {
        $this->_helper->layout->setLayout( 'layoutListado' );
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipByUserStatus(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Bussines_PublicacionEquipo::Pendiente
                )
        );
        }


    public function veractivosAction()
        {
        $this->_helper->layout->setLayout( 'layoutListado' );
//        $this->view->jQuery()
//                ->addStylesheet(
//                        $this->view->baseUrl() . '/css/reserva.css'
//        );
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipByUserStatus(
                        $this->authData['usuario']->id ,
                        Mtt_Models_Bussines_PublicacionEquipo::Activada
                )
        );
        }


    public function vervendidosAction()
        {
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipSalesUser(
                        $this->authData['usuario']->id )
        );
        }


    public function vernovendidosAction()
        {
        $this->_helper->layout->setLayout( 'layoutListado' );
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipNoSalesUser(
                        $this->authData['usuario']->id )
        );
        }


    public function favoritosAction()
        {
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipFavoriteByUser(
                        $this->authData['usuario']->id , 10 )
        );
        }


    public function reservasAction()
        {
        $this->view->assign(
                'equipos' ,
                $this->_equipo->listEquipReservedUser(
                        $this->authData['usuario']->id )
        );
        }


    public function cotizarAction()
        {

        $id = intval( $this->_request->getParam( 'id' ) );

        $equipo = $this->_equipo->getFindId( $id );

        $form = new Mtt_Form_Cotizar();

        if ( !is_null( $equipo ) )
            {

            if ( $this->_request->isPost()
                    &&
                    $form->isValid( $this->_request->getPost() ) )
                {

                $cotizacion = $form->getValues();

                $paises = new Mtt_Models_Bussines_Paises();
                $pais = $paises->getFindId( $cotizacion['paises_id'] );
                $cotizacion['pais'] = $pais->nombre;
                $cotizacion['equipo'] = $equipo->nombre;
                $this->_equipo->sendMailToRequest( $cotizacion , 'cotizar' );
                //$this->view->assign( 'equipo' , $equipo );
                }
            $this->view->assign( 'frmCotizar' , $form );
            }
        else
            {

            $this->_helper->FlashMessenger(
                    $this->_translate->translate( 'no existe' )
            );
            $this->_redirect( $this->URL );
            }
        }


    public function nuevoAction()
        {

        $form = new Mtt_Form_Equipo();
        $form->removeElement( 'precioventa' );
        $form->removeElement( 'publicacionEquipo_id' );
        $form->preciocompra->setLabel( 'Precio' );

        if ( $this->_request->isPost()
                &&
                $form->isValid( $this->_request->getPost() )
        )
            {

            $equipo = $form->getValues();
            $equipo_new = array(
                'usuario_id' => $this->authData['usuario']->id ,
                'publicacionEquipo_id' => 1
            );

            $equipo = array_merge( $equipo , $equipo_new );

            $this->_equipo->saveEquipo( $equipo );

            $this->_helper->FlashMessenger(
                    $this->_translate->translate(
                            'Se Registro El Equipo'
                    )
            );
            $this->_redirect( $this->URL );
            }
        $this->view->assign( 'frmRegistrar' , $form );
        }


    public function editarAction()
        {

        $id = intval( $this->_getParam( 'id' ) );

        $form = new Mtt_Form_Equipo();

        $equipo = $this->_equipo->getFindId( $id );

        if ( !is_null( $equipo ) )
            {
            if ( $this->_request->isPost() && $form->isValid(
                            $this->_request->getPost() )
            )
                {
                $this->_equipo->updateEquipo( $form->getValues() , $id );
                $this->_helper->FlashMessenger( 'Se modificó un fabricante' );
                $this->_redirect( $this->URL );
                }
            $form->setDefaults( $equipo->toArray() );
            $this->view->assign( 'form' , $form );
            }
        else
            {
            $this->_helper->FlashMessenger( 'No existe ese fabricante' );
            $this->_redirect( $this->URL );
            }
        }


    public function borrarAction()
        {
        $id = intval( $this->_request->getParam( 'id' ) );
        $this->_equipo->desactivarReserva( $id );
        $this->_helper->FlashMessenger( 'Equipo Borrado' );
        $this->_redirect( $this->URL );
        }


    }

