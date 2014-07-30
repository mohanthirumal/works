<?php
class QuickDepositController extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		//$xml = simplexml_load_file("http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=USD&ToCurrency=INR");
		//$dollar = $xml[0];
		$product = new Product();
		$products = $product->getProducts();
		//self::$smarty->assign('dollar', (double)$dollar);
		self::$smarty->assign('products', $products);
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('quick-deposit.tpl');
	}
}
