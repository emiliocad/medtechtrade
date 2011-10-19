<?php


/**
 * 
 */
class Mtt_Models_Bussines_Config
        extends Mtt_Models_Table_Config
    {

    protected $_user;


    public function __construct()
        {
        parent::__construct();
        $this->_user = new Mtt_Models_Bussines_Usuario();
        }


    public function __destruct()
        {
        
        }


    public function getFindId( $id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'id = ?' , $id )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;
        return $query->fetchObject();
        }


    public function listar()
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->query()
        ;
        return $query->fetchAll( Zend_Db::FETCH_OBJ );
        }


    public function updateConfig( array $data , $id )
        {
        unset( $data['recordar'] );
        unset( $data['submit'] );
        $this->update( $data , 'id = ' . $id );
        }


    public function checkUserConfig( $user_id )
        {
        $db = $this->getAdapter();
        $query = $db->select()
                ->from( $this->_name )
                ->where( 'active = ?' , self::ACTIVE )
                ->where( 'usuario_id = ?' , $user_id )
                ->query()
        ;
        return $query->fetchObject();
        }


    public function saveConfig( array $data )
        {

        $usuario = Zend_Auth::getInstance()->getStorage()->read();
        unset( $data['recordar'] );
        unset( $data['submit'] );
        $data['usuario_id'] = $usuario['usuario']->id;

        $this->insert( $data );
        }


    public function deleteConfig( $id )
        {

        $this->delete( 'id = ?' , $id );
        }


    public function activarConfig( $id )
        {

        $this->update( array( "active" => self::ACTIVE ) , 'id = ' . $id );
        }


    public function desactivarConfig( $id )
        {

        $this->update( array( "active" => self::DESACTIVATE ) , 'id = ' . $id );
        }


    }
