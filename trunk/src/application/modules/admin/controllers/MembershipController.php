<?php

/**
 * Admin_MembershipController
 * Used for the management of the existing membership plans
 */
class Admin_MembershipController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_MembershipController::init()
     * Executed for each request in order to update the session data
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
     * Admin_MembershipController::indexAction()
     * Reserved for future development
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_MembershipController::managerAction()
     * Used for management and editing of the existing membership plan.
     * @return
     */
    public function managerAction(){
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $errors = array();
            if(!is_numeric($r['saving'])) $errors['saving'] = 'Integer value required';
            if(!is_numeric($r['price_month'])) $errors['price_month'] = 'Integer value required';
            if(!is_numeric($r['price_half_year'])) $errors['price_half_year'] = 'Integer value required';
            if(!is_numeric($r['price_year_old'])) $errors['price_year_old'] = 'Integer value required';
            if(!is_numeric($r['price_year_new'])) $errors['price_year_new'] = 'Integer value required';
            if(!is_numeric($r['upload_other_pictures'])) $errors['upload_other_pictures'] = 'Integer value required';
            if(!is_numeric($r['coupons'])) $errors['coupons'] = 'Integer value required';
            if(!is_numeric($r['banners'])) $errors['banners'] = 'Integer value required';
            if(!is_numeric($r['mass_emails'])) $errors['mass_emails'] = 'Integer value required';    
            if(!empty($errors)){
                $this->view->errors = $errors;                  
            } else {
                $plan = array(
                  'id'                      => $r['id'],
                  'saving'                  => $r['saving'],
                  'price_month'             => $r['price_month'],
                  'price_half_year'         => $r['price_half_year'],
                  'price_year_old'          => $r['price_year_old'],
                  'price_year_new'          => $r['price_year_new'],       
                  'upload_other_pictures'   => $r['upload_other_pictures'],
                  'coupons'                 => $r['coupons'],
                  'banners'                 => $r['banners'],
                  'mass_emails'             => $r['mass_emails']
                );
                Model_MembershipPlans::save($plan);
            }
        }
        
        $this->view->membership_plans = Model_MembershipPlans::getAll();
        $this->view->membership_labels = Model_Language::getAllByPrefixAndLanguage("membership_","EN");
    }
    
}