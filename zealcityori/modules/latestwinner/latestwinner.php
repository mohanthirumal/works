<?php
class latestwinner extends Module
{
	public function indexHook()
	{	
		global $smarty;	
		$tournament = new Tournament();
		$user = new User();
		$winners = $tournament->getLatestWinners();
		$leaderboard = $user->getLeaderboard();
		$smarty->assign('winners', $winners);
		$smarty->assign('leaderboards', $leaderboard);
		return $this->display(__FILE__, 'latestwinner.tpl');
	}
}