<?php
class FrontController
{
	public $errors = array();
	protected static $smarty;
	protected static $cookie;
	public $auth = false;
	public function __construct()
	{		
	}

	public function run()
	{
		$this->init();
		$this->preProcess();
		$this->displayHeader();
		$this->process();
		$this->displayContent();
		$this->displayFooter();
	}
	
	public function setMedia()
	{
		Tools::addCSS(__BASE_URI__.'css/reset.css', 'all');
		Tools::addCSS(__BASE_URI__.'css/styles.css?2', 'all');
		Tools::addJS(array(__BASE_URI__.'js/jquery.js',__BASE_URI__.'js/script.js?2',__BASE_URI__.'js/jquery.countdown.js',__BASE_URI__.'js/scrite.js'));
		Tools::addCSS('css/research-details.css', 'all');
	}
	
	public function init()
	{		
		global $smarty, $cookie, $css_files, $js_files;
		$smarty = new Smarty();
		$smarty->compile_check = true;
		self::$smarty = $smarty;
		//$cookieLifetime = (time() + 60*60*24*30);
		$cookieLifetime = 0;
		$cookie = new Cookie('zeal', '', $cookieLifetime);
		self::$cookie = $cookie;
		if (Tools::isSubmit('fblogin'))
			$this->facebookLogin();
		if(isset($_REQUEST['request_ids']))
			$cookie->referral_id = Tools::getValue('request_ids');
		if (isset($_GET['mylogout']))
		{
			$cookie->mylogout();
			Tools::redirect(__BASE_URI__);
		}
		include 'LoginSignupChecker.php';
		self::$smarty->assign(array(
			'base_dir' => __BASE_URI__,
			'module_dir' => _MODULE_DIR_,
			'fb_app_id' => FB_APP_ID
		));
		if ($this->auth AND !$cookie->isLogged())
			Tools::redirect(__BASE_URI__.'404.php');
		$this->setMedia();
	}
	
	public function preProcess()
	{
		self::$smarty->assign(array(
			'pagetitle' => $this->title
		));
	}
	
	public function process()
	{
		
	}
	
	public function displayContent()
	{
		
	}
	
	public function displayHeader()
	{
		global $smarty, $cookie, $css_files, $js_files;		
		$smarty->assign('LIVESCOREHEADER', Module::execHook('blocklivescore','headerHook'));
		if($cookie->isLogged())
		{
			$user = new user($cookie->user_id);
			$level = $user->getLevel();
			self::$smarty->assign(array(
				'user' => $user,
				'level' => $level,
				'logged' => $cookie->logged
			));
		}
		if (count($this->errors) > 0)
			self::$smarty->assign('errors', $this->errors);
		self::$smarty->assign('css_files', $css_files);
		self::$smarty->assign('js_files', array_unique($js_files));
		Tools::getCustomMessage();
		self::$smarty->display('header.tpl');
		
	}
	
	public function displayFooter()
	{
		global $cookie;
		self::$smarty->display('footer.tpl');
	}
	
	private function facebookLogin()
	{
		$user_profile = $this->facebookConnect();
		$user = new User();
		if($user->getUserFromConnect($user_profile['user']['id'], 'facebook'))
		{
			self::$cookie->user_id = (int)($user->id);
			self::$cookie->logged = 1;
			self::$cookie->password = $user->password;
			self::$cookie->email = $user->email;
			Tools::redirect('index.php');
		}
	}
	
	public function facebookConnect()
	{
		require 'tools/facebook/src/facebook.php';
		$facebook = new Facebook(array(
		  'appId'  => FB_APP_ID,
		  'secret' => FB_APP_SECRET,
		  'cookie' => true,
		  'oauth' => true
		));
		$user = $facebook->getUser();
		$me = array();
		if (true) {
		  try {
			$me['user'] = $facebook->api('/me');
			$me['friends'] = $facebook->api('/me/friends');
		  } catch (FacebookApiException $e) {
				$this->errors[] = $e;
				
				return false;
		  }
		}
		return $me;
	}
}