<?php


class Mtt_Models_Bussines_Usuario
        extends Mtt_Models_Table_Usuario
    {

    const PASSWPRD_SALT = "asdw452112355";

    
    public function auth( $login , $pwd )
        {

        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Mtt_Auth_Adapter_DbTable_Mtt( $db );

        $authAdapter->setIdentity( $login );
        $authAdapter->setCredential( $pwd );

        $auth = Zend_Auth::getInstance();

        $result = $auth->authenticate( $authAdapter );

        $isValid = $result->isValid();

        if ( $isValid )
            {
            $authStorage = $auth->getStorage();
            $_user = $this->getByRol( $login );
            $authStorage->write(
                    array(
                        'usuario' => $authAdapter->getResultRowObject(
                                null , 'clave'
                        ) ,
                        'loginAt' => date( 'Y-m-d H:i:s' ) ,
                        'rol' => $_user->rol
                    )
            );
            }


        return $isValid;
        }


    public function findLogin( $login )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from(
                        $this->_name ,
                        array(
                    'login' , 'tipousuario_id' )
                )
                ->where( 'usuario.active = ?' , self::ACTIVE )
                ->where( 'usuario.login = ?' , $login )
                ->query();
        ;
        return $query->fetchObject();
        }


    /**
     *
     * @param type $checkMail 
     */
    public function getByValidacionEmail( $checkMail )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name
                )
                ->where( 'active IN (?)' , self::DESACTIVATE )
                ->where( 'activacion IN (?)' , $checkMail )
                ->query();

        return $query->fetchObject();
        }


    public function getPaginator()
        {
        $p = Zend_Paginator::factory( $this->fetchAll() );
        $p->setItemCountPerPage( 3 );
        return $p;
        }


    public function listar()
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array(
                    'id' ,
                    'nombre' ,
                    'apellido' ,
                    'email' ,
                    'login' ,
                    'fecharegistro' ,
                    'direccion' ,
                    'codpostal' ,
                    'ciudad' ,
                    'institucion' ,
                    'active'
                ) )
                ->joinInner( 'tipousuario' ,
                             'tipousuario.id = usuario.tipousuario_id' ,
                             array( 'tipousuario.nombre as rol' ) )
                ->joinInner( 'paises' , 'paises.id = usuario.paises_id' ,
                             array( 'paises.nombre as pais' ) )
                ->where( 'usuario.active = ?' , self::ACTIVE )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }
        
        
   public function pagList()
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/myConfigAdmin.ini' , 
                        'usuario'
        );
        $data = $_conf->toArray();

        $object = Zend_Paginator::factory( $this->listar() );
        $object->setItemCountPerPage(
                $data['ItemCountPerPage']
        );
        return $object;
        }        


    public function listarRegistrados()
        {

        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array(
                    'id' ,
                    'nombre' ,
                    'apellido' ,
                    'email' ,
                    'login' ,
                    'fecharegistro' ,
                    'direccion' ,
                    'codpostal' ,
                    'ciudad' ,
                    'institucion' ,
                    'active'
                ) )
                ->joinInner( 'tipousuario' ,
                             'tipousuario.id = usuario.tipousuario_id' ,
                             array( 'tipousuario.nombre as rol' ) )
                ->joinInner( 'paises' , 'paises.id = usuario.paises_id' ,
                             array( 'paises.nombre as pais' ) )
                ->where( 'usuario.active = ?' , self::ACTIVE )
                ->where( 'usuario.tipousuario_id = ?' ,
                         Mtt_Models_Bussines_TipoUsuario::REGISTERED
                )
                ->query()
        ;

        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function getTratamientosUsuario()
        {

        $tratamientos = array('1' => 'Sr', '2' => 'Sra/Srta');
        return $tratamientos;
        }
        
        
        
    public function updateUsuario( array $data , $id )
        {
        $data['fechamodificacion'] = date( 'Y-m-d H:i:s');
        $this->update( $data , 'id = ' . $id );
        }


    public function saveUsuario( array $data )
        {
        $passwordUser = $data["clave"];

        $valuesDefault = array(
            "clave" => Mtt_Auth_Adapter_DbTable_Mtt::generatePassword(
                    $data["clave"]
            ) ,
            "tipousuario_id" => Mtt_Models_Bussines_TipoUsuario::REGISTERED ,
            "fecharegistro" =>
            Zend_Date::now()->toString(
                    "YYYY-MM-dd hh-mm-ss"
            ) ,
            "ultimavisita" => Zend_Date::now()->toString(
                    "YYYY-MM-dd hh-mm-ss"
            ) ,
            "activacion" => Mtt_Auth_Adapter_DbTable_Mtt::generatePassword(
                    $data["login"]
            )
        );


        unset( $data["clave_2"] );
        unset( $data["clave"] );

        $usuario = array_merge( $valuesDefault , $data );

        if ( ( $this->insert( $usuario ) ) )
            {

            $arrayNew = array(
                'password' => $passwordUser
            );

            $data = array_merge( $arrayNew , $data );
            $this->sendMail( $data , 'Registro de Usuario' );
            }
        }


    public function deleteUsuario( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarUsuario( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarUsuario( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    public function habilitarUsuario( $id )
        {

        $this->update(
                array(
            "tipousuario_id" => Mtt_Models_Table_TipoUsuario::USER ) ,
                'id = ' . $id );
        }


    public function activeUsuario( $validacion )
        {
        $data = $this->getByValidacionEmail( $validacion );
        if ( isset( $data ) && !is_null( $data ) && is_object( $data ) )
            {
            $this->updateUsuario(
                    array( 'active' => self::ACTIVE )
                    , $data->id
            );
            return $data;
            }
        return false;
        }


    public function changePassword( $id , $password )
        {

        $this->update(
                array(
            "clave" => $password ) , 'id = ' . $id );
        }


    /**
     * para enviar correo de autorizacion
     * @param array $data
     * @param string $subject
     */
    public function sendMail( array $data , $subject )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/mail.ini'
        );

        $dataUser = $data['nombre'] . '  ' . $data['apellido'];

        $confMail = $_conf->toArray();

        $config = array(
            'auth' => $confMail['auth'] ,
            'username' => $confMail['username'] ,
            'password' => $confMail['password'] ,
            'port' => $confMail['port'] );

        $mailTransport = new Zend_Mail_Transport_Smtp(
                        $confMail['smtp'] ,
                        $config
        );


        Zend_Mail::setDefaultFrom(
                $confMail['username'] , $confMail['data']
        );
        Zend_Mail::setDefaultTransport( $mailTransport );


        Zend_Mail::setDefaultFrom(
                $confMail['username'] , $confMail['data']
        );

        Zend_Mail::setDefaultReplyTo(
                $confMail['username'] , $confMail['data']
        );
        $m = new Mtt_Html_Mail_Mailer();
        $m->setSubject( $subject );

        $m->addTo( $data['email'] );

        $m->setViewParam( 'usuario' , $dataUser )
                ->setViewParam( 'login' , $data['login'] )
                ->setViewParam( 'clave' , $data['clave'] )
                ->setViewParam(
                        'enlace' ,
                        Mtt_Auth_Adapter_DbTable_Mtt::generatePassword(
                                $data['login']
                        )
        );
        ;
        $m->sendHtmlTemplate( "index.phtml" );
        }


    /**
     * para enviar correo de autorizacion
     * @param array $data
     * @param string $subject
     */
    public function sendMailToAdmin( array $data , $subject )
        {
        $_conf = new Zend_Config_Ini(
                        APPLICATION_PATH . '/configs/mail.ini'
        );


        $confMail = $_conf->toArray();

        $config = array(
            'auth' => $confMail['auth'] ,
            'username' => $confMail['username'] ,
            'password' => $confMail['password'] ,
            'port' => $confMail['port'] );

        $mailTransport = new Zend_Mail_Transport_Smtp(
                        $confMail['smtp'] ,
                        $config
        );

        //Mtt_Html_Mail_Mailer::setDefaultFrom();
        Zend_Mail::setDefaultFrom(
                $confMail['username'] , $confMail['data']
        );
        Zend_Mail::setDefaultTransport( $mailTransport );
//        Zend_Mail::setDefaultFrom(
//                $confMail['username'] , $confMail['data']
//        );
        Zend_Mail::setDefaultReplyTo(
                $data['email'] , $confMail['data']
        );
        $m = new Mtt_Html_Mail_Mailer();
        $m->setSubject( $data['asunto'] );

        $m->addTo( $confMail['administrator'] );

        $m->setViewParam( 'usuario' , $data['nombre'] )
                ->setViewParam( 'email' , $data['email'] )
                ->setViewParam( 'comentario' , $data['comentario'] )
        ;
        $m->sendHtmlTemplate( "contacttoadmin.phtml" );
        }


    /**
     *
     * @param type $login
     * @return type 
     */
    public function getByRol( $login )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name ,
                        array(
                    'id' ,
                    'nombre' ,
                    'apellido' ,
                    'email' ,
                    'login' ,
                    'clave' ,
                    'active'
                        )
                )
                ->joinInner( 'tipousuario' ,
                             'tipousuario.id = usuario.tipousuario_id' ,
                             array(
                    'rol' => 'nombre'
                        )
                )
                ->where( 'usuario.active =?' , self::ACTIVE )
                ->where( 'usuario.login =?' , $login )
                ->query()
        ;

        return $query->fetchObject();
        }


    }

