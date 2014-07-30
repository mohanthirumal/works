{if !isset($tour_id)}
<h1 style="color:#fff;">Not Allowed</h1>
{else}
<!-------------------------------- My Tournament -------------------------------->
<div class="my-tournament-container">
	<div class="left-container">
		<div class="live-score-menu">
			<ul>
				<li class="active">News</li>
				<li>Research</li>
				<li>Discussions</li>
				<li>Blogs</li>
			</ul>
		</div>
		<div class="mytournament-filter">
			<input type="checkbox" name="filter"/>All
			<input type="checkbox" name="filter"/>{$team1->teamname}
			<input type="checkbox" name="filter"/>{$team2->teamname}
		</div>
		<div class="mytournament-players">
			<div id="team1">
				{foreach from=$team1players item=player name=team1players}
				{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
					
				{else}
				<div class="player-indi" rel="team1" id="player{$player.id}">
					<div style="width:150px;"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:18:'...'}</div>
					<div>{$player.player_type}</div>
					<div class="small"><img src="{$tourimageurl}teamsflags/{$team1->flag_url}" alt=""/></div>
					<div class="small run">1000</div>
					<div class="small">1000</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add({$player.id});"/></div>
					<input type="hidden" name="players[]" value="{$player.id}"/>
				</div>
				{/if}
				{/foreach}
			</div>
			<div id="team2">
				{foreach from=$team2players item=player name=team1players}
				{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}
				
				{else}			
				<div class="player-indi" rel="team2" id="player{$player.id}">
					<div style="width:150px;"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:15:'...'}</div>
					<div>{$player.player_type}</div>
					<div class="small"><img src="{$tourimageurl}teamsflags/{$team2->flag_url}" alt=""/></div>
					<div class="small run">1000</div>
					<div class="small">1000</div>
					<div class="small"><input type="button" value="Add" onclick="zeal.players.add({$player.id});"/></div>
					<input type="hidden" name="players[]" value="{$player.id}"/>
				</div>
				{/if}
				{/foreach}
			</div>
		</div>
	</div>
	<div class="right-container">
		<form method="post">
			<div class="step1">
				<div class="live-score-menu">
					Step1
				</div>
				<div class="mytournament-step1">
					<input type="text" value="{$myTournament.teamname}" name="txtteamname"/>
					<input type="button" value="submit"/>
				</div>
			</div>
			<div class="step2">
				<div class="live-score-menu">
					Step2
				</div>
				<div class="mytournament-step1 mytournament-players" id="myteam">
				{if isset($myTeamPlayersId)}
					{foreach from=$team1players item=player name=team1players}
					{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}					
					<div class="player-indi" rel="team1" id="player{$player.id}">
						<div style="width:150px;"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:18:'...'}</div>
						<div>{$player.player_type}</div>
						<div class="small"><img src="{$tourimageurl}teamsflags/{$team1->flag_url}" alt=""/></div>
						<div class="small run hide">1000</div>
						<div class="small">1000</div>
						<div class="small"><input type="button" value="remove" onclick="zeal.players.remove({$player.id});"/></div>
						<input type="hidden" name="players[]" value="{$player.id}"/>
					</div>
					{/if}
					{/foreach}
					{foreach from=$team2players item=player name=team1players}
					{if isset($myTeamPlayersId) && in_array($player.id, $myTeamPlayersId)}							
					<div class="player-indi" rel="team2" id="player{$player.id}">
						<div style="width:150px;"><img src="{$tourimageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:15:'...'}</div>
						<div>{$player.player_type}</div>
						<div class="small"><img src="{$tourimageurl}teamsflags/{$team2->flag_url}" alt=""/></div>
						<div class="small run hide">1000</div>
						<div class="small">1000</div>
						<div class="small"><input type="button" value="remove" onclick="zeal.players.remove({$player.id});"/></div>
						<input type="hidden" name="players[]" value="{$player.id}"/>
					</div>
					{/if}
					{/foreach}					
				{/if}
				</div>
			</div>
			<div class="step3">
				<div class="live-score-menu">
					Step3
				</div>
				<div class="mytournament-step1">
					Choose your captain
					<select name="ddcaptain">
					{foreach from=$team1players item=player name=team1players}
						{if $myTournament.captain == $player.id}
							<option value="{$player.id}" selected="selected">{$player.player_name}</option>
						{else}
							<option value="{$player.id}">{$player.player_name}</option>
						{/if}
					{/foreach}
					{foreach from=$team2players item=player name=team1players}
						{if $myTournament.captain == $player.id}
							<option value="{$player.id}" selected="selected">{$player.player_name}</option>
						{else}
							<option value="{$player.id}">{$player.player_name}</option>
						{/if}
					{/foreach}
					</select><br/>
					choose your coach
					<select name="coach">
					</select>
				</div>
			</div>
			<input type="submit" value="Submit" name="myteam" class="button"/>
			<input type="hidden" name="tour_id" value="{$tour_id}"/>
		</form>
	</div>
</div>
<!-------------------------------- My Tournament -------------------------------->
{/if}