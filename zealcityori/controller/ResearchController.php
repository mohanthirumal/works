<?php
class ResearchController extends FrontController
{
	protected $title = 'Research';
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
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/research.css', 'all');
	}
	
	public function process()
	{
		self::$smarty->assign('PREVIOUSMATCH', Module::execHook('blocklivescore','previousMatch'));
		self::$smarty->assign('RESEARCHMATCH', Module::execHook('blocklivescore','singleMatch'));
		//self::$smarty->assign('PITCHREPORT', Module::execHook('wordpress','pitchReport'));
		//self::$smarty->assign('WEATHERREPORT', Module::execHook('wordpress','weatherReport'));
		//self::$smarty->assign('PANDITSAYS', Module::execHook('wordpress','panditSays'));
		//self::$smarty->assign('PROSCORNER', Module::execHook('wordpress','prosCorner'));
		//self::$smarty->assign('INJURYCAUSES', Module::execHook('wordpress','injuryCauses'));
		self::$smarty->assign('STARPLAYERS', Module::execHook('wordpress','starPlayers'));
		self::$smarty->assign('NEWS', Module::execHook('wordpress','getNews'));
		self::$smarty->assign('BLOGS', Module::execHook('wordpress','getBlogs'));
		self::$smarty->assign('POINTSTABLE', Module::execHook('blocklivescore','getPointsTable'));
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('research.tpl');
	}
}
