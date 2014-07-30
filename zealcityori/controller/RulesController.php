<?php
class RulesController extends FrontController
{
	protected $title = 'Rules';
	protected $tournament;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
	}
	
	public function process()
	{
		global $cookie;
		$user = new User($cookie->user_id);		
		/*$leaderboard = $user->getLeaderboard();		
			self::$smarty->assign('leaderboards', $leaderboard);
		if($cookie->isLogged())
		{
			$myrank = $user->getMyRank();
			self::$smarty->assign('myrank', $myrank);
		}*/		
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/rules.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('rules.tpl');
	}
}
