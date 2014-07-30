  <!-- Live score widget new Box start--> 
<div class="live-score-widjet">
	<div class="live-score-menu rightscore">
		<ul>
			{if $liveScores}
			<li class="active" onclick="zeal.index.showContent('match-score', 'livescore', 1, this, 'rightscore')">Live Scores</li>
			{/if}
			<li{if !$liveScores} class="active" {/if} onclick="zeal.index.showContent('match-score', 'livescore', 2, this, 'rightscore')">Fixtures</li>
			<li onclick="zeal.index.showContent('match-score', 'livescore', 3, this, 'rightscore')">Results</li>
		</ul>
	</div>
	{if $liveScores}
	<div class="match-score" id="livescore1">
		{foreach from=$liveScores item=liveScore name=liveScores}
			<a href="http://www.cricville.com/fullscore/?id={$liveScore->match->id}" target="_blank">
                <div class="match-score-indivi{if ($smarty.foreach.liveScores.iteration >1)} hide{/if}" id="livescoreindi{$smarty.foreach.liveScores.iteration}">
                    <div class="linetop"></div>
					<div style="height:20px; width:100%; float:left;"></div>
                    <div class="venue">{$liveScore->batting->teamname} Vs {$liveScore->bowling->teamname}, {$liveScore->match->match_name} at</div>
                    <div class="venue">{$liveScore->match->venue->venue} {$liveScore->match->venue->city}</div>
					<div style="height:20px; width:100%; float:left;"></div>
                    <div class="flagarea"{if !isset($liveScore->currentInnings)} style="margin-left:65px;"{/if}>
                        <img src="{$imageurl}{$liveScore->batting->flag_url}" alt="" class="team1-flag"/><br />
                        {$liveScore->batting->teamname}
                    </div>
                    <div class="vs-area"><img src="images/vs_img.png" class="versus"/></div>
                    <div class="flagarea">
                        <img src="{$imageurl}{$liveScore->bowling->flag_url}" alt="" class="team1-flag"/><br />
                        {$liveScore->bowling->teamname}
                    </div>
                    {if isset($liveScore->currentInnings)}
                    <div class="team1-score-area"><div class="team1-score">{$liveScore->batting->team_nickname}:{$liveScore->score}/{$liveScore->wickets}</div></div>   	                                                                   
                    <div class="totalovers">{$liveScore->overs} overs</div>
                    {/if}
                    <div class="match-score-status">{if isset($liveScore->status)}{$liveScore->status}{/if}</div>
					<div style="height:20px; width:100%; float:left;"></div>                    
                </div>
			</a>
		{/foreach}
		<div class="livescore-list">
		<div class="linetop"></div>
			<img  src="images/ARROW_left.png" class="left-move" onclick="zeal.sidebar.scrollRight(100, 'sidebar-scorecard-nav-inner');"/>
			<div class="sidebar-scorecard-nav">
				<div class="sidebar-scorecard-nav-inner">
					{foreach from=$liveScores item=liveScore name=liveScores}
					<div class="vert-line"></div>
					<div class="other-livematch1" onclick="zeal.index.showContent('match-score-indivi', 'livescoreindi', {$smarty.foreach.liveScores.iteration},this,'')">
						<img src="{$imageurl}{$liveScore->batting->flag_url}" alt="" class="otherlive-team1-flag"/>
						<img src="images/vs_img.png" class="other-versus"/>
						<img src="{$imageurl}{$liveScore->bowling->flag_url}" alt="" class="otherlive-team2-flag"/>
					</div>
					<script>zeal.sidebar.scoreScroll++;</script>
					{/foreach}
				</div>
			</div>
			<div class="vert-line"></div>
			<img  src="images/ARROW_RIGHT.png" class="right-move" onclick="zeal.sidebar.scrollLeft(100, 'sidebar-scorecard-nav-inner');"/>
		</div>
	 </div>
	 {/if}
	 <div class="match-score {if $liveScores} hide{/if}" id="livescore2">
	 	<div class="index-fixtures-cont">
		{if $upcomingMatches}
		{foreach from=$upcomingMatches item=upcomingMatch name=upcomingMatches}
		<div class="index-fixtures-indi">
			<div class="index-fixtures-left">
				<div class="flag"><img src="{$imageurl}{$upcomingMatch.t1flag}" alt="{$upcomingMatch.teamname}" /></div>
				<div class="v-image-area"></div>
				<div class="flag"><img src="{$imageurl}{$upcomingMatch.t2flag}" alt="{$upcomingMatch.teamname}" /></div>
			</div>
			<div class="index-fixtures-right">
				<b>{$upcomingMatch.team1|upper} V {$upcomingMatch.team2|upper} - {$upcomingMatch.match_name}</b><br/>
				{$upcomingMatch.match_date|date_format:'%B'} {$upcomingMatch.match_date|date_format:'%e'} - {$upcomingMatch.match_date|date_format:$date.time} IST
			</div>
		</div>
		{/foreach}
		{else}
		<div class="match-score-indi" style="height:120px; line-height:120px; text-align:center;">
			<b>No Matches</b>
		</div>
		{/if}
		<div class="match-score-indi even last"><a href="http://www.cricville.com/fixtures/" target="_blank"><input type="button" class="more score-more" value="MORE" /></a></div>
		</div>
	</div>
	 <div class="match-score hide" id="livescore3">
	 	<div class="index-fixtures-cont">
	 	{if $resultMatches}
		{foreach from=$resultMatches item=resultMatch name=resultMatches}
		<a href="http://www.cricville.com/fullscore/?id={$resultMatch->match->id}" target="_blank">
		<div class="index-fixtures-indi">
			<div class="index-fixtures-left">
				<div class="flag"><img src="{$imageurl}{$resultMatch->batting->flag_url}" alt="" /></div>
				<div class="v-image-area"></div>
				<div class="flag"><img src="{$imageurl}{$resultMatch->bowling->flag_url}" alt="" /></div>
			</div>
			<div class="index-fixtures-right">
				<b>{$resultMatch->batting->team_nickname|upper} V {$resultMatch->bowling->team_nickname|upper}</b><br/>
				{$resultMatch->match->match_date|date_format:'%B'} {$resultMatch->match->match_date|date_format:'%e'} - 
				{if $resultMatch->match->won_team_id == $resultMatch->batting->id}
					{$resultMatch->batting->team_nickname} won the match
				{elseif $resultMatch->match->won_team_id == 0}
					{$resultMatch->match->resultstatus}
				{else}
					{$resultMatch->bowling->team_nickname} won the match
				{/if}
			</div>
		</div>
		</a>
		{/foreach}
		{else}
		<div class="match-score-indi" style="height:120px; line-height:120px; text-align:center;">
			<b>No Matches</b>
		</div>
		{/if}
		</div>
		<div class="match-score-indi even last"><a href="http://www.cricville.com/results/" target="_blank"><input type="button" class="more score-more" value="MORE" /></a></div>
	 </div>
</div>
<!-- Live score widget new Box END--> 