<?php
class leaderboardController extends FrontController
{
	protected $title = 'Leaderboard';
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
		$weeklyStartDate = date('Y-m-d', strtotime('monday this week'));
		$weeklyEndDate = date('Y-m-d', strtotime('sunday this week'));
		$monthlyStartDate = date('Y-m-d', strtotime('first day of this month'));
		$monthlyEndDate = date('Y-m-d', strtotime('last day of this month'));
		$weeklyLeaderboard = $user->getLeaderboard($weeklyStartDate, $weeklyEndDate);
		$monthlyLeaderboard = $user->getLeaderboard($monthlyStartDate, $monthlyEndDate);
		//$championLeaderboard = $user->getTourLeaderboard(5);
		if(!empty($user->id))
		{
			$championRank = $user->getTourRank(5, $user->id);
			$weeklyRank = $user->getRank($user->id, $weeklyStartDate, $weeklyEndDate);
			$monthlyRank = $user->getRank($user->id, $monthlyStartDate, $monthlyEndDate);
			//self::$smarty->assign('championRank', $championRank);
			self::$smarty->assign('weeklyRank', $weeklyRank);
			self::$smarty->assign('monthlyRank', $monthlyRank);
		}		
		self::$smarty->assign('weeklyLeaderboard', $weeklyLeaderboard);
		self::$smarty->assign('monthlyLeaderboard', $monthlyLeaderboard);
		self::$smarty->assign('weeklyStartDate', $weeklyStartDate);
		self::$smarty->assign('weeklyEndDate', $weeklyEndDate);
		self::$smarty->assign('monthlyStartDate', $monthlyStartDate);
		self::$smarty->assign('monthlyEndDate', $monthlyEndDate);
		//self::$smarty->assign('championLeaderboard', $championLeaderboard);
		if($cookie->isLogged())
		{
			$myrank = $user->getMyRank();
			self::$smarty->assign('myrank', $myrank);
		}		
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/leaderboard.css', 'all');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('leaderboard.tpl');
	}
}
