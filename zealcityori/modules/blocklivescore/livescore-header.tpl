<div class="live-match-cont">
	<div class="live-match-left" onmouseout="zeal.index.scrollTopTimer();" onmouseover="zeal.index.scrollRight(186,'live-match-center-inner', 1);"></div>
	<div class="live-match-center">
		<div class="live-match-center-inner">
			{foreach from=$liveScores item=liveScore name=liveScores}
			<a href="http://www.cricville.com/fullscore/?id={$liveScore->match->id}" target="_blank">
			<div class="live-match-indiv live">
				<div class="inner">
					<div class="flag"><img src="{$imageurl}{$liveScore->batting->flag_url}" alt="{$liveScore->batting->teamname}" /></div>
					<div class="v-image-area"></div>
					<div class="flag"><img src="{$imageurl}{$liveScore->bowling->flag_url}" alt="{$liveScore->bowling->teamname}" /></div>
                    {if isset($liveScore->currentInnings)}
					<div class="score-text">
						<div class="score"><b>{$liveScore->batting->team_nickname}</b>-{$liveScore->score}/{$liveScore->wickets}</div>
						<div class="overs">Overs : {$liveScore->overs}</div>
					</div>
					{if isset($liveScore->innings[$bowlTeamId][1].score)}
					<div class="clear"></div>
					{assign var=bowlTeamId value="`$liveScore->bowling->id`"}
					{$liveScore->bowling->team_nickname}: {$liveScore->innings[$bowlTeamId][1].score}/{$liveScore->innings[$bowlTeamId][1].wickets}
					{/if}
                    {else}
                    <div class="score-text score-text1">
	                    <div class="teams">{$liveScore->batting->team_nickname} V {$liveScore->bowling->team_nickname}</div>
						<div class="match-details">Match Delayed</div>
					</div>
                    {/if}
				</div>
			</div>
			</a>
			<script>zeal.index.scoreScroll++;</script>
			{/foreach}
			{foreach from=$upcomingMatches item=upcomingMatch name=upcomingMatches}
			<!--<a href="{$base_dir}research-details">-->
			<a href="http://www.cricville.com/fixtures/" target="_blank">
			<div class="live-match-indiv fixtures">
				<div class="inner">
					<div class="flag"><img src="{$imageurl}{$upcomingMatch.t1flag}" alt="{$upcomingMatch.teamname}" /></div>
                    <div class="v-image-area"></div>
					<div class="flag"><img src="{$imageurl}{$upcomingMatch.t2flag}" alt="{$upcomingMatch.teamname}" /></div>
					<div class="score-text score-text1">
						<div class="teams">{$upcomingMatch.match_date|date_format:'%A'}</div>
						<div class="match-details">{$upcomingMatch.match_date|date_format:'%B'} {$upcomingMatch.match_date|date_format:'%e'}</div>
					</div>
				</div>
			</div>
			</a>
			<script>zeal.index.scoreScroll++;</script>
			{/foreach}
		</div>
	</div>
	<div class="live-match-right" onmouseover="zeal.index.scrollLeft(186,'live-match-center-inner',1);" onmouseout="zeal.index.scrollTopTimer();"></div>
</div>