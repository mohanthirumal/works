<?php
class ResearchDetailsController extends FrontController
{
	protected $title = 'Research Details';
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
		$matches = new Matches();
		$upcomingMatches = $matches->getUpcomingMatches();
		$recentMatches = $matches->getRecentMatches();
		$getPreviousMatches = $matches->getPreviousMatches();
		$tour = new Tour();
		$points = $tour->getPointsTable();
		self::$smarty->assign('points', $points);
		self::$smarty->assign('upcomingMatches', $upcomingMatches);
		self::$smarty->assign('recentMatches', $recentMatches);
		self::$smarty->assign('getPreviousMatches', $getPreviousMatches);
	}
	
	public function getPitchReport()
	{
		
		$resultResource = mysql_query($sql, $con);
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/research.css', 'all');
		Tools::addCSS('css/player_stats.css', 'all');
		Tools::addCSS('css/research-details.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/player_stats.js'));
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('research-details.tpl');
	}
	
	public function wordpressConnect()
	{
		$con = mysql_connect(_WP_DB_SERVER_, _WP_DB_USER_, _WP_DB_PASSWD_, true);
		mysql_select_db(_WP_DB_NAME_, $con);
		return $con;
	}
}
