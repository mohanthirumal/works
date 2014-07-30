<div class="myteam-body">
	<div class="myteam-pointer-head">Batting</div>
	<div class="myteam-pointer-head" style="margin:0; width:280px;">Bowling</div>
	<div class="myteam-pointer-head" style="margin:0; width:208px;">Fielding</div>
	<div class="myteam-table-header">
		<div class="extra-large">Player Name</div>
		<div class="small">Runs</div>
		<div class="small">Balls</div>
		<div class="small">4's</div>
		<div class="small">6's</div>
		<div class="medium">S.R</div>
		<div class="medium bonus">Bonus</div>
		<div class="medium total">Total</div>
		<div class="small">O</div>
		<div class="small">M</div>
		<div class="small">R</div>
		<div class="small">WK</div>
		<div class="small">E.R</div>
		<div class="medium bonus">Bonus</div>
		<div class="medium total">Total</div>
		<div class="small">Cts</div>
		<div class="small">RO</div>
		<div class="small">St</div>
		<div class="medium bonus">Bonus</div>
		<div class="medium total">Total</div>
		<div class="large">Grand Total</div>
	</div>
	<ul class="myteam-table-body">
		{assign var="scoretotal" value=0}
		{if $players}
		{foreach from=$players item=player name=players}
		<li class="myteam-table-row">
			<div class="extra-large left-align"><img src="{$imageurl1}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:10}{if isset($player.captain)}(c){/if}</div>
			<div class="small">{if $player.runs}{$player.runs}{else}0{/if}</div>
			<div class="small">{if $player.balls}{$player.balls}{else}0{/if}</div>
			<div class="small">{if $player.fours}{$player.fours}{else}0{/if}</div>
			<div class="small">{if $player.sixs}{$player.sixs}{else}0{/if}</div>
			<div class="medium">{if $player.runs == 0}0{else}{math equation="(( x / y ) * z )" x=$player.runs y=$player.balls z=100 format="%.2f"}{/if}</div>
			<div class="medium bonus">{if $player.coc.battingbonus}{$player.coc.battingbonus}{else}0{/if}</div>
			<div class="medium total">{if $player.coc.battingbonus || $player.coc.batting}{$player.coc.battingbonus+$player.coc.batting}{else}0{/if}</div>
			{assign var=overnum value="."|explode:$player.overs/6|string_format:"%.0f"}
			<div class="small">{if $player.overs}{$overnum[0]}.{$player.overs%6}{else}0{/if}</div>
			<div class="small">{if $player.maiden}{$player.maiden}{else}0{/if}</div>
			<div class="small">{if $player.rungiven}{$player.rungiven}{else}0{/if}</div>
			<div class="small">{if $player.wickets}{$player.wickets}{else}0{/if}</div>
			<div class="small">{if $player.overs == 0}0{else}{math equation="(( x / y ) * z )" x=$player.rungiven y=$player.overs z=6 format="%.2f"}{/if}</div>
			<div class="medium bonus">0</div>
			<div class="medium total">{if $player.coc.bowling}{$player.coc.bowling}{else}0{/if}</div>
			<div class="small">{if $player.caught}{$player.caught}{else}0{/if}</div>
			<div class="small">{if $player.runout}{$player.runout}{else}0{/if}</div>
			<div class="small">{if $player.stumped}{$player.stumped}{else}0{/if}</div>
			<div class="medium bonus">0</div>
			<div class="medium total">{if $player.coc.fielding}{$player.coc.fielding}{else}0{/if}</div>
			<div class="large grandtotal">{$player.coc.battingbonus+$player.coc.batting+$player.coc.bowling+$player.coc.fielding}</div>
		</li>
		{assign var="scoretotal" value=$scoretotal+$player.coc.battingbonus+$player.coc.batting+$player.coc.bowling+$player.coc.fielding}
		{/foreach}
		{else}
			<li class="myteam-table-row" style="height:250px; line-height:250px;"><b>No selection made.</b></li>
		{/if}
	</ul>
	<div class="clear"></div>
	{if $players}
	<div class="my-team-coach">Coach: {$coach}</div>
	<div class="my-team-total">Total: {$scoretotal+$coach_run}</div>
	{/if}
</div>
<script>setTimeout("zeal.userteam.dynamicScore({$tournament->id}, {$tournament->tournament_type_id}, {$match->id});", refreshInterval);</script>