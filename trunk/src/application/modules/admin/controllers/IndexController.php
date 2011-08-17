<?php

/**
 * Admin_IndexController
 * Used for dealing with operations like login/logout/password recovery in the backend.
 */
class Admin_IndexController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_IndexController::init()
     * Executed for each request in order to update the session data.
     * @return
     */
    public function init(){
        $session = new Zend_Session_Namespace("ProdentalAdmin");
        $this->_session = $session;
        $this->view->session = $session;
        $this->_helper->layout->setLayout("dashboard");
        
    }

    /**
     * Admin_IndexController::indexAction()
     * Used for rendering the login page and process the login request.
     * @return
     */
    public function indexAction(){
        $this->_helper->layout->setLayout("admin"); 
        if(isset($_REQUEST['login'])){
            $errors = array();$r=$_REQUEST;
            if($r['username']=="") $errors[]="Please enter the username";
            if($r['password']=="") $errors[]="Please enter the password";
            if(empty($errors)){
                $user = Model_Administrator::getByUsername($r['username']);
                if(empty($user)) $errors[] = "No such user";
                else 
                    if($r['password']!=$user['password']) $errors[]="Username and password did not match";
                else 
                    if($user['hidden']) $errors[]="Your account is inactivated";
            }
            if(empty($errors)){
                $this->_session->id = $user['id'];
                $this->_session->user = $user;
                $this->view->session = $this->_session;
                $this->_redirect('admin/index/front-panel');
            }else{
                $this->view->errors = $errors;
            } 
            
        }     
    }
    
    /**
     * Admin_IndexController::frontPanelAction()
     * Used for rendering the welcome message for backend.
     * @return
     */
    public function frontPanelAction(){
        
    }
    
    /**
     * Admin_IndexController::logoutAction()
     * Used for performing the logout operation.
     * @return
     */
    public function logoutAction(){
        $this->_session->unsetAll();
        $this->_redirect('admin');
    }
    
    /**
     * Admin_IndexController::forgotPasswordAction()
     * Used for password recovery for admin accounts.
     * @return
     */
    public function forgotPasswordAction(){
        $this->_helper->layout->setLayout("admin"); 
    }
    
}