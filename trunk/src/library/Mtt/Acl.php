<?php

/* * *
 * 
 */


class Mtt_Acl
        extends Zend_Acl
    {


    public function __construct()
        {

        //parent::__construct();
        //ROLES
        $this->addRole( new Zend_Acl_Role( 'invitado' ) );
        $this->addRole( new Zend_Acl_Role( 'user' ) , 'invitado' );
        $this->addRole( new Zend_Acl_Role( 'manager' ) , 'user' );
        //RECURSOS
        //default
        $this->add( new Zend_Acl_Resource( 'default::api' ) );
        $this->add( new Zend_Acl_Resource( 'default::categoria' ) );
        $this->add( new Zend_Acl_Resource( 'default::contactus' ) );
        $this->add( new Zend_Acl_Resource( 'default::checkout' ) );
        $this->add( new Zend_Acl_Resource( 'default::equipo' ) );
        $this->add( new Zend_Acl_Resource( 'default::error' ) );
        $this->add( new Zend_Acl_Resource( 'default::idioma' ) );
        $this->add( new Zend_Acl_Resource( 'default::index' ) );
        $this->add( new Zend_Acl_Resource( 'default::test' ) );
        $this->add( new Zend_Acl_Resource( 'default::usuario' ) );
        $this->add( new Zend_Acl_Resource( 'default::vender' ) );
        //user
        $this->add( new Zend_Acl_Resource( 'user::busqueda' ) );
        $this->add( new Zend_Acl_Resource( 'user::cuotaspago' ) );
        $this->add( new Zend_Acl_Resource( 'user::equipo' ) );
        $this->add( new Zend_Acl_Resource( 'user::imagen' ) );
        $this->add( new Zend_Acl_Resource( 'user::index' ) );
        $this->add( new Zend_Acl_Resource( 'user::operacion' ) );
        $this->add( new Zend_Acl_Resource( 'user::pregunta' ) );
        $this->add( new Zend_Acl_Resource( 'user::reserva' ) );
        $this->add( new Zend_Acl_Resource( 'user::user' ) );

        //admin
        $this->add( new Zend_Acl_Resource( 'admin::categoria' ) );
        $this->add( new Zend_Acl_Resource( 'admin::cms' ) );
        $this->add( new Zend_Acl_Resource( 'admin::equipo' ) );
        $this->add( new Zend_Acl_Resource( 'admin::estadooperacion' ) );
        $this->add( new Zend_Acl_Resource( 'admin::fabricante' ) );
        $this->add( new Zend_Acl_Resource( 'admin::index' ) );
        $this->add( new Zend_Acl_Resource( 'admin::moneda' ) );
        $this->add( new Zend_Acl_Resource( 'admin::operacion' ) );
        $this->add( new Zend_Acl_Resource( 'admin::paises' ) );
        $this->add( new Zend_Acl_Resource( 'admin::pregunta' ) );
        $this->add( new Zend_Acl_Resource( 'admin::reserva' ) );
        $this->add( new Zend_Acl_Resource( 'admin::tipousuario' ) );
        $this->add( new Zend_Acl_Resource( 'admin::user' ) );
        $this->add( new Zend_Acl_Resource( 'admin::login' ) );



        //PERMISOS

        $this->allow( 'invitado' , 'default::api' );
        $this->allow( 'invitado' , 'default::categoria' );
        $this->allow( 'invitado' , 'default::checkout' );
        $this->allow( 'invitado' , 'default::contactus' );
        $this->allow( 'invitado' , 'default::equipo' );
        $this->allow( 'invitado' , 'default::error' );
        $this->allow( 'invitado' , 'default::idioma' );
        $this->allow( 'invitado' , 'default::index' );
        $this->allow( 'invitado' , 'default::test' );
        $this->allow( 'invitado' , 'default::usuario' );
        $this->allow( 'invitado' , 'default::vender' );
        //user
        $this->allow( 'user' , 'user::busqueda' );
        $this->allow( 'user' , 'user::cuotaspago' );
        $this->allow( 'user' , 'user::equipo' );
        $this->allow( 'user' , 'user::imagen' );
        $this->allow( 'user' , 'user::index' );
        $this->allow( 'user' , 'user::operacion' );
        $this->allow( 'user' , 'user::pregunta' );
        $this->allow( 'user' , 'user::reserva' );
        $this->allow( 'user' , 'user::user' );

        //admin
        $this->allow( 'manager' , 'admin::index' );
        $this->allow( 'manager' , 'admin::categoria' );
        $this->allow( 'manager' , 'admin::cms' );
        $this->allow( 'manager' , 'admin::equipo' );
        $this->allow( 'manager' , 'admin::estadooperacion' );
        $this->allow( 'manager' , 'admin::fabricante' );
        $this->allow( 'manager' , 'admin::moneda' );
        $this->allow( 'manager' , 'admin::operacion' );
        $this->allow( 'manager' , 'admin::paises' );
        $this->allow( 'manager' , 'admin::pregunta' );
        $this->allow( 'manager' , 'admin::reserva' );
        $this->allow( 'manager' , 'admin::tipousuario' );
        $this->allow( 'manager' , 'admin::user' );
        $this->allow( 'manager' , 'admin::login' );
       
        }


    }