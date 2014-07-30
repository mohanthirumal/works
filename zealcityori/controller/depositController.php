<?php
class depositController extends FrontController
{
	protected $title = 'Deposit';
	public $auth = false;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function displayHeader()
	{
		if(!Tools::isSubmit('paypalSubmit'))
			parent::displayHeader();
	}
	
	public function displayFooter()
	{
		if(!Tools::isSubmit('paypalSubmit'))
			parent::displayFooter();
	}
	
	public function preProcess()
	{
		global $cookie;
		if(!$cookie->isLogged())
			Tools::redirect('index.php');
		if(!Tools::isSubmit('paypalSubmit'))
			parent::preProcess();
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/refer-a-friend.css', 'all');
		Tools::addCSS('css/deposit.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/deposit.js'));
	}
	
	public function process()
	{
		global $cookie;
		if(Tools::isSubmit('paypalSubmit'))
		{
			include('tools/Crypt/AES.php');
			$key = "1pJ+4oEkInt47zR7aAu5og==";
			$productId = Tools::getValue('productid');
			
			
			$product = new Product($productId);
			$user = new User($cookie->user_id);
			$user->country = Tools::getValue('country');
			$user->state = Tools::getValue('state');
			$user->city = Tools::getValue('city');
			$user->address = Tools::getValue('address');
			$address2 = Tools::getValue('address2');
			$user->pincode = Tools::getValue('pincode');
			$mobile = Tools::getValue('mobileno');
			$user->firstname = Tools::getValue('fullname');
			
			$user->update();
			
			if($product->id == 7)
				$amount = (int)Tools::getValue('amount');
			else
				$amount = $product->cash;
			$deposit = new Deposit();
			$deposit->user_id = $user->id;
			$deposit->product_id = $product->id;
			$deposit->amount = $amount;
			$deposit->payment_id = 0;
			$deposit->status = 'pending';
			$deposit->add();
			$merchantId = '201404011000002';
			$aes = new Crypt_AES();
			$secret = base64_decode($key);
			$aes->setKey($secret);
			$user = new User($cookie->user_id);
			
			$plaintext = $merchantId.'|DOM|IND|INR|'.$amount.'|zc00000'.$deposit->id.'|'.$product->id.'|http://www.zealcity.com/return-direcpay.php|http://www.zealcity.com/return-direcpay.php|DirecPay';
			$billingDtls = $user->firstname.'|'.$user->address.$address2.'|'.$user->city.'|'.$user->state.'|'.$user->pincode.'|IN||||'.$mobile.'|'.$user->email.'|Zealcity direcpay payment';
			$shippingDtls = $user->firstname.'|'.$user->address.$address2.'|'.$user->city.'|'.$user->state.'|'.$user->pincode.'|IN||||'.$mobile;
			$billingDtls  = base64_encode($aes->encrypt($billingDtls));
			$shippingDtls  = base64_encode($aes->encrypt($shippingDtls));
			$requestParameter = base64_encode($aes->encrypt($plaintext));
			self::$smarty->assign('paymentprocess', 1);
			self::$smarty->assign('merchantId', $merchantId);
			self::$smarty->assign('requestparameter', $requestParameter);
			self::$smarty->assign('billingDtls', $billingDtls);
			self::$smarty->assign('shippingDtls', $shippingDtls);
		}
		else
		{
		
			global $cookie;
			$user = new user($cookie->user_id);
			$product = new Product();
			$products = $product->getProducts();
			self::$smarty->assign('products', $products);
			self::$smarty->assign('user', $user);
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('deposit.tpl');
	}
}
