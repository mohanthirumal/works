<?php
require('include/config.php');
if(isset($_GET['action']) && $_GET['action'] == 'pitchreport')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$sql = 'SELECT p.post_content AS content FROM zeal_terms t
			INNER JOIN zeal_term_taxonomy tt ON tt.term_taxonomy_id = t.term_id
			INNER JOIN zeal_term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN zeal_posts p ON p.ID = tr.object_id
			INNER JOIN zeal_postmeta pm ON pm.post_id = p.ID
			WHERE pm.meta_key = \'matchid\' AND pm.meta_value = \''.$id.'\' AND post_type=\'post\'
			AND post_status = \'publish\' AND t.term_id = '.PITCH_REPORT.';';
	$result = mysql_fetch_array(mysql_query($sql, $con));
	echo $result['content'];
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'upcomingmatches')
{
	$id = $_REQUEST['id'];
	$match = new Matches($id);	
	echo '
		<div class="team1">
			<img src="'.FLAG_URL.'teamsflags/'.$match->team1Details->flag_url.'" class="team1_img">
			<div class="team_name">'.$match->team1Details->teamname.'</div>
		</div>            
		<div class="versus_img"></div>
		<div class="team1">
			<img src="'.FLAG_URL.'teamsflags/'.$match->team2Details->flag_url.'" class="team1_img">
			<div class="team_name">'.$match->team2Details->teamname.'</div>
		</div>   
		<div class="match_detail">
			<table id="match_detail_table" border="0" cellpadding="0">
				<tbody>
					<tr>
						<td align="right" style="color:#686868;">Match :</td>
						<td style="text-indent:3px; font-weight:bold;">'.$match->tour->tournament_name.', '.$match->match_name.'</td>
					</tr>
					<tr>
						<td align="right" style="color:#686868;">Venue :</td>
						<td style="text-indent:3px; font-weight:bold;">'.$match->venue->venue.','.$match->venue->city.'</td>
					</tr>
					<tr>
						<td align="right" style="color:#686868;">Type :</td>
						<td style="text-indent:3px; font-weight:bold;">'.$match->type.'</td>
					</tr>
					<tr>
						<td align="right" style="color:#686868;">Date :</td>
						<td style="text-indent:3px; font-weight:bold;">'.date('d-m-Y', $match->match_date).'</td>
					</tr>
				</tbody>
			</table>
		</div>
	';
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'weatherreport')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$sql = 'SELECT p.post_content AS content FROM zeal_terms t
			INNER JOIN zeal_term_taxonomy tt ON tt.term_taxonomy_id = t.term_id
			INNER JOIN zeal_term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN zeal_posts p ON p.ID = tr.object_id
			INNER JOIN zeal_postmeta pm ON pm.post_id = p.ID
			WHERE pm.meta_key = \'matchid\' AND pm.meta_value = \''.$id.'\' AND post_type=\'post\'
			AND post_status = \'publish\' AND t.term_id = '.WEATHER_REPORT.';';
	$result = mysql_fetch_array(mysql_query($sql, $con));
	echo $result['content'];
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'teams')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$match = new Matches($id);
	echo '
	<div class="team1">
		<img src="http://10.199.50.88/cricville2/scoreadmin/images/teamsflags/teamflag51593501.png" class="team1_img">
		<div class="team_name">South Africa</div>
		<div class="teams-team1-stats">
			Matches Played :<br/>
			Wins : <br/>
			Loses : <br/>
		</div>
	</div>
	<div class="versus_img"></div>
	<div class="team1">
		<img src="http://10.199.50.88/cricville2/scoreadmin/images/teamsflags/teamflag61865615.jpg" class="team1_img">
		<div class="team_name">Newzealand</div>
		<div class="teams-team1-stats">
			Matches Played :<br/>
			Wins : <br/>
			Loses : <br/>
		</div>
	</div>
	';
}
else if(isset($_GET['action']) && $_GET['action'] == 'players')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$match = new Matches($id);
	$players1 = $match->team1Details->getSquardPlayers($match->type);
	echo '<div class="research-players-team1">';
	echo '
	<div class="research-players-flag">
		<img src="'.FLAG_URL.'teamsflags/'.$match->team1Details->flag_url.'" alt=""/>
	</div>';
	foreach($players1 as $player)
	{
		echo '
		<div class="research-players-indiv">
			<img src="'.FLAG_URL.'players/'.$player['photo_url'].'" alt=""/><a href="javascript:void(0);" vasplus_programming_blog_user_details="'.$player['id'].',MS Dhoni" class="vpb_link_attribute">'.$player['player_name'].'</a>
		</div>
		';
	}
	echo '</div>';
	$players2 = $match->team2Details->getSquardPlayers($match->type);
	echo '<div class="research-players-team1">';
	echo '
	<div class="research-players-flag">
		<img src="'.FLAG_URL.'teamsflags/'.$match->team2Details->flag_url.'" alt=""/>
	</div>';
	foreach($players2 as $player)
	{
		echo '
		<div class="research-players-indiv">
			<img src="'.FLAG_URL.'players/'.$player['photo_url'].'" alt=""/><a href="javascript:void(0);" vasplus_programming_blog_user_details="'.$player['id'].',MS Dhoni" class="vpb_link_attribute">'.$player['player_name'].'</a>
		</div>
		';
	}
	echo '</div>';
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'complgames')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$match = new Matches();
	$previous = $matches->getPreviousMatches(1, $id);
	echo '
	<div class="prev_match1">
		<div class="prev_match_team1"><img src="'.FLAG_URL.$previous.t1flag.'" alt="'.$previous.t1name.'" /></div>		
		<div class="score_detail">
			<div class="prev_score">'.$previous.t1score.'/'.$previous.t1wickets.'</div>
			<div class="prev_over">'.$previous.t1overs.' ov</div>
		</div>
		<div class="prev_versus">Vs</div>
		<div class="prev_match_team2"><img src="'.FLAG_URL.$previous.t2flag.'" alt="'.$previous.t2name.'" /></div>
		<div class="score_detail">
			<div class="prev_score">'.$previous.t2score.'/'.$previous.t2wickets.'</div>
			<div class="prev_over">'.($previous.t2overs/6).'.'.($previous.t2overs%6).' ov</div>
		</div>
	</div>
	';
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'starplayers')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$sql = 'SELECT p.post_content AS content FROM zeal_terms t
			INNER JOIN zeal_term_taxonomy tt ON tt.term_taxonomy_id = t.term_id
			INNER JOIN zeal_term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN zeal_posts p ON p.ID = tr.object_id
			INNER JOIN zeal_postmeta pm ON pm.post_id = p.ID
			WHERE pm.meta_key = \'matchid\' AND pm.meta_value = \''.$id.'\' AND post_type=\'post\'
			AND post_status = \'publish\' AND t.term_id = '.STAR_PLAYERS.';';
	$result = mysql_fetch_array(mysql_query($sql, $con));
	echo $result['content'];
	exit;
}
else if(isset($_GET['action']) && $_GET['action'] == 'prediction')
{
	$con = wordpressConnect();
	$id = $_REQUEST['id'];
	$sql = 'SELECT p.post_content AS content FROM zeal_terms t
			INNER JOIN zeal_term_taxonomy tt ON tt.term_taxonomy_id = t.term_id
			INNER JOIN zeal_term_relationships tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN zeal_posts p ON p.ID = tr.object_id
			INNER JOIN zeal_postmeta pm ON pm.post_id = p.ID
			WHERE pm.meta_key = \'matchid\' AND pm.meta_value = \''.$id.'\' AND post_type=\'post\'
			AND post_status = \'publish\' AND t.term_id = '.PREDICTION.';';
	$result = mysql_fetch_array(mysql_query($sql, $con));
	echo $result['content'];
	exit;
}
function wordpressConnect()
{
	$con = mysql_connect(_WP_DB_SERVER_, _WP_DB_USER_, _WP_DB_PASSWD_, true);
	mysql_select_db(_WP_DB_NAME_, $con);
	return $con;
}