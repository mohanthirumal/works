<?php
class SuccessController extends FrontController
{
	protected $title = 'Success Payment';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if($transId = Tools::getValue('id'))
		{
			$deposit = new Deposit($transId);
			$product = new Product($deposit->product_id);
			self::$smarty->assign('payment_id', $deposit->payment_id);
			self::$smarty->assign('product', $product);
		}
	}
	
	public function process()
	{
		parent::process();
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/refer-a-friend.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('success-payment.tpl');
	}
}
