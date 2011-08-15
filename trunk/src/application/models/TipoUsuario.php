<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 */
class Application_Model_Usuario extends Zend_Db_Table_Abstract {
    
    protected $_name = 'usuario';
    //protected $_dependentTables = array('Application_Model_Tag');    
    
    const DNI = 'dni';
    const CE = 'carnet-extranjeria';
    const PASSPORT = 'pasaporte';


    const PASSWPRD_SALT = "ojblkjbsdfbkjbdsfkljb";
    
    public function validarDocumento($tipoDoc, $numDoc){
        
        if($tipoDoc == self::DNI){
            
        }
        
        if($tipoDoc == self::CE){
            
        }
        if($tipoDoc == self::PASSPORT){
            
        }
        
    }

    public function disponibleLogin($login){
        return $this->fetchAll(array('login = ?'=>$login))->count()===0;
    }
    
    public function disponibleLogin2($login){
        $v = new Zend_Validate_Db_NoRecordExists(array(
            'table' => $this->_name,
            'field' => 'login'
        ));
        return $v->isValid($login);
    }
    
    public function auth($login,$pwd){

        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
        $authAdapter->setTableName('usuario');
        $authAdapter->setIdentityColumn('login');
        $authAdapter->setCredentialColumn('pwd');
        $authAdapter->setIdentity($login);
        $authAdapter->setCredentialTreatment('MD5(?)');
        $authAdapter->setCredential($pwd);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        $isValid = $result->isValid();
        
        if($isValid){
            $authStorage = $auth->getStorage();
            $authStorage->write(array(
                'usuario' => $authAdapter->getResultRowObject(null,'pwd'),
                'loginAt' => date('Y-m-d H:i:s')
            ));
        }
        

        return $isValid;
    }
    

    public function autenticar(array $values){
        $db = $this->getAdapter();
        $filas = $db->select()
            ->from($this->_name)
            ->where('login = ?', $values['login'])
            ->where('pwd = ?', md5($values['pwd']))
            ->query()->fetchAll();
        $loginValido = count($filas)===1;
        if($loginValido){
            $S = new Zend_Session_Namespace('ventas');
            $S->usuario = $filas[0];
        }
        return $loginValido;
    }
    
    public function getPaginator(){
        $p = Zend_Paginator::factory($this->fetchAll());
        $p->setItemCountPerPage(3);
        return $p;
    }
    
    public function unido() {
        $db = $this->getAdapter();
        $sql1 = $db->select()->from($this->_name)->where('id < ?', 4); //1,2,3
        $sql2 = $db->select()->from($this->_name)->where('id > ?', 16);//17,18
        $sql3 = $db->select()->union(array($sql1, $sql2))->order("id DESC");
        return $sql3->query()->fetchAll();
    }

    public function fetchs(){
        $db = $this->getAdapter();
        $db->select()->from();
        return $db->fetchPairs();
    }

}
