<?php
class HomeController extends FrontController
{
	protected $title = 'dummyhome';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/slider.css?1', 'all');
	}
	
	public function process()
	{
		global $cookie;
		parent::process();
		$tournament = new Tournament();
		$ptournament = new PTournament();
		$matches = new Matches();
		$nextMatch = $matches->getUpcomingMatches(1);
		self::$smarty->assign('tourimageurl', FLAG_URL);
		self::$smarty->assign('nextMatch', $nextMatch[0]['match_date']);
		$now = date('Y-m-d H:i:s');
		self::$smarty->assign('now', $now);
		
		if($cookie->logged)
		{
			self::$smarty->assign('cookie', $cookie);
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('home.tpl');
	}
}
