<?php

/**
 * Admin_PagesController
 * Used for management of the static pages in the system
 */
class Admin_PagesController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_PagesController::init()
     * Executed for each request in order to update the session data.
     * @return
     */
    public function init(){
        $session = new Zend_Session_Namespace("ProdentalAdmin");
        $this->_session = $session;
        $this->view->session = $session;
        $this->_helper->layout->setLayout("dashboard");
        if(!isset($session->id)) $this->_redirect('admin');
    }

    /**
     * Admin_PagesController::indexAction()
     * Reserved for future development
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_PagesController::aboutUsAction()
     * Used for updating the "About Us" static page
     * @return
     */
    public function aboutUsAction(){
        $this->view->en_title = Model_Language::getByKey('aboutus_title');
        $this->view->en_content = Model_Language::getByKey('aboutus_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('aboutus_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('aboutus_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::faqDentistAction()
     * Used for updating the "FAQ dentist" static page
     * @return
     */
    public function faqDentistAction(){
        $this->view->en_title = Model_Language::getByKey('faq_dentist_title');
        $this->view->en_content = Model_Language::getByKey('faq_dentist_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('faq_dentist_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('faq_dentist_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::faqPatientAction()
     * Used for updating the "FAQ patient" static page 
     * @return
     */
    public function faqPatientAction(){
        $this->view->en_title = Model_Language::getByKey('faq_patient_title');
        $this->view->en_content = Model_Language::getByKey('faq_patient_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('faq_patient_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('faq_patient_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::conditionsOfUseDentistAction()
     * Used for updating the "Conditions of Use" static page for dentists
     * @return
     */
    public function conditionsOfUseDentistAction(){
        $this->view->en_title = Model_Language::getByKey('conditions_of_use_dentist_title');
        $this->view->en_content = Model_Language::getByKey('conditions_of_use_dentist_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('conditions_of_use_dentist_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('conditions_of_use_dentist_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::conditionsOfUsePatientAction()
     * Used for updating the "Conditions of Use" static page for patients
     * @return
     */
    public function conditionsOfUsePatientAction(){
        $this->view->en_title = Model_Language::getByKey('conditions_of_use_patient_title');
        $this->view->en_content = Model_Language::getByKey('conditions_of_use_patient_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('conditions_of_use_patient_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('conditions_of_use_patient_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::privacyAndSecurityDentistAction()
     * Used for updating the "Privacy and Security" static page for dentists 
     * @return
     */
    public function privacyAndSecurityDentistAction(){
        $this->view->en_title = Model_Language::getByKey('privacy_security_dentist_title');
        $this->view->en_content = Model_Language::getByKey('privacy_security_dentist_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('privacy_security_dentist_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('privacy_security_dentist_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
    /**
     * Admin_PagesController::privacyAndSecurityPatientAction()
     * Used for updating the "Privacy and Security" static page for patients 
     * @return
     */
    public function privacyAndSecurityPatientAction(){
        $this->view->en_title = Model_Language::getByKey('privacy_security_patient_title');
        $this->view->en_content = Model_Language::getByKey('privacy_security_patient_content');
        if(isset($_REQUEST['save'])){
            $en_title = Model_Language::getRecordByKey('privacy_security_patient_title','EN');
            $en_t = stripslashes($_REQUEST['en_title']);
            $en_title['value'] = $en_t;
            $en_content = Model_Language::getRecordByKey('privacy_security_patient_content','EN');
            $en_c = stripslashes(str_replace("\r\n","",$_REQUEST['en_content']));
            $en_content['value'] = $en_c;
            Model_Language::save($en_title);
            Model_Language::save($en_content);
        }
    }
    
}