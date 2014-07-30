<div class="jointournamentContainnor">
	<div class="joinTournamentContainnorClassHead">{$tournament->name} {$tournament->tournament_type->nickname} fantasy pool</div>
	<div style="float:left; width:100%; background-color:#fff; border-radius:0 0 8px 8px;-moz-border-radius:0 0 8px 8px;-web-border-radius:0 0 8px 8px; padding-bottom:8px;">
		<div class="jointitleContent">
			<div class="firstClassContent">Entry Fee: <span class="WebRupee">Rs.</span>{$tournament->entry_fee}</div>
			<div class="firstClassContent">Salary cap: 100 K</div>
			<div class="firstClassContent">Single entry</div>
			<div class="firstClassContent">Entries: {$tournament->joinPlayers}/{$tournament->players}</div>
			<div class="firstClassContent" style="width:27%">Guaranteed prize pool</div>
		</div>
		<div class="InnerJoin-containnor-select all-tournament">
			<div class="dailyfantasy">{$tournament->tournament_type->name} Fantasy League</div>
            <div class="headerFileClass">
                <ul>
                    <li class="headermenuClass active" onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'match-info', this)" style="margin:9px 0 0 23px"><div class="IconeImages5"></div>Info</li>
                    <li class="headermenuClass " onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'joined-user', this)"><div class="IconeImages6"></div>Entries</li>
                    <li class="headermenuClass " onclick="zeal.tournament.showJoinTournamentTab('all-tournament', 'inner-Join-containnor-text', 'prize-detail', this)"><div class="IconeImages7"></div>Prizes</li>
                </ul>
            </div>
			<div class="main-class-content">
            	<div class="inner-Join-containnor-text match-info" style=" background-color:#E1E1E1;" id="joitournamentId-3" >
					<div class="btn-class-Inner-sec">Pick a team of 11 from each of the following games</div>
					<div class="falgClassContainnor">
						{if $tournament->tournament_type->id >= 5}
                        	{foreach from=$match item=match name=match}
                                    <div class="match-det{if $smarty.foreach.match.iteration > 2} hide{/if}">
                                        <div class="match-type-containnorClass">{$match.type}</div>
                                        <div class="match-type-containnorClass" style="width:44%">
                                            <div class="flagsClassImages">
                                                <div class="classImages"><img style="width:100%" src="{$imageurl}{$match.t2flag}" alt="{$match.t1name}"></div>
                                                <span>{$match->team1Details->teamname}</span>
                                            </div>
                                            <div class="vs-class-containnor">Vs</div>
                                            <div class="flagsClassImages">
                                                <div class="classImages"><img style="width:100%" src="{$imageurl}{$match.t1flag}" alt="{$match.t2name}"></div>
                                                <span>{$match->team2Details->teamname}</span>
                                            </div>
                                        </div>
                                        <div class="match-type-containnorClass" style="width:30%; line-height:19px;"><br/>{$match.match_date|date_format:'%a %R'} IST<br/>{$match.match_date|date_format:'%d-%m-%Y'}</div>
                                    </div>
                               	{assign var="matchDetCount" value=$smarty.foreach.match.iteration}
                            {/foreach}
						{else}
                        	<div class="match-type-containnorClass">{$match->type}</div>
                            <div class="match-type-containnorClass" style="width:44%">
                                <div class="flagsClassImages">
                                    <div class="classImages"><img style="width:100%" src="{$imageurl}{$match->team1Details->flag_url}" alt="{$match->team1Details->teamname}"></div>
                                    <span>{$match->team1Details->teamname}</span>
                                </div>
                                <div class="vs-class-containnor">Vs</div>
                                <div class="flagsClassImages">
                                    <div class="classImages"><img style="width:100%" src="{$imageurl}{$match->team2Details->flag_url}" alt="{$match->team2Details->teamname}"></div>
                                    <span>{$match->team2Details->teamname}</span>
                                </div>
                            </div>
                            <div class="match-type-containnorClass" style="width:30%;">{$tournament->endtime|date_format:'%A %R'}</div>
						{/if}
					</div>
                    {if $matchDetCount > 2}
	                    <div class="btn-class-corner-classs match-list" style="margin:4px 4px 0 0" onclick="zeal.tournament.joinTourMore();">More..</div>
					{/if}
				</div>
				<div class="inner-Join-containnor-text joined-user" id="joitournamentId-1" style="display:none;" >
					<div class="play-det-cont" style=" float:left;margin:10px 0 0 0; width:100%; height: 200px; overflow-y: auto;">
                    	{assign var="joinplaycount" value=0}
						{foreach from=$players item=player name=players}
	                         <div class="name-Containnor-text play-det{if $smarty.foreach.players.iteration > 4} hide{/if}">{$player.username}</div> <br/>
                            {assign var="joinplaycount" value=$smarty.foreach.players.iteration}
                        {/foreach}
					</div>
                    {if $joinplaycount > 4 }
						<div class="btn-class-corner-classs player-list" onclick="zeal.tournament.playerList();">More..</div>
					{/if}
				</div>
				<div class="inner-Join-containnor-text prize-detail" style="width:50%; display:none;float: left; margin: 20px 0 20px 130px; padding: 0 0 10px 0; height:auto" id="joitournamentId-2" >
					<div class="prize-pool-Containnor"><div class="IconeImages7" style="margin:3px 3px 0 60px;"></div>Prize pool</div>
                    {foreach from=$tournament->prize_pool->prize item=prize name=prizes}
                        <div class="small-containnor">
                            <div class="s-noClass">
                                {$smarty.foreach.prizes.iteration}
                            </div>
                            <div class="s-noClass" style="width:70%; text-align:center;">
                                <span class="WebRupee">Rs.</span>{$prize}
                            </div>
						</div>
                    {/foreach}
				</div>
			</div>
		</div>
		<div class="rightContainnorClass">
			<h1>Start Time</h1>
            <div class="timer">		
                <div id="defaultCountdown"></div>
            </div>
            <div class="btn-cotainnorClass" style="margin:30px 0 0 5px; height:90px">
                <div style="float:left; width:100%; margin:15px 0 0 0;">
                    <div class="date-column">{$tournament->endtime|date_format:'%A'}</div>
                    <div class="date-column">{$tournament->endtime|date_format:'%n %R'} IST</div>
                    <div class="date-column">{$tournament->endtime|date_format:'%d-%m-%Y'}</div>
                </div>
            </div>
		</div>
		<div class="loading hide loading-tour-join"></div>
		<input type="button" onclick="zeal.tournament.closeTournament()" class="common-btn create-tournament-btn" value="Cancel"/>
		{if $tournament->entry_fee == 0}
		<input type="button" onclick="zeal.tournament.checkUserLike({$tournament->id}, {$tournament->tournament_type_id}, this);" class="common-btn create-tournament-btn" value="Join tournament"/>
		{else}
		<input type="button" onclick="zeal.tournament.confirmJoin({$tournament->id}, {$tournament->tournament_type_id}, this);" class="common-btn create-tournament-btn" value="Join tournament"/>
		{/if}
	</div>
</div>
<div class="insufficient-innercontainer insufficientcash">
	<div class="inner-header"><div class="tournlobbybutton">Insufficient Cash</div></div>
	<div class="joinquestion" style="margin-left:20px;">Sorry you do not have sufficient balance, you can add funds to start playing for real money</div>
	<div class="tournregis-divider"></div>
	<input type="button" value="Add funds" class="addfunds" style="height:30px; margin:10px 0 0 180px;" onclick="window.location.href='deposit'"/>
</div>
<script type="text/javascript">
var servertime = new Date({$now|date_format:'%Y'}, {$now|date_format:'%m'}, {$now|date_format:'%d'}, {$now|date_format:'%H'}, {$now|date_format:'%M'}, {$now|date_format:'%S'});
zeal.tournament.calculateTime({$tournament->endtime|date_format:'%Y'}, {$tournament->endtime|date_format:'%m'}, {$tournament->endtime|date_format:'%d'}, {$tournament->endtime|date_format:'%H'}, {$tournament->endtime|date_format:'%M'}, {$tournament->endtime|date_format:'%S'});
</script>