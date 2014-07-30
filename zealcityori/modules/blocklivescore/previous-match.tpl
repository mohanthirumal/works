<div class="rightcontext previous-match">
	<div class="content_title">
		<div class="prevmatch_img"></div>
		<p>Previous Matches</p>
	</div>
	{if isset($previous)}
	{foreach from=$previous item=match name=matches}
	<a href="http://www.cricville.com/fullscore/?id={$match.match_id}" target="_blank">
	<div class="prev_match1">
		<div class="prev_match_team1"><img src="{$imageurl}{$match.t1flag}" alt="{$match.t1name}" /></div>		
		<div class="score_detail">
			{if $match.t1score}
			<div class="prev_score">{$match.t1score}/{$match.t1wickets}</div>
			{assign var=overnum value="."|explode:$match.t1overs/6|string_format:"%.0f"}
			<div class="prev_over">{$overnum[0]}.{$match.t1overs%6} ov</div>
			{/if}
			{if $match.t3score}
			<div class="prev_score">{$match.t3score}/{$match.t3wickets}</div>
			{assign var=overnum value="."|explode:$match.t3overs/6|string_format:"%.0f"}
			<div class="prev_over">{$overnum[0]}.{$match.t3overs%6} ov</div>
			{/if}
		</div>
		<div class="prev_versus">Vs</div>
		<div class="prev_match_team2"><img src="{$imageurl}{$match.t2flag}" alt="{$match.t2name}" /></div>
		<div class="score_detail">
			{if $match.t2score}
			<div class="prev_score">{$match.t2score}/{$match.t2wickets}</div>
			<div class="prev_over">{$match.t2overs/6|string_format:"%d"}.{$match.t2overs%6} ov</div>
			{/if}
			{if $match.t4score}
			<div class="prev_score">{$match.t4score}/{$match.t4wickets}</div>
			<div class="prev_over">{$match.t4overs/6|string_format:"%d"}.{$match.t4overs%6} ov</div>
			{/if}
		</div>
	</div>
	<div class="prev_match1_detail">
		<p id="prev_match1_detail1">{$match.tournament_name} - {$match.match_name}</p>
		<p id="prev_match1_detail2">Played at {$match.venue} {$match.city}  </p>
	</div>
	</a>
	<div class="star_player_divider"></div>
	{/foreach}
	{else}
		<div class="match-score-indi" style="height:180px; line-height:80px; text-align:center; background-color:#fff;">
			<b>No Matches</b>
		</div>
	{/if}
	<!--<div class="title1"><a href="#">More</a></div> -->
</div>