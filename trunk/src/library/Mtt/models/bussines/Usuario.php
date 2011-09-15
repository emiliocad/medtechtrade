<?php


class Mtt_Models_Bussines_Usuario
        extends Mtt_Models_Table_Usuario
    {

    const PASSWPRD_SALT = "asdw452112355";


    public function auth( $login , $pwd )
        {
//TODO Consulta para el tipo de usuario
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

            $authStorage->write( array(
                'usuario' => $authAdapter->getResultRowObject( null , 'clave' ) ,
                'loginAt' => date( 'Y-m-d H:i:s' )
            ) );
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


    public function updateUsuario( array $data , $id )
        {

        $this->update( $data , 'id = ' . $id );
        }


    public function saveUsuario( array $data )
        {

        $this->insert( $data );
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


    }
