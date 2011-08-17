<?php

/**
 * Admin_UsersController
 * Used for the management of the users in the system
 */
class Admin_UsersController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_UsersController::linkAppend()
     * Used for adding the params of the last viewed page in Users Manager.
     * @param array $d
     * @return string
     */
    private function linkAppend($d = NULL){
        $link="";
        if($d){
            $link = "/?p=".$d['page']."&f=".$d['field']."&o=".$d['order'];
        };
        return $link;
    }
    
    /**
     * Admin_UsersController::init()
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
     * Admin_UsersController::indexAction()
     * Executed for each request in order to update the session data.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_UsersController::administratorsAction()
     * The manager for existing system admins. Available only to superadmin.
     * @return
     */
    public function administratorsAction(){
                
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_admin);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['admins'])){
            if($_REQUEST['status']==0)
                foreach($_REQUEST['admins'] as $admin) Model_Administrator::activate($admin);
            else
                foreach($_REQUEST['admins'] as $admin) Model_Administrator::inactivate($admin);    
        }
               
        $this->view->administrators = Model_Administrator::getAll();
        if(isset($_REQUEST['search'])){
            $this->_session->search_admin = $_REQUEST['text'];
            $this->view->administrators=Model_Administrator::getBySearchTerm($_REQUEST['text']);
        }else{
            $this->view->administrators = 
                isset($this->_session->search_admin)?
                Model_Administrator::getBySearchTerm($this->_session->search_admin):
                Model_Administrator::getAll();
        }
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->admin_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->administrators= $sort->sort($this->view->administrators->toArray(),$field,$order);
    }
    
    /**
     * Admin_UsersController::switchAdminAction()
     * Used for disabling/enabling an existing administrator account
     * @return
     */
    public function switchAdminAction(){
        $id = $this->_getParam('id');
        $admin = Model_Administrator::getById($id)->toArray();
        if(!$admin['superadmin']) $admin['hidden'] = 1-$admin['hidden'];
        Model_Administrator::save($admin);
        $link = $this->linkAppend($this->_session->admin_display);
        $this->_redirect('admin/users/administrators'.$link);
    }
    
    /**
     * Admin_UsersController::addAdministratorAction()
     * Used for adding a new administrator account
     * @return
     */
    public function addAdministratorAction(){
        if(isset($_REQUEST['save'])){
            $errors=array(); $r=$_REQUEST;
            if(empty($r['username']))   $errors['username']="User Name is empty";
            if(empty($r['first_name'])) $errors['first_name']="First Name is empty";
            if(empty($r['last_name']))  $errors['last_name']="Last Name is empty";
            if(empty($r['alias']))      $errors['alias']="Alias is empty";
            if(empty($r['email']))      $errors['email']="E-mail Address is empty";
            else if(!Zend_Validate::is($r['email'],"EmailAddress")) $errors['email']="E-mail Address is invalid";
            if(!empty($r['work_email'])&&!Zend_Validate::is($r['work_email'],"EmailAddress")) $errors['work_email']="Work E-mail is invalid";
            if(empty($r['password']))   $errors['password'] ="Please enter a password";
            else if(empty($r['retype_password'])) $errors['retype_password'] = "Please re-enter the password";
            else if($r['password']!==$r['retype_password']) $errors['password'] = "Passwords did not match"; 
            if(!empty($errors)) $this->view->errors = $errors;
            else{
                $admin = array(
                    'username'       => $r['username'],
                    'first_name'     => $r['first_name'],
                    'last_name'      => $r['last_name'],
                    'alias'          => $r['alias'],
                    'display'        => $r['display'],
                    'email'          => $r['email'],
                    'work_email'     => $r['work_email'],
                    'password'       => $r['password']
                );
                Model_Administrator::save($admin);
                $link = $this->linkAppend($this->_session->admin_display);
                $this->_redirect('admin/users/administrators'.$link);
            }
        }
    }
    
    /**
     * Admin_UsersController::editAdministratorAction()
     * Used for editing an existing administrator account.
     * @return
     */
    public function editAdministratorAction(){
        $id = $_REQUEST['id'];
        $admin = Model_Administrator::getById($id);
        $this->view->administrator = $admin;
        if(isset($_REQUEST['save'])){
            $errors=array(); $r=$_REQUEST;
            if(empty($r['username']))   $errors['username']="User Name is empty";
            if(empty($r['first_name'])) $errors['first_name']="First Name is empty";
            if(empty($r['last_name']))  $errors['last_name']="Last Name is empty";
            if(empty($r['alias']))      $errors['alias']="Alias is empty";
            if(empty($r['email']))      $errors['email']="E-mail Address is empty";
            else if(!Zend_Validate::is($r['email'],"EmailAddress")) $errors['email']="E-mail Address is invalid";
            if(!empty($r['work_email'])&&!Zend_Validate::is($r['work_email'],"EmailAddress")) $errors['work_email']="Work E-mail is invalid";
            if(!empty($r['password'])){
                if(empty($r['retype_password'])) $errors['retype_password'] = "Please re-enter the password";
                else if($r['password']!==$r['retype_password']) $errors['password'] = "Passwords did not match";
            } 
            if(!empty($errors)) $this->view->errors = $errors;
            else{
                $admin = array(
                    'id'             => $r['id'],
                    'username'       => $r['username'],
                    'first_name'     => $r['first_name'],
                    'last_name'      => $r['last_name'],
                    'alias'          => $r['alias'],
                    'display'        => $r['display'],
                    'email'          => $r['email'],
                    'work_email'     => $r['work_email']
                );
                if($r['password']!="") $admin['password'] = $r['password'];
                Model_Administrator::save($admin);
                $link = $this->linkAppend($this->_session->admin_display);
                $this->_redirect('admin/users/administrators'.$link);
            }
        }
    }
    
    /**
     * Admin_UsersController::patientsAction()
     * The manager for patients. Available to all admins.
     * @return
     */
    public function patientsAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_patient);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['patients'])){
            if($_REQUEST['status']==0)
                foreach($_REQUEST['patients'] as $patient) Model_Account::activate($patient);
            else
                foreach($_REQUEST['patients'] as $patient) Model_Account::inactivate($patient);
                
        }
        $patients = Model_Account::getAll();
        if(isset($_REQUEST['search'])){
            $this->_session->search_patient = $_REQUEST['text'];
            $patients=Model_Account::getBySearchTerm($_REQUEST['text']);
        }else{
            $patients = 
                isset($this->_session->search_patient)?
                Model_Account::getBySearchTerm($this->_session->search_patient):
                Model_Account::getAll();
        }
        $p = array();
        foreach ($patients as $key=>$patient)
            if(!Model_Account::isDentist($patient['id'])) $p[]=$patient;
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->patient_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $p= $sort->sort($p,$field,$order);
        
        $this->view->patients = $p;    
    }
    
    /**
     * Admin_UsersController::switchPatientAction()
     * Used for disabling/enabling an existing patient account
     * @return
     */
    public function switchPatientAction(){
        $id = $this->_getParam('id');
        $patient = Model_Account::getById($id)->toArray();
        $patient['hidden'] = 1-$patient['hidden'];
        Model_Account::save($patient);
        $link = $this->linkAppend($this->_session->patient_display);
        $this->_redirect('admin/users/patients'.$link);
    }
    
    /**
     * Admin_UsersController::addPatientAction()
     * Used for adding a new patient account
     * @return
     */
    public function addPatientAction(){
        $this->view->section_titles = Model_Language::getAllByPrefixAndLanguage("register_section");
        $this->view->labels = Model_Language::getAllByPrefixAndLanguage("label");
        if(isset($_REQUEST['save'])){
        //validate the data from the Register Form
            $errors = array();
            $msg = Model_Language::getAllByPrefixAndLanguage("error");
            $validator = new Zend_Validate(); //generic validator
            $r = $_REQUEST; //shortcut for the _REQUEST global          
            if($r['username']=="") $errors['username']=$msg['error_username_empty'];
            else {
                $u = Model_Account::getByUsername($r['username']);
                if(!empty($u)) $errors['username'] = $msg['error_username_existing'];
            }
            if($r['email']=="") $errors['email']=$msg['error_email_address_empty'];
            else if(!$validator->is($r['email'],"EmailAddress")) $errors['email']=$msg['error_email_address_invalid'];
            else {
                $u = Model_account::getByEmail($r['email']);
                if(!empty($u)) $errors['email'] = $msg['error_email_address_existing'];
            }
            if($r['password']=="") $errors['password']=$msg['error_password_empty'];
            else if($r['retype_password']=="") $errors['retype_password']=$msg['error_retype_password_empty'];
            else if(strcmp($r['password'],$r['retype_password'])) $errors['password']=$msg['error_password_mismatch']; 
            if($r['first_name']=="") $errors['first_name']=$msg['error_firstname_empty'];
            if($r['last_name']=="") $errors['last_name']=$msg['error_lastname_empty'];
            if($r['city']=="") $errors['city']=$msg['error_city_empty'];
            if($r['state']=="") $errors['state']=$msg['error_state_empty'];
            if($r['country']=="") $errors['country']=$msg['error_country_empty'];
            if($r['phone_number']=="") $errors['phone_number']=$msg['error_telephone_number_empty'];
            
            if(!empty($errors)){
                $this->view->errors = $errors;
            }
            else {
                $r = $_REQUEST;
                $account = array(
                    'username'      => $r['username'],
                    'password'      => $r['password'],
                    'first_name'    => $r['first_name'],
                    'last_name'     => $r['last_name'],
                    'city'          => $r['city'], 
                    'state'         => $r['state'],
                    'country'       => $r['country'],
                    'phone_number'  => $r['phone_number'],
                    'email'         => $r['email']
                );
                if(isset($r['hidden'])) $account['hidden'] = $r['hidden'];
                Model_Account::save($account);
                $link = $this->linkAppend($this->_session->patient_display);
                $this->_redirect('admin/users/patients'.$link);   
            }
        }
    }
    
    /**
     * Admin_UsersController::editPatientAction()
     * Used for editing an existing patient account
     * @return
     */
    public function editPatientAction(){
        $this->view->section_titles = Model_Language::getAllByPrefixAndLanguage("register_section");
        $this->view->labels = Model_Language::getAllByPrefixAndLanguage("label");
        $id = $this->_getParam('id');
        $this->view->patient = Model_Account::getById($id);
        if(isset($_REQUEST['save'])){
        //validate the data from the Register Form
            $errors = array();
            $msg = Model_Language::getAllByPrefixAndLanguage("error");
            $validator = new Zend_Validate(); //generic validator
            $r = $_REQUEST; //shortcut for the _REQUEST global          
            if($r['username']=="") $errors['username']=$msg['error_username_empty'];
            else {
                $u = Model_Account::getByUsername($r['username']);
                if(!empty($u)&& $u['id']!==$id) $errors['username'] = $msg['error_username_existing'];
            }
            if($r['email']=="") $errors['email']=$msg['error_email_address_empty'];
            else if(!$validator->is($r['email'],"EmailAddress")) $errors['email']=$msg['error_email_address_invalid'];
            else {
                $u = Model_Account::getByEmail($r['email']);
                if(!empty($u)&& $u['id']!==$id) $errors['email'] = $msg['error_email_address_existing'];
            }
            if($r['password']!="" && strcmp($r['password'],$r['retype_password'])) $errors['password']=$msg['error_password_mismatch']; 
            if($r['first_name']=="") $errors['first_name']=$msg['error_firstname_empty'];
            if($r['last_name']=="") $errors['last_name']=$msg['error_lastname_empty'];
            if($r['city']=="") $errors['city']=$msg['error_city_empty'];
            if($r['state']=="") $errors['state']=$msg['error_state_empty'];
            if($r['country']=="") $errors['country']=$msg['error_country_empty'];
            if($r['phone_number']=="") $errors['phone_number']=$msg['error_telephone_number_empty'];
            
            if(!empty($errors)){
                $this->view->errors = $errors;
            }
            else {
                $r = $_REQUEST;
                $account = array(
                    'id'            => $r['id'],
                    'username'      => $r['username'],
                    'first_name'    => $r['first_name'],
                    'last_name'     => $r['last_name'],
                    'city'          => $r['city'], 
                    'state'         => $r['state'],
                    'country'       => $r['country'],
                    'phone_number'  => $r['phone_number'],
                    'email'         => $r['email']
                );
                if($r['password']!="") $account['password'] = $r['password'];
                Model_Account::save($account);
                $link = $this->linkAppend($this->_session->patient_display);
                $this->_redirect('admin/users/patients'.$link);   
            }
        } 
    }
    
    /**
     * Admin_UsersController::dentistsAction()
     * The manager for dentists. Available to all admins.
     * @return
     */
    public function dentistsAction(){
        if(isset($_REQUEST['view'])) $this->_session->view_dentists = $_REQUEST['view'];
        else if(!isset($this->_session->view_dentists)) $this->_session->view_dentists = "all"; 
        
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_dentist);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['dentists'])){
            if($_REQUEST['status']==0)
                foreach($_REQUEST['dentists'] as $dentist) Model_Account::activate($dentist);
            else
                foreach($_REQUEST['dentists'] as $dentist) Model_Account::inactivate($dentist);
               
        }
        $dentists = Model_Account::getAll(); 
        if(isset($_REQUEST['search'])){
            $this->_session->search_dentist = $_REQUEST['text'];
            $dentists=Model_Account::getBySearchTerm($_REQUEST['text']);
        }else{
            $dentists = 
                isset($this->_session->search_dentist)?
                Model_Account::getBySearchTerm($this->_session->search_dentist):
                Model_Account::getAll();
        }
            
        $d = array();$pending_images = array(); $headshots = array();
        foreach ($dentists as $key=>$dentist){
            if(Model_Account::isDentist($dentist['id'])){
                $p = Model_Dentist::getByAccountId($dentist['id']);
                $pi = Model_Images::getAllPendingImagesByDentist($p['id']);
                $add = $this->_session->view_dentists ==="all" || 
                       ($this->_session->view_dentists ==="pending" && !empty($pi) ); 
                if($add){
                    $dent = Model_Dentist::getByAccountId($dentist['id']);
                    $mplan = Model_Membership::getByDentistId($dent['id']);
                    $mplan = array('membership_plan' =>$mplan['membership_type']);
                    $dentist = array_merge($dentist->toArray(),$mplan); 
                    $d[]=$dentist;
                    $pending_images[$dentist['id']] = $pi;
                    $headshots[$dentist['id']] = array(
                        'image' => $p['headshot_image'],
                        'id'=> $p['id'],
                        'enabled_headshot'=>$p['enabled_headshot']);
                }
            }
        }
        

        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->dentist_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $d= $sort->sort($d,$field,$order);
        
        $membership_plans = Model_MembershipPlans::getAll();
        $mp = array();
        foreach($membership_plans as $plan)
          $mp[$plan['id']] = Model_Language::getByKey($plan['name']);
        
        $this->view->headshots = $headshots;
        $this->view->dentists = $d; 
        $this->view->pending_images = $pending_images;
        $this->view->membership_names = $mp;
    }
	
	/**
	 * Admin_UsersController::updatePayPalProfile()
	 * 
	 * @param mixed $account
	 * @return
	 */
	private function updatePayPalProfile($account){
		###START: Update PayPal Recurring Profile
        $dentist = Model_Dentist::getByAccountId($account['id']);
		$payment = Model_Membership::getByDentistId($dentist['id']);
		
		$bootstrap = $this->getInvokeArg('bootstrap');
    	$config = $bootstrap->getOption('payments');
        $paypal = A25_Payments_PayPal::getInstance($config['paypal']);
		if ($account['hidden']==1){
			//Cancel PayPal Subscription
			if (!empty($payment['paypal_account']))
				$paypal->cancelRecurringPayment($payment['paypal_account']);
		}elseif ($payment['membership_type']!=1){
			//Get Payment Details
			$plan = Model_MembershipPlans::getById($payment['membership_type']);
			if (!$payment['frequency'])$payment['frequency']=1;
			$AMT = $plan['price_month'];
			$BILLINGFREQUENCY =$payment['frequency'];
			switch($payment['frequency']){
				case 1: $AMT = $plan['price_month'];break;
				case 6: $AMT = $plan['price_half_year'];break;
				case 12: $AMT = $plan['price_year_new'];break;
			}
			//Set Recurring Payment Start Date
			$startDate = Zend_Date::now()->addMinute(3)->toString('yyyy-MM-dd HH:mm:ss');
			//Create Recurring Payment
			$api_return = $paypal->createCreditCardRecurringPayment(array(
    			"AMT"=>$AMT,
    			"DESC"=> 'Membership Subscription',
    			"CURRENCYCODE"=>"USD",
    			"BILLINGPERIOD"=>"Month",
    			"BILLINGFREQUENCY"=>$BILLINGFREQUENCY,
    			"CREDITCARDTYPE"=>$payment['credit_card_type'],
    			"ACCT"=>$payment['credit_card_number'],
    			"CVV2"=>$payment['security_code'],
    			"EXPDATE"=>$payment['expiration_month'].$payment['expiration_year'],
    			"FIRSTNAME"=>$payment['first_name'],
    			"LASTNAME"=>$payment['last_name'],
    			"SUBSCRIBERNAME"=>$payment['first_name'].' '.$payment['last_name'],
    			"STREET" => $payment['address'],
    			"STREET2" => $payment['address2'],
    			"CITY" => $payment['city'],
    			"STATE" => $payment['state'],
    			"COUNTRYCODE" => $payment['country_code'],
    			"ZIP" => $payment['zip_code']
    		), $startDate);
			//Redirect with message on ERROR
			if (!$api_return['success'])
				$this->_redirect('admin/users/dentists?ERR='.urlencode("Unable to create recurring profile"));
			else {
				//Save new profile id in the database
				$payment['paypal_account']=$api_return['profile_id'];
				Model_Membership::save($payment->toArray());
			}
		}
		###END: Update PayPal Recurring Profile
	}
	
    /**
     * Admin_UsersController::switchDentistAction()
     * Used for disabling/enabling an existing dentist account
     * @return
     */
    public function switchDentistAction(){
        $id = $this->_getParam('id');
        $dentist = Model_Account::getById($id)->toArray();
        $dentist['hidden'] = 1-$dentist['hidden'];
        Model_Account::save($dentist);
		//Update PayPal Profile
		$this->updatePayPalProfile($dentist);
        $link = $this->linkAppend($this->_session->dentist_display);
        $this->_redirect('admin/users/dentists'.$link);
    }
    
    /**
     * Admin_UsersController::addDentistAction()
     * Used for adding a new dentist account
     * @return
     */
    public function addDentistAction(){
        $language="EN";
        $this->view->questions = Model_Language::getAllByPrefixAndLanguage("register_question",$language);
        $this->view->section_titles = Model_Language::getAllByPrefixAndLanguage("register_section",$language);
        $this->view->labels = Model_Language::getAllByPrefixAndLanguage("label",$language);
        $this->view->schedule_labels = Model_Language::getAllByPrefixAndLanguage("day",$language);
        
        $this->view->price_ranges = Model_Prices::getAll();
        $this->view->services = Model_Services::getAllServicesByLanguage($language,'0');
        $this->view->dental_specialties = Model_DentalSpecialties::getAllDentalSpecialtiesByLanguage($language,'0');
        $this->view->dental_procedures = Model_DentalProcedures::getAllDentalProceduresByLanguage($language,'0');
        $this->view->facilities = Model_Facilities::getAllFacilitiesByLanguage($language,'0');
        $this->view->spoken_languages = Model_SpokenLanguages::getAllSpokenLanguagesByLanguage($language,'0');
        $this->view->discount_plans = Model_DiscountPlans::getAllDiscountPlansByLanguage($language,'0');
        $this->view->brands = Model_Brands::getAll(NULL,'0');
        $this->view->payment_options = Model_PaymentOptions::getAllPaymentOptionsByLanguage($language,'0');
        $this->view->credit_cards = Model_CreditCards::getAll(null,'0');
        $this->view->additional_services = Model_AdditionalServices::getAllAdditionalServicesByLanguage($language,'0');
        
        if(isset($_REQUEST['save'])){
        //validate the data from the Register Form
            $errors = array();
            $msg = Model_Language::getAllByPrefixAndLanguage("error",$language);
            $validator = new Zend_Validate(); //generic validator
            $r = $_REQUEST; //shortcut for the _REQUEST global
            
            if($r['username']=="") $errors['username']=$msg['error_username_empty'];
            else {
                $u = Model_Account::getByUsername($r['username']);
                if(!empty($u)) $errors['username'] = $msg['error_username_existing'];
            }
            if($r['email']=="") $errors['email']=$msg['error_email_address_empty'];
            else if(!$validator->is($r['email'],"EmailAddress")) $errors['email']=$msg['error_email_address_invalid'];
            else {
                $u = Model_Account::getByEmail($r['email']);
                if(!empty($u)) $errors['email'] = $msg['error_email_address_existing'];
            }
            if($r['password']=="") $errors['password']=$msg['error_password_empty'];
            else if($r['retype_password']=="") $errors['retype_password']=$msg['error_retype_password_empty'];
            else if(strcmp($r['password'],$r['retype_password'])) $errors['password']=$msg['error_password_mismatch']; 
            if($r['first_name']=="") $errors['first_name']=$msg['error_firstname_empty'];
            if($r['last_name']=="") $errors['last_name']=$msg['error_lastname_empty'];
            if($r['business_name']=="") $errors['business_name']=$msg['error_business_name_empty'];
            if($r['business_address']=="") $errors['business_address']=$msg['error_business_address_empty'];
            if($r['city']=="") $errors['city']=$msg['error_city_empty'];
            if($r['state']=="") $errors['state']=$msg['error_state_empty'];
            if($r['zip_code']=="") $errors['zip_code']="Zip Code should not be empty";
            if($r['country']=="") $errors['country']=$msg['error_country_empty'];
            if($r['phone_number']=="") $errors['phone_number']=$msg['error_telephone_number_empty'];
            if($r['dental_degree']=="") $errors['dental_degree']=$msg['error_dental_degree_empty'];
            if($r['specialty']=="") $errors['specialty']=$msg['error_specialty_empty'];
            if($r['license_number']=="") $errors['license_number']=$msg['error_license_number_empty'];
            if($r['years_of_experience']=="") $errors['years_of_experience']=$msg['error_years_of_experience_empty'];
            if($r['school_1']=="") $errors['school_1']=$msg['error_schoolname_empty'];
            if($r['school_2']=="") $errors['school_2']=$msg['error_schoolname_empty'];
            if(!$r['price_range']) $errors['price_range']=$msg['error_price_range_not_selected'];
            if(!empty($errors)){
                $this->view->errors = $errors;
            }
            else {
                //save the new dentist account
                $s = $r;
                $account = array(
                    'username'      => $s['username'],
                    'password'      => $s['password'],
                    'first_name'    => $s['first_name'],
                    'last_name'     => $s['last_name'],
                    'city'          => $s['city'], 
                    'state'         => $s['state'],
                    'country'       => $s['country'],
                    'zip_code'      => $s['zip_code'],
                    'phone_number'  => $s['phone_number'],
                    'email'         => $s['email']
                );
                $account_id = Model_Account::save($account);
                //dentist record                
                $dentist = array(
                    'account_id'    => $account_id,
                    'business_name' => $s['business_name'],
                    'business_address'=> $s['business_address'],
                    'dental_degree' => $s['dental_degree'],
                    'specialty'     => $s['specialty'],
                    'additional_training' => $s['additional_training'],
                    'school_1'      => $s['school_1'],
                    'school_2'      => $s['school_2'],
                    'school_3'      => $s['school_3'],
                    'associated_to' => $s['associated_to'],
                    'license_number'=> $s['license_number'],
                    'years_of_experience'  => $s['years_of_experience'],
                    'general_information'  => $s['general_information'],
                    'price_range'   => $s['price_range'],
                    'additional_information'=> $s['additional_information']
                );
                $dentist_id = Model_Dentist::save($dentist);
                mkdir('images/dentists/'.$dentist_id); 
                
                if(isset($s['services']))
                Model_DentistHasServices::saveAll($dentist_id,$s['services']);
                
                if(isset($s['dental_specialties']))
                Model_DentistHasDentalSpecialties::saveAll($dentist_id,$s['dental_specialties']);
                
                if(isset($s['dental_procedures']))
                Model_DentistHasDentalProcedures::saveAll($dentist_id,$s['dental_procedures']);
                
                if(isset($s['facilities']))
                Model_DentistHasFacilities::saveAll($dentist_id,$s['facilities']);
                
                if(isset($s['spoken_languages']))
                Model_DentistHasSpokenLanguages::saveAll($dentist_id,$s['spoken_languages']);              
                
                if(isset($s['discount_plans']))
                Model_DentistHasDiscountPlans::saveAll($dentist_id,$s['discount_plans']);
                
                if(isset($s['brands']))
                Model_DentistHasBrands::saveAll($dentist_id,$s['brands']);
                
                if(isset($s['payment_options']))
                Model_DentistHasPaymentOptions::saveAll($dentist_id,$s['payment_options']);
                
                if(isset($s['credit_cards']))
                Model_DentistHasCreditCards::saveAll($dentist_id,$s['credit_cards']);
                
                if(isset($s['additional_services']))
                Model_DentistHasAdditionalServices::saveAll($dentist_id,$s['additional_services']);
                
                if(isset($s['schedule'])){
                    $schedule = Model_Schedule::formatScheduleData($s['schedule']);
                    $schedule_id = Model_Schedule::save($schedule);
                    Model_DentistHasSchedule::save(array('dentist_id'=>$dentist_id, 'schedule_id'=>$schedule_id));
                }             
            }
        }
    }
    
    /**
     * Admin_UsersController::editDentistAction()
     * Used for editing an existing dentist account
     * @return
     */
    public function editDentistAction(){
        if(isset($_REQUEST['change_headshot'])){
            $r = $_REQUEST;
            $dentist = Model_Dentist::getByAccountId($r['id'])->toArray();
            $pending_headshot = Model_Images::getAllPendingImagesByDentist($dentist['id']);
            if(!empty($pending_headshot)){
                $new_headshot = $pending_headshot[0];
                if(!$dentist['headshot_image']) $dentist['enabled_headshot'] = 1;
                $dentist['headshot_image'] = $new_headshot['name'];
                $dentist['headshot_counter'] = $dentist['headshot_counter'] + 1;
                
                Model_Dentist::save($dentist);
                Model_Images::deleteImage($new_headshot['id']);
            }
            $this->_redirect('admin/users/dentists');
        }
        
        $language="EN";
        $this->view->questions = Model_Language::getAllByPrefixAndLanguage("register_question",$language);
        $this->view->section_titles = Model_Language::getAllByPrefixAndLanguage("register_section",$language);
        $this->view->labels = Model_Language::getAllByPrefixAndLanguage("label",$language);
        $this->view->schedule_labels = Model_Language::getAllByPrefixAndLanguage("day",$language);
        
        $this->view->price_ranges = Model_Prices::getAll();
        $this->view->services = Model_Services::getAllServicesByLanguage($language,'0');
        $this->view->dental_specialties = Model_DentalSpecialties::getAllDentalSpecialtiesByLanguage($language,'0');
        $this->view->dental_procedures = Model_DentalProcedures::getAllDentalProceduresByLanguage($language,'0');
        $this->view->facilities = Model_Facilities::getAllFacilitiesByLanguage($language,'0');
        $this->view->spoken_languages = Model_SpokenLanguages::getAllSpokenLanguagesByLanguage($language,'0');
        $this->view->discount_plans = Model_DiscountPlans::getAllDiscountPlansByLanguage($language,'0');
        $this->view->brands = Model_Brands::getAll(NULL,'0');
        $this->view->payment_options = Model_PaymentOptions::getAllPaymentOptionsByLanguage($language,'0');
        $this->view->credit_cards = Model_CreditCards::getAll(null,'0');
        $this->view->additional_services = Model_AdditionalServices::getAllAdditionalServicesByLanguage($language,'0');
        
        $account_id = $this->_getParam('id');
        $this->view->user_account = Model_Account::getById($account_id);
        $this->view->dentist = Model_Dentist::getByAccountId($account_id);
        $dentist_id = $this->view->dentist['id'];
        
        $this->view->dentist_services = Model_DentistHasServices::fetchAllServicesIdsByDentistId($dentist_id);
        $this->view->dentist_dental_specialties = Model_DentistHasDentalSpecialties::fetchAllDentalSpecialtiesIdsByDentistId($dentist_id);
        $this->view->dentist_dental_procedures = Model_DentistHasDentalProcedures::fetchAllDentalProceduresIdsByDentistId($dentist_id);
        $this->view->dentist_facilities = Model_DentistHasFacilities::fetchAllFacilitiesIdsByDentistId($dentist_id);
        $this->view->dentist_spoken_languages = Model_DentistHasSpokenLanguages::fetchAllSpokenLanguagesIdsByDentistId($dentist_id);
        $this->view->dentist_discount_plans = Model_DentistHasDiscountPlans::fetchAllDiscountPlansIdsByDentistId($dentist_id);
        $this->view->dentist_brands = Model_DentistHasBrands::fetchAllBrandsIdsByDentistId($dentist_id);
        $this->view->dentist_payment_options = Model_DentistHasPaymentOptions::fetchAllPaymentOptionsIdsByDentistId($dentist_id);
        $this->view->dentist_credit_cards = Model_DentistHasCreditCards::fetchAllCreditCardsIdsByDentistId($dentist_id);
        $this->view->dentist_additional_services = Model_DentistHasAdditionalServices::fetchAllAdditionalServicesIdsByDentistId($dentist_id);
        
        $this->view->pending_images = Model_Images::getAllPendingImagesByDentist($dentist_id);
        
        $schedule_id = Model_DentistHasSchedule::fetchScheduleIdByDentistId($dentist_id);
        $schedule = Model_Schedule::getById($schedule_id);
        $this->view->dentist_schedule = Model_Schedule::unFormatScheduleData($schedule);
               
        if(isset($_REQUEST['save'])){
        //validate the data from the Register Form
            
            $errors = array();
            $msg = Model_Language::getAllByPrefixAndLanguage("error",$language);
            $validator = new Zend_Validate(); //generic validator
            $r = $_REQUEST; //shortcut for the _REQUEST global
                        
            
            if($r['username']=="") $errors['username']=$msg['error_username_empty'];
            else {
                $u = Model_Account::getByUsername($r['username']);
                if(!empty($u) && $u['id']!=$account_id) $errors['username'] = $msg['error_username_existing'];
            }
            if($r['email']=="") $errors['email']=$msg['error_email_address_empty'];
            else if(!$validator->is($r['email'],"EmailAddress")) $errors['email']=$msg['error_email_address_invalid'];
            else {
                $u = Model_Account::getByEmail($r['email']);
                if(!empty($u) && $u['id']!=$account_id) $errors['email'] = $msg['error_email_address_existing'];
            }
            if($r['password']!=="" && strcmp($r['password'],$r['retype_password'])) $errors['password']=$msg['error_password_mismatch']; 
            if($r['first_name']=="") $errors['first_name']=$msg['error_firstname_empty'];
            if($r['last_name']=="") $errors['last_name']=$msg['error_lastname_empty'];
            if($r['business_name']=="") $errors['business_name']=$msg['error_business_name_empty'];
            if($r['business_address']=="") $errors['business_address']=$msg['error_business_address_empty'];
            if($r['city']=="") $errors['city']=$msg['error_city_empty'];
            if($r['state']=="") $errors['state']=$msg['error_state_empty'];
            if($r['zip_code']=="") $errors['zip_code']="Zip Code should not be empty";
            if($r['country']=="") $errors['country']=$msg['error_country_empty'];
            if($r['phone_number']=="") $errors['phone_number']=$msg['error_telephone_number_empty'];
            if($r['dental_degree']=="") $errors['dental_degree']=$msg['error_dental_degree_empty'];
            if($r['specialty']=="") $errors['specialty']=$msg['error_specialty_empty'];
            if($r['license_number']=="") $errors['license_number']=$msg['error_license_number_empty'];
            if($r['years_of_experience']=="") $errors['years_of_experience']=$msg['error_years_of_experience_empty'];
            if($r['school_1']=="") $errors['school_1']=$msg['error_schoolname_empty'];
            if($r['school_2']=="") $errors['school_2']=$msg['error_schoolname_empty'];
            if(!$r['price_range']) $errors['price_range']=$msg['error_price_range_not_selected'];
            if(!empty($errors)){
                $this->view->errors = $errors;
            }
            else {
                //save the updated dentist account
                $s = $r;
                $account = array(
                    'id'            => $account_id,
                    'username'      => $s['username'],
                    'first_name'    => $s['first_name'],
                    'last_name'     => $s['last_name'],
                    'city'          => $s['city'], 
                    'state'         => $s['state'],
                    'country'       => $s['country'],
                    'zip_code'      => $s['zip_code'],
                    'phone_number'  => $s['phone_number'],
                    'email'         => $s['email']
                );
                if($s['password']!=="") $account['password'] = $s['password'];
                Model_Account::save($account);
                //dentist record                
                $dentist = array(
                    'id'            => $dentist_id,
                    'business_name' => $s['business_name'],
                    'business_address'=> $s['business_address'],
                    'dental_degree' => $s['dental_degree'],
                    'specialty'     => $s['specialty'],
                    'additional_training' => $s['additional_training'],
                    'school_1'      => $s['school_1'],
                    'school_2'      => $s['school_2'],
                    'school_3'      => $s['school_3'],
                    'associated_to' => $s['associated_to'],
                    'license_number'=> $s['license_number'],
                    'years_of_experience'  => $s['years_of_experience'],
                    'general_information'  => $s['general_information'],
                    'price_range'   => $s['price_range'],
                    'additional_information'=> $s['additional_information']
                );
                Model_Dentist::save($dentist);
                
                if(isset($s['services']))
                Model_DentistHasServices::saveAll($dentist_id,$s['services']);
                
                if(isset($s['dental_specialties']))
                Model_DentistHasDentalSpecialties::saveAll($dentist_id,$s['dental_specialties']);
                
                if(isset($s['dental_procedures']))
                Model_DentistHasDentalProcedures::saveAll($dentist_id,$s['dental_procedures']);
                
                if(isset($s['facilities']))
                Model_DentistHasFacilities::saveAll($dentist_id,$s['facilities']);
                
                if(isset($s['spoken_languages']))
                Model_DentistHasSpokenLanguages::saveAll($dentist_id,$s['spoken_languages']);              
                
                if(isset($s['discount_plans']))
                Model_DentistHasDiscountPlans::saveAll($dentist_id,$s['discount_plans']);
                
                if(isset($s['brands']))
                Model_DentistHasBrands::saveAll($dentist_id,$s['brands']);
                
                if(isset($s['payment_options']))
                Model_DentistHasPaymentOptions::saveAll($dentist_id,$s['payment_options']);
                
                if(isset($s['credit_cards']))
                Model_DentistHasCreditCards::saveAll($dentist_id,$s['credit_cards']);
                
                if(isset($s['additional_services']))
                Model_DentistHasAdditionalServices::saveAll($dentist_id,$s['additional_services']);
                
                if(isset($s['schedule'])){
                    $schedule = Model_Schedule::formatScheduleData($s['schedule']);
                    $schedule['id'] = $schedule_id;
                    $schedule_id = Model_Schedule::save($schedule);
                }    
                
                $link = $this->linkAppend($this->_session->dentist_display);
                $this->_redirect('admin/users/dentists'.$link);         
            }
        }
    }
    
}