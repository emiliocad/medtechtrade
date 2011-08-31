<?php

class Mtt_Models_Bussines_Usuario extends Mtt_Models_Table_Usuario
    {
    const PASSWPRD_SALT = "asdw452112355";

    public function auth( $login , $pwd )
        {

        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        //$authAdapter = new Zend_Auth_Adapter_DbTable($db);
        $authAdapter = new Mtt_Auth_Adapter_DbTable_Mtt( $db );
        //$authAdapter->setTableName('usuario');
        //$authAdapter->setIdentityColumn('login');
        //$authAdapter->setCredentialColumn('pwd');
        $authAdapter->setIdentity( $login );
        //$authAdapter->setCredentialTreatment('MD5(?)');
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

    public function getPaginator()
        {
        $p = Zend_Paginator::factory( $this->fetchAll() );
        $p->setItemCountPerPage( 3 );
        return $p;
        }

    public function fetchs()
        {
        $db = $this->getAdapter();
        $db->select()->from();
        return $db->fetchPairs();
        }

    }
