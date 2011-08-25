<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Mtt_Models_Bussines_Usuario extends Mtt_Models_Table_Usuario
    {
    const PASSWPRD_SALT = "asdw452112355";

    public function auth( $login , $pwd )
        {
        //$db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $db = $this->getAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable( $db );
        $authAdapter->setTableName( 'usuario' );
        $authAdapter->setIdentityColumn( 'login' );
        $authAdapter->setCredentialColumn( "clave" );
        $authAdapter->setIdentity( $login );
        $authAdapter->setCredentialTreatment( 'MD5(?)' );
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

    public function unido()
        {
        $db = $this->getAdapter();
        $sql1 = $db->select()->from( $this->_name )->where( 'id < ?' , 4 ); //1,2,3
        $sql2 = $db->select()->from( $this->_name )->where( 'id > ?' , 16 ); //17,18
        $sql3 = $db->select()->union( array( $sql1 , $sql2 ) )->order( "id DESC" );
        return $sql3->query()->fetchAll();
        }

    public function fetchs()
        {
        $db = $this->getAdapter();
        $db->select()->from();
        return $db->fetchPairs();
        }

    }
