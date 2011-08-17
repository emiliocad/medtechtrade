<?php

/**
 * Admin_TestimonialController
 * Module for administering all the testimonials in the system (for dentists)
 */
class Admin_TestimonialController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_TestimonialController::linkAppend()
     * 
     * @return
     */
    private function linkAppend(){
        $link="";
        if(isset($this->_session->display)){
            $d = $this->_session->display;
            $link = "/?p=".$d['page']."&f=".$d['field']."&o=".$d['order'];
        };
        return $link;
    }

    /**
     * Admin_TestimonialController::init()
     * 
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
     * Admin_TestimonialController::indexAction()
     * Reserved for future development.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_TestimonialController::managerAction()
     * The main page of the testimonials manager
     * @return
     */
    public function managerAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_data);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['testimonials'])){
            if($_REQUEST['status']==0)
                foreach($_REQUEST['testimonials'] as $testimonial) Model_Testimonials::activate($testimonial);
            else
                foreach($_REQUEST['testimonials'] as $testimonial) Model_Testimonials::inactivate($testimonial);
        }
        $dentists = Model_Dentist::getAll();
        $business = array();
        foreach ($dentists as $dentist) $business[$dentist['id']] = $dentist['business_name'];
        $this->view->business_names = $business;
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'dentist_id'=> $r['dentist_id'],
                'author'    => $r['author'],
                'date_from'   => $r['date_from'],
                'date_to'   => $r['date_to'],
                'status'    => $r['status']
            );
            switch($r['status']){
                case 0: break;
                case 1: $search_data['deleted'] = -1; break;
                case 2: $search_data['deleted'] = 0; $search_data['hidden'] = -1; break;
                case 3: $search_data['deleted'] = 0; $search_data['hidden'] = 0; break;
                case 4: $search_data['deleted'] = 0; $search_data['hidden'] = 1; break;
                case 5: $search_data['deleted'] = 1; $search_data['hidden'] = 1; break;
            };
            $this->_session->search_data=$search_data;
            $this->view->testimonials = Model_Testimonials::getBySearchData($search_data);
        }else{  
            $this->view->testimonials = 
                isset($this->_session->search_data)?
                    Model_Testimonials::getBySearchData($this->_session->search_data) :
                    Model_Testimonials::getAll();
        }
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->testimonials= $sort->sort($this->view->testimonials,$field,$order);
    }
    
    /**
     * Admin_TestimonialController::switchTestimonialAction()
     * Used for switching the status for a given testimonial from "visible" to "hidden".
     * @return
     */
    public function switchTestimonialAction(){
        $id = $this->_getParam('id');
        $testimonial = Model_Testimonials::getById($id)->toArray();
        if($testimonial['hidden']==-1) $testimonial['hidden']=1;
        $testimonial['hidden'] = 1-$testimonial['hidden'];
        $testimonial['deleted'] = 0;
        Model_Testimonials::save($testimonial);
        $link = $this->linkAppend();
        $this->_redirect('admin/testimonial/manager'.$link);
    }
    
    /**
     * Admin_TestimonialController::approveTestimonialAction()
     * Used for switching the status for a given testimonial to "approved".
     * @return
     */
    public function approveTestimonialAction(){
        $id = $this->_getParam('id');
        Model_Testimonials::approve($id);
        $link = $this->linkAppend();
        $this->_redirect('admin/testimonial/manager'.$link);
    }
    
    /**
     * Admin_TestimonialController::disapproveTestimonialAction()
     * Used for switching the status for a given testimonial to "disapproved". 
     * @return
     */
    public function disapproveTestimonialAction(){
        $id = $this->_getParam('id');
        Model_Testimonials::disapprove($id);
        $link = $this->linkAppend();
        $this->_redirect('admin/testimonial/manager'.$link);
    }
    
    /**
     * Admin_TestimonialController::editTestimonialAction()
     * Used for editing a testimonial.
     * @return
     */
    public function editTestimonialAction(){
        $id = $this->_getParam('id');
        $t = Model_Testimonials::getById($id)->toArray();
        $d = Model_Dentist::getById($t['dentist_id']);
        $t['business'] = $d['business_name'];
        if(isset($_REQUEST['save'])){
           $r = $_REQUEST;
           $t['author'] = $r['author'];
           $t['content'] = $r['content'];
           $t['rating'] = $r['rating'];
           switch($r['status']){
                case 1: $t['deleted'] = -1; break;
                case 2: $t['deleted'] = 0; $t['hidden'] = -1; break;
                case 3: $t['deleted'] = 0; $t['hidden'] = 0; break;
                case 4: $t['deleted'] = 0; $t['hidden'] = 1; break;
                case 5: $t['deleted'] = 1; $t['hidden'] = 1; break;
            };
            
            unset($t['business']);
            Model_Testimonials::save($t);
            $link = $this->linkAppend();
        $this->_redirect('admin/testimonial/manager'.$link);
        }
        $this->view->testimonial = $t;
    }
    
}


