<?php
class HowItWorksController extends FrontController
{
	protected $title = 'How it works - How to play fantasy cricket, rules for fantasy cricket ';
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
		Tools::addCSS('css/howitworks.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('howitworks.tpl');
	}
}
