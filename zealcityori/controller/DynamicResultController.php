<?php
class DynamicResultController extends FrontController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $smarty, $cookie;	
		if ($tour_id = (int)Tools::getValue('id'))
		{
			$type = (int)Tools::getValue('type');
			$mid = (int)Tools::getValue('mid');
			$user = new User($cookie->user_id);
			if($type == 1 || $type == 3)
			{
				$tournament = new Tournament($tour_id);
				$match = new Matches($tournament->match_id);
			}
			else
			{
				$tournament = new PTournament($tour_id);
				$match = new Matches($mid);
			}
			
			$file = 'json/tour-'.$match->id.'-'.$tournament->id.'-'.$tournament->tournament_type_id.'.json';
			if(file_exists($file))
			{
				$json = file_get_contents($file);
				$playerR = json_decode($json, true);
				usort($playerR, array('DynamicResultController','compareOrder'));
				self::$smarty->assign('playerresult', $playerR);
				self::$smarty->assign('tournament', $tournament);
				self::$smarty->assign('user', $user);
				self::$smarty->assign('match', $match);
			}
			else
				die();
		}
	}
	
	private function compareOrder($a, $b)
	{
	  return $b['run'] - $a['run'];
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('dynamicresult.tpl');
	}
}
