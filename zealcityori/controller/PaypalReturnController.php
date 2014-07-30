<?php
class PaypalReturnController extends FrontController
{
	protected $title = 'Error Payment';
	public $status = '';
	
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if(isset($_REQUEST['responseparams']))
		{
			$response = $_REQUEST['responseparams'];
			$responseParams = explode('|', $response);
			$status = $responseParams[1];
			$paymentId = $responseParams[0];
			$country = $responseParams[2];
			$code = $responseParams[3];
			$productId = $responseParams[4];
			$orderId = str_replace('zc00000', '', $responseParams[5]);
			$amount = $responseParams[6];

			$product = new Product($productId);
			$user = new User($cookie->user_id);
			$user->updateDeposit($orderId, $paymentId, $status);
			if($status == 'SUCCESS' && ($amount == $product->cash || $product->id == 7))
			{
				$user->addCash($amount);
				$mail = new Mail();
				$mail->depositMail((int)($user->id), 'deposit', $amount);
				Tools::redirect(__BASE_URI__.'success?id='.$orderId);
			}
			else if($status == 'TRANSACTION BOOKED')
			{
				$this->status = 'booked';
			}
		}
		
	}
	
	public function process()
	{
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/refer-a-friend.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		if($this->status == 'booked')
			self::$smarty->display('pending-payment.tpl');
		else
			self::$smarty->display('error-payment.tpl');
	}
}
