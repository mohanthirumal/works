{if !isset($tour_id)}
<h1 style="color:#fff;">Not Allowed</h1>
{else}
<!-------------------------------- My Tournament -------------------------------->
<div class="my-tournament-container">
	<div class="left-container" style="margin-top:1px;">
		<div class="live-score-menu">
			<ul>
				<li class="active">Teams</li>
			</ul>
		</div>
		<div class="mytournament-filter">
			<input type="checkbox" name="filter" class="checkbox" id="filterteam1" onclick="zeal.players.filter(this, 'team1')"/><label for="filterteam1" class="checkname">{$team1->teamname}</label>
			<input type="checkbox" name="filter" class="checkbox" id="filterteam2" onclick="zeal.players.filter(this, 'team2')"/><label for="filterteam2" class="checkname">{$team2->teamname}</label>
		</div>
        <div class="mytournament-playermenu">
        	<div class="playermame">Player Name</div>
            <div class="role">Role</div>
            <div class="team">Team</div>
            <div class="runs">Runs</div>
            <div class="salary">Salary</div>
            <div class="addbut">Add</div>
        </div>
		<div class="mytournament-players">
			<ul id="team1">
				{foreach from=$team1players item=player name=team1players}
				{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
				{else}
				<li class="player-indi team1" rel="team1" id="player{$player.id}">
					<div style="width:150px;" class="playername"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:18:'...'}</div>
					<div>{$player.player_type}</div>
					<div class="small"><img src="{$tourimageurl}teamsflags/{$team1->flag_url}" alt=""/></div>
					<div class="small run">0</div>
					<div class="small">{$player.coc_salary}</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add({$player.id});" class="addfunds"/></div>
					<input type="hidden" name="players[]" value="{$player.id}"/>
					<input type="hidden" name="playerssalary" id="salary{$player.id}" value="{$player.coc_salary}"/>
				</li>
				{/if}
				{/foreach}
			</ul>
			<ul id="team2">
				{foreach from=$team2players item=player name=team1players}
				{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
				{else}
				<li class="player-indi team2" rel="team2" id="player{$player.id}">
					<div style="width:150px;" class="playername"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:15:'...'}</div>
					<div>{$player.player_type}</div>
					<div class="small"><img src="{$tourimageurl}teamsflags/{$team2->flag_url}" alt=""/></div>
					<div class="small run">0</div>
					<div class="small">{$player.coc_salary}</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add({$player.id});" class="addfunds"/></div>
					<input type="hidden" name="players[]" value="{$player.id}"/>
					<input type="hidden" name="playerssalary" id="salary{$player.id}" value="{$player.coc_salary}"/>
				</li>
				{/if}
				{/foreach}
			</ul>
		</div>
		{if !isset($myTeamPlayersId)}
        <div class="left-hidden-container"></div>
		{/if}
	</div>
	<div class="right-container" style="margin-top:1px;">
    	<div class="remaining">
        	<div class="remaining-menu">
            	<div class="amount-bg"><div class="amount budjet-text" id="budjet-text">{$tournament->salary_cap}</div></div>
				<input type="hidden" id="budjet" value="{$tournament->salary_cap}"/>
                <div class="remain-title">REMAINING</div>
				<div class="next-starts-in-counter" id="next-starts-in"></div>
            </div>	
          
        </div>    	
		<form method="post" onsubmit="return zeal.mytournament.validatemytourn();">
			<div class="step1">
				<div class="live-score-menu">
					<div class="step1title">STEP -1</div>
					<div class="changes-value-bg"><div class="changes-values">{if !isset($myTeamPlayersId)}0{else}{$myTournament.no_of_changes}{/if}/{$tournament->no_of_changes}</div></div>
					<div class="changes">Changes</div>
					<!--<img src="{$base_dir}images/question_icon.png" class="quest-img-body"/>-->
				</div>
				<div class="mytournament-step1" id="step1body">
					<div style="margin-left:20px;"><b>Enter Your Team Name:</b></div>
					<input type="text" value="{$myTournament.teamname}" name="txtteamname" class="step1txt"/>
					<input type="button" value="submit" class="addfunds" onclick="zeal.players.HiddedWindow();" style="margin-top: 30px;"/>
				</div>
			</div>
			<div class="step2">
				<div class="live-score-menu">
					<div class="step1title">STEP -2</div>
                    <div class="selectteamplayers" id="selectteamplayers"> </div>
                    <div class="amount budjet-text"  style="color:#000; float:right;">{$tournament->salary_cap}</div>                    
				</div>
                <div class="step2menubg">
                	<div class="name">Name</div>	
                    <div class="role">Role</div>	
                    <div class="country">Country</div>	
                    <div class="salary">Salary</div>
                </div>

				<ul class="mytournament-step1 mytournament-players" id="myteam">
				{if isset($myTeamPlayersId)}
					{foreach from=$team1players item=player name=team1players}
					{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}					
					<li class="player-indi team1" rel="team1" id="player{$player.id}">
						<div style="width:150px;" class="playername"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:18:'...'}</div>
						<div>{$player.player_type}</div>
						<div class="small"><img src="{$tourimageurl}teamsflags/{$team1->flag_url}" alt=""/></div>
						<div class="small run hide">0</div>
						<div class="small">{$player.coc_salary}</div>
						<div class="small"><input type="button" value="" class="btn-remove-player" onclick="zeal.players.remove({$player.id});"/></div>
						<input type="hidden" name="players[]" value="{$player.id}"/>
						<input type="hidden" name="playerssalary" id="salary{$player.id}" value="{$player.coc_salary}"/>
						<script>zeal.players.team1 ++;zeal.players.count ++;zeal.players.budjet += parseInt({$player.coc_salary});</script>
					</li>
					{/if}
					{/foreach}
					{foreach from=$team2players item=player name=team1players}
					{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}							
					<li class="player-indi team2" rel="team2" id="player{$player.id}">
						<div style="width:150px;" class="playername"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:15:'...'}</div>
						<div>{$player.player_type}</div>
						<div class="small"><img src="{$tourimageurl}teamsflags/{$team2->flag_url}" alt=""/></div>
						<div class="small run hide">0</div>
						<div class="small">{$player.coc_salary}</div>
						<div class="small"><input type="button" value="" class="btn-remove-player" onclick="zeal.players.remove({$player.id});"/></div>
						<input type="hidden" name="players[]" value="{$player.id}"/>
						<input type="hidden" name="playerssalary" id="salary{$player.id}" value="{$player.coc_salary}"/>
						<script>zeal.players.team2 ++;zeal.players.count ++;zeal.players.budjet += parseInt({$player.coc_salary});</script>
					</li>					
					{/if}
					{/foreach}					
				{/if}
				</ul>
			</div>
			{if !isset($myTeamPlayersId)}
            <div class="step2-hidden"></div>
			{/if}
			<div class="step3" id="livescoremenu-id-step3">
				<div class="live-score-menu">
					<div class="step1title">STEP -3</div>
				</div>
				<div class="mytournament-step1" style="height:151px;">
					<div class="chooseurcaptain">Choose Your Captain</div>
					<select name="ddcaptain" class="selectcaptain" id="ddcaptain">
                    	<option value="">---select---</option>
					{if isset($myTeamPlayersId)}
						{foreach from=$team1players item=player name=team1players}
						{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
						{if $myTournament.captain == $player.id}
						<option value="{$player.id}" selected="selected">{$player.player_name}</option>
						{else}
						<option value="{$player.id}">{$player.player_name}</option>
						{/if}
						</li>
						{/if}
						{/foreach}
						{foreach from=$team2players item=player name=team1players}
						{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
						{if $myTournament.captain == $player.id}
						<option value="{$player.id}" selected="selected">{$player.player_name}</option>
						{else}
						<option value="{$player.id}">{$player.player_name}</option>
						{/if}
						{/if}
						{/foreach}					
					{/if}
					</select><br/>
					<div class="chooseurcoach">Choose Your Coach</div>
					<select name="coach" class="selectcoach" id="ddcoach">
                    	<option value="">---select---</option>
						{foreach from=$coaches item=coach name=coaches}		
						{if $myTournament.coach == $coach.coach_id}
						<option value="{$coach.coach_id}" selected="selected">{$coach.coach_name} - {$coach.team}</option>
						{else}
  	                    <option value="{$coach.coach_id}">{$coach.coach_name} - {$coach.team}</option>
						{/if}
						{/foreach}
					</select>
					<input type="submit" value="Submit" name="myteam" class="sub-button"/>
				</div>
			</div>
			{if !isset($myTeamPlayersId)}
            <div class="step3-hidden"></div>
			{/if}
			<input type="hidden" name="tour_id" value="{$tour_id}"/>
		</form>
	</div>
</div>
<!-------------------------------- My Tournament -------------------------------->
<!-- Tournment Registration inner window "Connect with facebook"-- START-->
{if !isset($myTeamPlayersId)}
<div class="fund-fulls">
	<div class="my-tournament-team-invite">
		<div class="my-tournament-team-msg">Would you like to invite your friends to take part in this tournament</div>
		<div class="my-tournament-btn-share">
		<input type="button" value="  Yes  " class="addfunds" onclick="zeal.tournament.facebookShare('Come and join me in the {$tournament->name} tournament', 'I have just taken part in the {$tournament->name} tournament in captain of captains. Why dont you join and create your teams for a chance to win real cash prizes.');zeal.players.closewindow();"/>
		<input type="button" value="  No  " class="addfunds" onclick="zeal.players.closewindow();"/>
		</div>
	</div>
</div>
{/if}
<!-- Tournment Registration inner window "Connect with facebook"-- END-->
{/if}
<!---------------------------------- Error Message ---------------------------------------------->
<div class="error-msg">
	<div id="error-msg">Not Allowed</div>
	<input type="button" class="addfunds" value="OK" style="margin:20px 0 0 135px;" onclick="zeal.errors.closePopError();"/>
</div>
<script type="text/javascript">
var matchservertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}-1, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
zeal.tournament.nextMatchTime({$tournament->endtime|date_format:'%Y'}, {$tournament->endtime|date_format:'%m'}, {$tournament->endtime|date_format:'%d'}, {$tournament->endtime|date_format:'%H'}, {$tournament->endtime|date_format:'%M'}, {$tournament->endtime|date_format:'%S'});
</script>