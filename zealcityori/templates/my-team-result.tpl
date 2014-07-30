<div class="myteam-body myteam-result">
	{if $tournament->tournament_type_id == 1 || $tournament->tournament_type_id == 3}
	<div class="myteam-prize">
		<div class="myteam-prize-title" style="float:left;">Prize Pool -</div>
		<div style="margin:0 0 0 3px; float:left;">{$tournament->prize_pool->name}</div>
		<div class="clear"></div>
		<div class="myteam-prize-list">
		{foreach from=$tournament->prize_pool->prize item=prize name=prizes}
			<div class="first-place"><div class="fst">{$smarty.foreach.prizes.iteration}</div><div class="fst-amount"><span class="WebRupee">Rs.</span>{$prize}</div></div>
			{assign var="prizetot" value=$smarty.foreach.prizes.iteration}
		{/foreach}
		</div>
	</div>
	{/if}
	<div class="myteam-prizebox">
		<a href="{$base_dir}rules" target="_blank" style="float:left; color:#000; text-decoration:underline; margin:15px 0 0 0; width:100%; text-align:center">Click here to know the rules</a>
		{if empty($winners)}
		<div style="float:left; clear:both; margin:15px 0 0 0; text-align:center; width:100%; font-weight:bold;">Results not yet announced</div>
		{/if}
	</div>
	<div class="myteam-rank">Rank - <span id="myteam-rank">0</span></div>
	<div class="loading myteam-loading" id="myteam-loading"></div>
	<div class="myteam-result">
		{if !empty($winners)}
			<div class="myteam-result-head">
				<div class="small">Rank</div>
				<div class="large">Player Name</div>
				<div class="small">Run</div>
			</div>
			{foreach from=$winners item=winner name=winners}
				{if $winner.user_id == $user->id}<script>zeal.jQuery('#myteam-rank').text({$smarty.foreach.winners.iteration});</script>{/if}
				<div class="myteam-result-body{if $winner.user_id == $user->id} highlight-user{/if}">
					<div class="small">{if $winner.rank}{$winner.rank}{else}{$smarty.foreach.winners.iteration}{/if}</div>
					<div class="large">
						{if $winner.connect_id}
							<img src="https://graph.facebook.com/{$winner.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$winner.username}
					</div>
					<div class="small">{if $winner.run}{$winner.run}{else}0{/if}</div>
					 <div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1({$winner.user_id},{$tournament->id}, {$tournament->tournament_type_id}, {$match->id})">View Team</a></div>
					 {if ($tournament->tournament_type_id == 1 || $tournament->tournament_type_id == 3) && $winner.prize_money > 0}
					 <div style="float:left">
					 	<!--<div class="medal" style="float:left; margin-top:8px;"><img src="{$base_dir}images/Social_gold.png" width="20" height="25"/></div>-->
						<div class="small"><b><span class="WebRupee">Rs.</span>{$winner.prize_money}</b></div>
					 </div>
					 {/if}
				</div>
			{/foreach}
		   
		{else}
			<div id="dynamicresult">
				<div class="myteam-result-head">
					<div class="small">No</div>
					<div class="large">Player Name</div>
					<div class="large">Team Name</div>
					<div class="small"></div>
				</div>
				{foreach from=$playerresult item=player name=playerresult}
					<div class="myteam-result-body">
						<div class="small" >{$smarty.foreach.playerresult.iteration}</div>
						<div class="large">
						{if $player.connect_id}
							<img src="https://graph.facebook.com/{$player.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$player.username}
						</div>
						<div class="large">{$player.teamname}&nbsp;</div>
					</div>                        
				{/foreach}
			</div>
			<script>setTimeout("zeal.userteam.dynamicResult({$tournament->id}, {$tournament->tournament_type_id}, {$match->id});", 1);</script>
		{/if}
	</div>
</div>