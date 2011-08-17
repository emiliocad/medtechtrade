<?php

/**
 * Admin_CountryController
 * This module is used for managing the various aspects regarding the countries
 * added in the system
 */
class Admin_CountryController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_CountryController::init()
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
     * Admin_CountryController::indexAction()
     * Reserved for future development.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_CountryController::managerAction()
     * Used for rendering the main page of the country manager
     * @return
     */
    public function managerAction(){
        $this->view->countries = Model_Countries::getAll();
    }
    
    /**
     * Admin_CountryController::addCountryAction()
     * Used for adding a new country in the system.
     * @return
     */
    public function addCountryAction(){
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST; $errors = array();
            if(!$r['region']) $errors['region'] = "Please select a region";
            if($r['country']=="") $errors['country'] = "Please specify the country name";
            if(!empty($errors)){
                $this->view->errors = $errors;
            }else{
                $country = array(
                    'region' => $r['region'],
                    'country'=> $r['country']
                );
                if(isset($r['hidden']))
                    $country['hidden'] = 0;
                    
                $id = Model_Countries::save($country);
                mkdir(ROOT_PATH.'/images/countries/'.$id);
                
                $country['id'] = $id;
                if(isset($this->_session->flag)){
                    $file = $this->_session->flag;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['flag'] = $file;
                    unset($this->_session->flag);
                }
                if(isset($this->_session->logo1)){
                    $file = $this->_session->logo1;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo1'] = $file;
                    unset($this->_session->logo1);
                }
                if(isset($this->_session->logo2)){
                    $file = $this->_session->logo2;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo2'] = $file;
                    unset($this->_session->logo2);
                }
                if(isset($this->_session->logo3)){
                    $file = $this->_session->logo3;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo3'] = $file;
                    unset($this->_session->logo3);
                }
                Model_Countries::save($country);
                $this->_redirect('admin/country/manager');
            }
        }
    }
    
    /**
     * Admin_CountryController::editCountryAction()
     * Used for editing the params for an existing country.
     * @return
     */
    public function editCountryAction(){
        $id = $this->_getParam('id');
        $this->view->country = Model_Countries::getById($id);
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST; $errors = array();
            if(!$r['region']) $errors['region'] = "Please select a region";
            if($r['country']=="") $errors['country'] = "Please specify the country name";
            if(!empty($errors)){
                $this->view->errors = $errors;
            }else{
                $country = array(
                    'id'     => $r['id'],   
                    'region' => $r['region'],
                    'country'=> $r['country']
                );
                $country['hidden'] = isset($r['hidden'])? 0 : 1;
                
                if(isset($this->_session->flag)){
                    $file = $this->_session->flag;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['flag'] = $file;
                    unset($this->_session->flag);
                }
                if(isset($this->_session->logo1)){
                    $file = $this->_session->logo1;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo1'] = $file;
                    unset($this->_session->logo1);
                }
                if(isset($this->_session->logo2)){
                    $file = $this->_session->logo2;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo2'] = $file;
                    unset($this->_session->logo2);
                }
                if(isset($this->_session->logo3)){
                    $file = $this->_session->logo3;
                    rename('images/countries/'.$file,'images/countries/'.$id.'/'.$file);
                    $country['logo3'] = $file;
                    unset($this->_session->logo3);
                }
                Model_Countries::save($country);
                $this->_redirect('admin/country/manager');
            }
        }
    }
    
    /**
     * Admin_CountryController::switchCountryAction()
     * Used for enabling/disabling an existing country.
     * @return
     */
    public function switchCountryAction(){
        $id = $this->_getParam('id');
        $country = Model_Countries::getById($id)->toArray();
        $country['hidden'] = 1-$country['hidden'];
        Model_Countries::save($country);
        $this->_redirect('admin/country/manager');
    }
    
    /**
     * Admin_CountryController::manageCountryAreasAction()
     * Manager for districts/states for a given area.
     * @return
     */
    public function manageCountryAreasAction(){
        $id = $this->_getParam('id');
        $country = Model_Countries::getById($id);
        $this->view->country = $country;
        $this->view->areas = Model_States::getAllByCountryId($id);
    }
    
    /**
     * Admin_CountryController::addStateAction()
     * Used for adding a new state/district to an existing country
     * @return
     */
    public function addStateAction(){
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $state = array(
                'country_id' => $r['country_id'],
                'name'       => $r['name'],
                'hidden'     => isset($r['hidden']) ? 0 : 1
            );
            Model_States::save($state);
            $this->_redirect('admin/country/manage-country-areas?id='.$r['country_id']);
        }
    }
    
    /**
     * Admin_CountryController::switchStateAction()
     * Used for enabling/disabling certain states from the frontend
     * @return
     */
    public function switchStateAction(){
        $id = $this->_getParam('id');
        $state = Model_States::getById($id)->toArray();
        $state['hidden'] = 1-$state['hidden'];
        Model_States::save($state);
        $this->_redirect('admin/country/manage-country-areas?id='.$state['country_id']);
    }
    
    /**
     * Admin_CountryController::manageStateAction()
     * Used for managing the cities in a certain state/district.
     * @return
     */
    public function manageStateAction(){
        $id = $this->_getParam('id');
        $state = Model_States::getById($id)->toArray();
        $countries = Model_Countries::getAll()->toArray();
        
        $c = array();
        foreach($countries as $country)
            $c[$country['id']] = $country['country'];
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $state = array(
                'id'            => $r['id'],
                'country_id'    => $r['country_id'],
                'name'          => $r['name'],
                'hidden'        => isset($r['hidden']) ? 0 : 1
            );
            Model_States::save($state);
        }
        
        if(isset($_REQUEST['add_city'])){
            $r = $_REQUEST;
            $city = array(
                'state_id' => $r['id'],
                'name'     => $r['name'],
                'hidden'   => isset($r['hidden']) ? 0 : 1
            );
            Model_Cities::save($city);
        }
        
        $this->view->state = $state;
        $this->view->countries = $c;
        $this->view->cities = Model_Cities::getAllByStateId($id);
        
    }
    
    /**
     * Admin_CountryController::switchCityAction()
     * Used for enabling/disabling a certain city.
     * @return
     */
    public function switchCityAction(){
        $id = $this->_getParam('id');
        $city = Model_Cities::getById($id)->toArray();
        $city['hidden'] = 1-$city['hidden'];
        Model_Cities::save($city);
        $this->_redirect('admin/country/manage-state?id='.$city['state_id']);
    }
}