{foreach from=$mytournaments item=tournament name=weeklyTournaments}
<div class="index-lobby-room my-tour-indi{if $tournament.status == 'Completed'} compl-tour{/if}{if $tournament.status == 'Destroyed'} destr-tour{/if}{if $tournament.tournament_type_id == 1 || $tournament.tournament_type_id == 3} daily-tournament{elseif $tournament.tournament_type_id == 5 || $tournament.tournament_type_id == 7} weekly-tournament{else} series-tournament{/if}">
	<div class="divider"></div>
	<div class="extra-large"{if $tournament.name|count_characters:true > 23} style="line-height:25px;"{/if}>{$tournament.name}</div>
	<div class="divider"></div>
	<div class="large">{if $tournament.tournament_type_id == 1 || $tournament.tournament_type_id == 3} Daily{elseif $tournament.tournament_type_id == 5 || $tournament.tournament_type_id == 7} Weekly{else} Series{/if}</div>
	<div class="divider"></div>
	<div class="large"><span class="WebRupee">Rs.</span>{$tournament.amount}</div>
	<div class="divider"></div>
	<div class="large">{$tournament.reg_player}/{$tournament.player}</div>
	<div class="divider"></div>
	<div class="large"><span class="WebRupee">Rs.</span>{$tournament.prize}</div>
	<div class="divider"></div>
	<div class="small">{if $tournament.position == 0}NA{else}{$tournament.position}{/if}</div>
	<div class="divider"></div>
	<div class="extra-large">{$tournament.endtime|date_format:'%a %R %b %e'}</div>
	<div class="divider"></div>
	<div class="medium">
	{if $tournament.status == 'Destroyed'}
		<b>{$tournament.status}</b>
	{else}
		{if $tournament.tournament_type_id == 1}
		<a href="{$base_dir}my-team/{$tournament.tournament_type_id}-type/{$tournament.id}/0" class="lobby-join" >Enter</a>
		{else}
		<a href="{$base_dir}my-period-tournament-details/{$tournament.tournament_type_id}-type/{$tournament.id}" class="lobby-join" >Enter</a>
		{/if}
	{/if}
	</div>
</div>
{/foreach}