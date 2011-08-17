<?php

/**
 * Admin_PaymentController
 * 
 */
class Admin_PaymentController extends Zend_Controller_Action
{
    protected $_session;

    /**
     * Admin_PaymentController::init()
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
     * Admin_PaymentController::indexAction()
     * 
     * @return
     */
    public function indexAction(){
		
    }
    
    /**
     * Admin_PaymentController::managerAction()
     * @return
     */
    public function managerAction(){
        //Display Payment Records
		$this->view->page = $page = (isset($_REQUEST['page'])?$_REQUEST['page']:1);
		$payments = Model_Payments::getAll($page);
		$ids = A25_Format::fetchIds($payments['rows'], 'dentist_id',true);
		$dentists = A25_Format::fieldToId(Model_Dentist::getAll($ids),'id',true);
		$this->view->count = $payments['count'];
		$this->view->payments = $payments['rows'];
		$this->view->dentists = $dentists;
		//Display PayPal Options
		$bootstrap = $this->getInvokeArg('bootstrap');
        $config = $bootstrap->getOption('payments');
		$this->view->paypal = (!empty($_POST)?$_POST['paypal']:$config['paypal']);
		//Edit PayPal Options
		if (isset($_POST['paypal'])){
			$paypal = $_POST['paypal'];
			ob_start();
			include_once(APPLICATION_PATH.'/configs/application.php');
			$contents = ob_get_contents();
			ob_end_clean();
			$h = fopen(APPLICATION_PATH.'/configs/application.ini','w');
			fwrite($h, $contents);
			fclose($h);
			$this->view->msg='Payment details updated successfully';
		}
    }
    
    
    //Process Payment
    
    /**
     * Admin_PaymentController::processPayment()
     * 
     * @param mixed $amount
     * @param mixed $r
     * @return
     */
    protected function processPayment($amount,$r){
    	$bootstrap = $this->getInvokeArg('bootstrap');
        $config = $bootstrap->getOption('payments');
    	
    	$startDate=Zend_Date::now()->addMinute(1)->toString("yyyy-MM-dd HH:mm:ss");
        $period="Month";
    	
    	$paypal = A25_Payments_PayPal::getInstance($config['paypal']);
    	$payment = $paypal->doDirectPayment(array(
    		"AMT"=>$amount,
    		"DESC"=> 'Dentist Membership Payment',
    		"CURRENCYCODE"=>"USD",
    		"BILLINGPERIOD"=>$period,
    		"PROFILESTARTDATE"=>$startDate,
    		"BILLINGFREQUENCY"=>$r['frequency'],
    		"CREDITCARDTYPE"=>$r['credit_card_type'],
    		"ACCT"=>$r['credit_card_number'],
    		"CVV2"=>$r['security_code'],
    		"EXPDATE"=>$r['expiration_month'].$r['expiration_year'],
    		"FIRSTNAME"=>$r['first_name'],
    		"LASTNAME"=>$r['last_name'],
    		"SUBSCRIBERNAME"=>$r['first_name'].' '.$r['last_name'],
    		"STREET" => $r['address'],
    		"STREET2" => $r['address2'],
    		"CITY" => $r['city'],
    		"STATE" => $r['state'],
    		"COUNTRYCODE" => $r['country_code'],
    		"ZIP" => $r['zip_code']
    	));
    	
    	return $payment;
    }
    
}