<?php
/**
 * Admin_AjaxController
 * Used for AJAX file uploads in the backend.
 */
class Admin_AjaxController extends Zend_Controller_Action
{
    protected $_session;
       
    /**
     * Admin_AjaxController::init()
     * Executed on each request in order to update the session data.
     * @return
     */
    public function init(){
        $session = new Zend_Session_Namespace("ProdentalAdmin");
        $this->_session = $session;
        $this->view->session = $session;
    }
    
    
    /**
     * Admin_AjaxController::flagUploadAction()
     * Process the upload of a flag for a given country.
     * @return
     */
    public function flagUploadAction(){
        $file = $_FILES['flag']['name'];
        $f = ROOT_PATH.'/images/countries/'.$file;
        
        $this->_session->flag = $file;
        
        $resp=array();
        if(move_uploaded_file($_FILES['flag']['tmp_name'],$f)){
            $resp['filename'] = $file;
            $resp['message']= 'success';
        } else {
            $resp['filename']='earth.png';
            $resp['message']= 'error';
        }
        echo Zend_Json::encode($resp);exit();
    }
    
    /**
     * Admin_AjaxController::firstLogoUploadAction()
     * Upload the animated swf logo for the country
     * @return
     */
    public function firstLogoUploadAction(){
        $file = $_FILES['logo1']['name'];
        $f = ROOT_PATH.'/images/countries/'.$file;
        
        $this->_session->logo1 = $file;
        
        $resp=array();
        if(move_uploaded_file($_FILES['logo1']['tmp_name'],$f)){
            $resp['filename'] = $file;
            $resp['message']= 'success';
        } else {
            $resp['filename']='animated-tooth.swf';
            $resp['message']= 'error';
        }
        echo Zend_Json::encode($resp);exit();
    }
    
    /**
     * Admin_AjaxController::secondLogoUploadAction()
     * Upload the equivalent of the tooth with a door for a given country (e.g. for login)
     * @return
     */
    public function secondLogoUploadAction(){
        $file = $_FILES['logo2']['name'];
        $f = ROOT_PATH.'/images/countries/'.$file;
        
        $this->_session->logo2 = $file;
        
        $resp=array();
        if(move_uploaded_file($_FILES['logo2']['tmp_name'],$f)){
            $resp['filename'] = $file;
            $resp['message']= 'success';
        } else {
            $resp['filename']='tooth_door.png';
            $resp['message']= 'error';
        }
        echo Zend_Json::encode($resp);exit();
    }
    
    /**
     * Admin_AjaxController::thirdLogoUploadAction()
     * Upload the equivalent ot the tooth with binoculars for a given country (e.g. for searches)
     * @return
     */
    public function thirdLogoUploadAction(){
        $file = $_FILES['logo3']['name'];
        $f = ROOT_PATH.'/images/countries/'.$file;
        
        $this->_session->logo3 = $file;
        
        $resp=array();
        if(move_uploaded_file($_FILES['logo3']['tmp_name'],$f)){
            $resp['filename'] = $file;
            $resp['message']= 'success';
        } else {
            $resp['filename']='tooth_binoculars.png';
            $resp['message']= 'error';
        }
        echo Zend_Json::encode($resp);exit();
    }
    
    
}