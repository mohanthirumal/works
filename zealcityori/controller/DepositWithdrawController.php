<?php
class DepositWithdrawController extends FrontController
{
	protected $title = 'Deposit and withdraw';
	public $auth = false;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('deposit-and-withdraw.tpl');
	}
}
