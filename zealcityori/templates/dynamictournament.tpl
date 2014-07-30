{if $tournaments}
{foreach from=$tournaments item=match name=matches}
	{foreach from=$match item=tournament name=tournaments}
	<div class="tounament-row-cont tour-lobby-room daily-tournament{if $tournament.entryfee == 0} free-tournament{else} cash-tournament{/if}">
		<div class="tournament-row-type">
			<div class="tournament-row-type-flag">
				<div class="flag"><img src="{$tourimageurl}teamsflags/{$tournament.flag1}" alt=""></div>
				<div class="v-image-area"></div>
				<div class="flag flag-op"><img src="{$tourimageurl}teamsflags/{$tournament.flag2}" alt=""></div>
			</div>
			<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
			<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
		</div>
		{foreach from=$tournament.tour item=tour name=tours}
		<div class="tour-row-player-entry">
			<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
			<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
			<div class="tour-row-enrty-fee">{if $tour.amount == 0}<b>Free</b>{else}Entry Fee <span class="WebRupee">Rs.</span>{$tour.amount}{/if}</div>
			{if in_array($tour.id, $dailyJoined)}
			{if $tour.tournament_type_id == 1}
			<a href="{$base_dir}my-team/{$tour.tournament_type_id}-type/{$tour.id}/0" class="tour-row-join-btn" >Enter</a>
			{else}
			<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
			{/if}
			{else}
			<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
			{/if}
		</div>
		{/foreach}
	</div>
	<div class="clear"></div>
	{/foreach}
{/foreach}
<div class="clear"></div>
{foreach from=$weeklyTournaments item=match name=matches}
	{foreach from=$match item=tournament name=tournaments}
	<div class="tounament-row-cont tour-lobby-room {if $tournament.type == 5 || $tournament.type == 7} weekly-tournament{else} series-tournament{/if}{if $tournament.entryfee == 0} free-tournament{else} cash-tournament{/if}">
		<div class="tournament-row-type">
			<div class="tour-period-type-txt">{if $tournament.type == 5 || $tournament.type == 7}Weekly{elseif  $tournament.type == 6 || $tournament.type == 8}Series{/if}</div>
			<div class="tour-row-type-win-text">{$tournament.prizetype}</div>
			<div class="tour-row-type-win-cash"><span class="WebRupee">Rs.</span> {$tournament.prize}</div>
		</div>
		{foreach from=$tournament.tour item=tour name=tours}
		<div class="tour-row-player-entry">
			<div class="tour-row-player-count"><span>{$tour.player}</span> Players</div>
			<div class="tour-row-player-joined">Players {$tour.reg_player}/{$tour.player}</div>
			<div class="tour-row-enrty-fee">{if $tour.amount == 0}<b>Free</b>{else}Entry Fee <span class="WebRupee">Rs.</span>{$tour.amount}{/if}</div>
			{if in_array($tour.id, $dailyJoined)}
			<a href="{$base_dir}my-period-tournament-details/{$tour.tournament_type_id}-type/{$tour.id}" class="tour-row-join-btn" >Enter</a>
			{else}
			<div class="tour-row-join-btn tour-join-btn" rel="{$tour.id},{$tour.tournament_type_id}">Join</div>
			{/if}
		</div>
		{/foreach}
	</div>
	<div class="clear"></div>
	{/foreach}
{/foreach}
{else}
<div style="padding-top:5px;">
	<img src="{$base_dir}images/opening-soon-match.png" alt=""/>
</div>
{/if}