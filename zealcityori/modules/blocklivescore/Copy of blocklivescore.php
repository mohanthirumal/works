<?php
class blocklivescore extends Module
{
	public function headerHook()
	{	
		$this->getLiveScore();
		return $this->display(__FILE__, 'livescore-header.tpl');
	}
	
	public function sidebarHook()
	{
		$this->getLiveScore(4);
		$this->getCurrentTourWinner();
		return $this->display(__FILE__, 'livescore-sidebar.tpl');
	}
	
	public function getLiveScore($matchCount = NULL)
	{
		global $smarty;	
		$matches = new Matches();
		$upcomingMatches = $matches->getUpcomingMatches($matchCount);
		$liveMatches = $matches->getLiveMatch();
		$matchResults = $matches->getMatchResults(4);
		$liveScore = array();
		$resultMatches = array();
		$count = 1;
		foreach($liveMatches as $liveMatch)
		{
			$liveScore[] = new LiveScore($liveMatch['id']);
		}
		foreach($matchResults as $matchResult)
		{
			$resultMatches[] = new LiveScore($matchResult['id']);
		}
		$date['time'] = '%H:%M';
		$smarty->assign('imageurl', FLAG_URL.'teamsflags/');
		$smarty->assign('date', $date);
		$smarty->assign('liveScores', $liveScore);
		$smarty->assign('resultMatches', $resultMatches);
		$smarty->assign('base_dir', __BASE_URI__);
		$smarty->assign('upcomingMatches', $upcomingMatches);
	}
	
	public function previousMatch()
	{
		global $smarty;
		$matches = new Matches();
		$previous = $matches->getPreviousMatches(2);
		if(count($previous) >= 2)
			$smarty->assign('previous', $previous);
		return $this->display(__FILE__, 'previous-match.tpl');
	}
	
	public function singleMatch()
	{
		global $smarty;
		$matches = new Matches();
		$match = $matches->getRecentMatches();
		$matches = new Matches($match[0]['id']);
		if(count($match) > 0)
			$smarty->assign('researchmatch', $matches);
		return $this->display(__FILE__, 'research-match.tpl');
	}
	
	public function getPointsTable()
	{
		global $smarty;
		$tour = new Tour();
		$points = $tour->getPointsTable();
		$smarty->assign('points', $points);
		return $this->display(__FILE__, 'points-table.tpl');
	}
	
	public function getCurrentTourWinner()
	{
		global $smarty;
		$tournaments = new Tournament();
		$tours = $tournaments->getLiveTournament();
		$winner = array();
		$count = 0;
		foreach($tours as $tour)
		{
			$file = 'xml/'.$tour['id'].'.xml';
			
			if(file_exists($file))
			{
				$playerresult = array();
				$xml = simplexml_load_file($file);
				$playerresult = json_decode(json_encode((array)simplexml_load_file($file)),1);
				$playerR = $playerresult['user'];
				usort($playerR, array('blocklivescore','compareOrder'));
				$winner[$count]['teamname'] = $playerR[0]['teamname'];
				$winner[$count]['username'] = $playerR[0]['username'];
				$winner[$count]['run'] = $playerR[0]['run'];
				$count++;
			}
		}
		$smarty->assign('homewinners', $winner);
	}
	
	private function compareOrder($a, $b)
	{
	  return $b['run'] - $a['run'];
	}
}