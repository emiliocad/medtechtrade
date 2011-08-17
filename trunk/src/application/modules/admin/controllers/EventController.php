<?php

/**
 * Admin_EventController
 * This is the module for management of the events for dentists.
 */
class Admin_EventController extends Zend_Controller_Action
{
    protected $_session;
    
    /**
     * Admin_EventController::linkAppend()
     * Used for adding the params of the last viewed page in Event Manager.
     * @return
     */
    private function linkAppend(){
        $link="";
        if(isset($this->_session->event_display)){
            $d = $this->_session->event_display;
            $link = "/?p=".$d['page']."&f=".$d['field']."&o=".$d['order'];
        };
        return $link;
    }

    /**
     * Admin_EventController::init()
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
     * Admin_EventController::indexAction()
     * Reserved for future development.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_EventController::managerAction()
     * Used for rendering the main page of the events manager.
     * @return
     */
    public function managerAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_event);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['events'])){
            if($_REQUEST['status']==0)
                foreach($_REQUEST['events'] as $event) Model_Events::activate($event);
            else
                foreach($_REQUEST['events'] as $event) Model_Events::inactivate($event);    
        } 
        $this->view->events = Model_Events::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'name'      => $r['name'],
                'location'  => $r['location'],
                'event_type'=> $r['event_type'],
                'date_from' => $r['date_from'],
                'date_to'   => $r['date_to'],
                'subject'   => $r['subject']
            );
            $this->_session->search_event=$search_data;
            $this->view->events = Model_Events::getBySearchData($search_data)->toArray();
        }else{
            $this->view->events = 
                isset($this->_session->search_event)?
                    Model_Events::getBySearchData($this->_session->search_event)->toArray():
                    Model_Events::getAll()->toArray();               
        }
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'date_from';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->event_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->events= $sort->sort($this->view->events,$field,$order);
    }
    
    /**
     * Admin_EventController::switchEventAction()
     * Used for enabling/disabling of a certain event.
     * @return
     */
    public function switchEventAction(){
        $id = $this->_getParam('id');
        $event = Model_Events::getById($id)->toArray();
        $event['hidden'] = 1-$event['hidden'];
        Model_Events::save($event);
        $link = $this->linkAppend();
        $this->_redirect('admin/event/manager'.$link);
    }
    
    /**
     * Admin_EventController::addEventAction()
     * Used for adding a new event in the system.
     * @return
     */
    public function addEventAction(){
        if(isset($_REQUEST['save'])){
            $errors=array(); $r=$_REQUEST;
            if($r["name"]=="") $errors["name"]="Event Name should not be empty";            
            if($r["subject"]=="") $errors["subject"]="Subject should not be empty";
            if($r["event_type"]=="0") $errors["event_type"]="Please select an event type";
            if($r["location"]=="") $errors["location"]="Location should not be empty";
            if($r["date_from"]=="") $errors["date_from"]="Please select a start date";
            if($r["date_to"]=="") $errors["date_to"]="Please select an end date";
            if($r["date_display"]=="") $errors["date_display"]="Please specify the event interval for frontend";
            if(!$_FILES['logo']['size']) $errors["file"]="Please upload a small logo for this event";
            if(!empty($errors))
                $this->view->errors = $errors;
            else{
                $event=array(
                    'name'          => $r["name"],
                    'subject'       => $r["subject"],
                    'event_type'    => $r["event_type"],
                    'location'      => $r["location"],
                    'date_from'     => $r["date_from"],
                    'date_to'       => $r["date_to"],
                    'date_display'  => $r["date_display"],
                    'url'           => $r["url"]
                );
                if(isset($r['hidden'])) $event['hidden']=$r['hidden'];
                $event_id = Model_Events::save($event);
                $file = explode('.',$_FILES['logo']['name']);
                $file = $file[0].$event_id.'.'.$file[count($file)-1];
                move_uploaded_file($_FILES['logo']['tmp_name'],'images/eventlogos/'.$file);
                $event = array(
                    'id'    =>$event_id,
                    'logo'  =>$file
                );
                Model_Events::save($event);
                $link = $this->linkAppend();
                $this->_redirect('admin/event/manager'.$link);
            } 
        }
    }
    
    /**
     * Admin_EventController::editEventAction()
     * Used for editing an existing event.
     * @return
     */
    public function editEventAction(){
        $event_id = $this->_getParam('id');
        $this->view->event = Model_Events::getById($event_id);
        if(isset($_REQUEST['save'])){
            $errors=array(); $r=$_REQUEST;
            if($r["name"]=="") $errors["name"]="Event Name should not be empty";            
            if($r["subject"]=="") $errors["subject"]="Subject should not be empty";
            if($r["event_type"]=="0") $errors["event_type"]="Please select an event type";
            if($r["location"]=="") $errors["location"]="Location should not be empty";
            if($r["date_from"]=="") $errors["date_from"]="Please select a start date";
            if($r["date_to"]=="") $errors["date_to"]="Please select an end date";
            if($r["date_display"]=="") $errors["date_display"]="Please specify the event interval for frontend";
            if(!empty($errors))
                $this->view->errors = $errors;
            else{
                $event=array(
                    'id'            => $r['id'],
                    'name'          => $r["name"],
                    'subject'       => $r["subject"],
                    'event_type'    => $r["event_type"],
                    'location'      => $r["location"],
                    'date_from'     => $r["date_from"],
                    'date_to'       => $r["date_to"],
                    'date_display'  => $r["date_display"],
                    'url'           => $r["url"]
                );
                if(isset($r['hidden'])) $event['hidden']=$r['hidden'];
                if($_FILES['logo']['size']){
                    unlink(ROOT_PATH.'images/eventlogos/'.$event['logo']);
                    $file = explode('.',$_FILES['logo']['name']);
                    $file = $file[0].$event_id.'.'.$file[count($file)-1];
                    move_uploaded_file($_FILES['logo']['tmp_name'],'images/eventlogos/'.$file);
                    $event['logo'] = $file;
                }
                Model_Events::save($event);
                $link = $this->linkAppend();
                $this->_redirect('admin/event/manager'.$link);
            } 
        }
    }
    
    
}