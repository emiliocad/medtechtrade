<?php

/**
 * Admin_AdsController
 * Module for backend management of ads 
 */

class Admin_AdsController extends Zend_Controller_Action
{
    protected $_session;
    /**
     * Admin_AdsController::init()
     * Executed at every request. Updates the session params for the current request
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
     * Admin_AdsController::linkAppend()
     * Add supplemental params in order to display the last viewed page in ads manager after an
     * add/edit operation.
     * @return
     */
    private function linkAppend(){
        $link="";
        if(isset($this->_session->ad_display)){
            $d = $this->_session->ad_display;
            $link = "/?p=".$d['page']."&f=".$d['field']."&o=".$d['order'];
        };
        return $link;
    }

    /**
     * Admin_AdsController::indexAction()
     * Reserved for future development. It will allow for a page describing the current module 
     * and perform general setup in that module
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_AdsController::managerAction()
     * The Ads Manager. Displays a sortable table with the ads and allow for management of the ads
     * in the system. 
     * @return
     */
    public function managerAction(){
    if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_ad);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['ads'])){
            //Zend_Debug::dump($_REQUEST); exit();
            if($_REQUEST['status']==0)
                foreach($_REQUEST['ads'] as $ad) Model_Ads::enableAd($ad);
            else
                foreach($_REQUEST['ads'] as $ad) Model_Ads::disableAd($ad);    
        } 
        $ads = Model_Ads::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            
            $search_data = array(
                'country_id' => $r['country_id'],
                'dentist_id' => $r['dentist_id'],
                'page'       => $r['page'],
                'hidden'     => $r['hidden'],
                'date_from'  => $r['date_from'],
                'date_to'    => $r['date_to'],
            );
            $this->_session->search_ad=$search_data;
            $ads = Model_Ads::getBySearchData($search_data)->toArray();
        }else{
            $ads = 
                isset($this->_session->search_ad)?
                    Model_Ads::getBySearchData($this->_session->search_ad)->toArray():
                    Model_Ads::getAll()->toArray();               
        }
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'date_from';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->ad_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $ads= $sort->sort($ads,$field,$order);
            
        $this->view->ads = $ads;
        
        $countries = Model_Countries::getAll()->toArray();
        $c = array('0'=>'All');
        foreach($countries as $country)
            $c[$country['id']] = $country['country']; 
        $this->view->countries = $c;
        
        $dentists = Model_Dentist::getAll();
        $d = array('0' => 'System ad');
        foreach ($dentists as $dentist){
            $current = Model_Dentist::getAccount($dentist['id']);
            $d[$dentist['id']] = $current['first_name'].' '.$current['last_name'];
        }
        $this->view->dentists = $d;
        
        $this->view->pages = Model_Page::getAll();
    }
    
    /**
     * Admin_AdsController::addAdAction()
     * Add a new advertise. It also process the request for adding a new ad and validates the data
     * before saving the new ad in the system.
     * @return
     */
    public function addAdAction(){
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $errors = array();
            if(!$_FILES['ad_image']['size']) $errors['ad_image'] = "Upload image file";
            if(!$r['page']) $errors['page'] = "Select page placement";
            else if(!isset($r['position'])) $errors['position'] = "Select on page position";
            if($r['click_limit']!="" && !is_numeric($r['click_limit'])) $errors['click_limit'] = "Numeric value required";
            if($r['impression_limit']!="" && !is_numeric($r['impression_limit'])) $errors['impression_limit'] = "Numeric value required";
            if(!empty($errors)){
                $this->view->errors = $errors;
            } else{
               $ad = array(
                  'ad_type' => $r['ad_type'],
                  'country_id' => $r['country_id'],
                  'dentist_id' => $r['dentist_id'],
                  'page' => $r['page'],
                  'position' => $r['position'],
                  'url' => $r['url'],
                  'anchor_text' => $r['anchor_text'],
                  'alt_text' => $r['alt_text'],
                  'click_limit' => $r['click_limit'],
                  'impression_limit' => $r['impression_limit'],
                  'price'   => $r['price'],
                  'date_from' => $r['date_from'],
                  'date_to' => $r['date_to'],   
               );
               move_uploaded_file($_FILES['ad_image']['tmp_name'],"images/ads/".$_FILES['ad_image']['name']);
               $ad['ad_image'] = $_FILES['ad_image']['name'];
               Model_Ads::save($ad);
               $this->_redirect('admin/ads/manager');
            }
        }
        
        $dentists = Model_Dentist::getAll();
        $d = array();
        foreach ($dentists as $dentist){
            $current = Model_Dentist::getAccount($dentist['id']);
            $d[$dentist['id']] = $current['first_name'].' '.$current['last_name'];
        }
        
        $countries = Model_Countries::getAll()->toArray();
        $c = array('0'=>'All');
        foreach($countries as $country)
            $c[$country['id']] = $country['country'];   
        
        $this->view->dentists = $d;
        $this->view->pages = Model_Page::getAll();
        $this->view->countries = $c;       
    }
    
    /**
     * Admin_AdsController::editAdAction()
     * Allows editing for an existing ad. The edited data are validated before update.
     * @return
     */
    public function editAdAction(){
        $id = $_REQUEST['id'];   
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $errors = array();
            if(!$r['page']) $errors['page'] = "Select page placement";
            else if(!isset($r['position'])) $errors['position'] = "Select on page position";
            if($r['click_limit']!="" && !is_numeric($r['click_limit'])) $errors['click_limit'] = "Numeric value required";
            if($r['impression_limit']!="" && !is_numeric($r['impression_limit'])) $errors['impression_limit'] = "Numeric value required";
            if(!empty($errors)){
                $this->view->errors = $errors;
            } else{
               $ad = array(
                  'id' => $id,
                  'ad_type' => $r['ad_type'],
                  'country_id' => $r['country_id'],
                  'dentist_id' => $r['dentist_id'],
                  'page' => $r['page'],
                  'position' => $r['position'],
                  'url' => $r['url'],
                  'anchor_text' => $r['anchor_text'],
                  'alt_text' => $r['alt_text'],
                  'click_limit' => $r['click_limit'],
                  'impression_limit' => $r['impression_limit'],
                  'price'   => $r['price'],
                  'date_from' => $r['date_from'],
                  'date_to' => $r['date_to'],   
               );
               Model_Ads::save($ad);
               $this->_redirect('admin/ads/manager');
            }
        }
        
        $dentists = Model_Dentist::getAll();
        $d = array();
        foreach ($dentists as $dentist){
            $current = Model_Dentist::getAccount($dentist['id']);
            $d[$dentist['id']] = $current['first_name'].' '.$current['last_name'];
        }
        
        $countries = Model_Countries::getAll()->toArray();
        $c = array('0'=>'All');
        foreach($countries as $country)
            $c[$country['id']] = $country['country'];   
        
        $this->view->dentists = $d;
        $this->view->pages = Model_Page::getAll();
        $this->view->countries = $c;  
        $this->view->ad = Model_Ads::getById($id);   
    }
    
    
      
    /**
     * Admin_AdsController::performanceReportAction()
     * 
     * @return
     */
    public function performanceReportAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_ad);
            unset($_REQUEST['p']);
        }
         
        $ads = Model_Ads::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            
            $search_data = array(
                'country_id' => $r['country_id'],
                'page'       => $r['page'],
                'date_from'  => $r['date_from'],
                'date_to'    => $r['date_to'],
            );
            $this->_session->search_ad=$search_data;
            $ads = Model_Ads::getBySearchData($search_data)->toArray();
        }else{
            $ads = 
                isset($this->_session->search_ad)?
                    Model_Ads::getBySearchData($this->_session->search_ad)->toArray():
                    Model_Ads::getAll()->toArray();               
        }
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'date_from';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->ad_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $ads= $sort->sort($ads,$field,$order);
            
        $this->view->ads = $ads;
        
        $countries = Model_Countries::getAll()->toArray();
        $c = array('0'=>'All');
        foreach($countries as $country)
            $c[$country['id']] = $country['country']; 
        $this->view->countries = $c;
        
        $this->view->pages = Model_Page::getAll();
    }
    
    /**
     * Admin_AdsController::switchAdAction()
     * Switches the status for a given ad, between "active" and "inactive".
     * @return
     */
    public function switchAdAction(){
        $id = $_REQUEST['id'];
        $ad = Model_Ads::getById($id)->toArray();
        $ad['hidden'] = 1-$ad['hidden'];
        Model_Ads::save($ad);
        $link = $this->linkAppend();
        $this->_redirect('admin/ads/manager'.$link);
    }
    
    /**
     * Admin_AdsController::placementMapAction()
     * Display a static page with the exaplanation of the placement codes for sample page 'A'.
     * @return
     */
    public function placementMapAction(){
        
    }
    
    /**
     * Admin_AdsController::getPagePositionsAction()
     * This action is used for AJAX request in order to get the positions for a given
     * page code. First we need to select the page an then the position (the same as states in relation
     * to countries or cities in relation to states).
     * @return
     */
    public function getPagePositionsAction(){
        $page = Model_Page::getPage($_POST['page']);
        $p = $page['positions'];
        $positions = explode(',',$p);
        $result='';
        foreach($positions as $position)
            $result.='<option value="'.$position.'">'.$page['code'].$position.'</option>';
            
        $resp = array(); 
        $resp['positions'] = $result;
        echo Zend_Json::encode($resp);exit();
    }
    
}