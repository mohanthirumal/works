<div class="tournamentInfoContentClass">
	{if $tournament->tournament_type_id == 3}
	<div id="myteam3" class="myteam-list">
		<div class="myteam-result">
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
			<div class="myteam-prizebox">
				<a href="{$base_dir}rules" target="_blank" style="float:left; color:#000; text-decoration:underline; margin:15px 0 0 0; width:100%; text-align:center">Click here to know the rules</a>
				{if empty($winners)}
				<div style="float:left; clear:both; margin:15px 0 0 0; text-align:center; width:100%; font-weight:bold;">Results will be announced shorlty</div>
				{/if}
				<!--<a href="{$base_dir}how-it-works">Click here to know how it works</a>-->
			</div>
			<div class="loading myteam-loading" id="myteam-loading"></div>
			<div class="myteam-result" style="width: 95%;margin: 0 auto; float:none">
				{if !empty($winners)}
					<div class="myteam-result-head">
						<div class="small">Rank</div>
						<div class="large">Player Name</div>
						<div class="small">Runs</div>
					</div>
					{foreach from=$winners item=winner name=winners}
						{if $winner.user_id == $user->id}<script>zeal.jQuery('#myteam-rank').text({$smarty.foreach.winners.iteration});</script>{/if}
						<div class="myteam-result-body{if $winner.user_id == $user->id} highlight-user{/if}">
							<div class="small">{if $winner.rank}{$winner.rank}{else}{$smarty.foreach.winners.iteration}{/if}</div>
							<div class="large">
								{if $winner.connect_id}
									<img src="https://graph.facebook.com/{$winner.connect_id}/picture" alt="" style="width:30px;"/>
								{else}
									<img src="{$base_dir}images/avatar.jpg" alt="" style="width:30px;"/>
								{/if}
								{$winner.username}
							</div>
							<div class="small">{if $winner.run}{$winner.run}{else}0{/if}</div>
							 <div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1({$winner.user_id},{$tournament->id}, {$tournament->tournament_type_id}, {$match->id})">View Team</a></div>
							 {if $winner.prize_money > 0}
							 <div style="float:left">
								<div class="small"><b><span class="WebRupee">Rs.</span>{$winner.prize_money}</b></div>
							 </div>
							 {/if}
						</div>
					{/foreach}
				   
				{else}
					<div id="dynamicresult">
						<div class="myteam-result-head">
							<div class="small">No</div>
							<div class="large" style="text-align:center">Player Name</div>
							<div class="large">Team Name</div>
							<div class="small"></div>
						</div>
						<div class="view-all-container">
							<div class="all-palyers-area">
								{foreach from=$players item=player name=players}
									<div class="all-joined-plyers">{$player.username}</div>
								{/foreach}
							</div>
							<div class="close-but-area"><img src="images/no.png" class="closeimge" onclick="zeal.tournament.viewallplayerCancel()"/></div>
						</div>
						{foreach from=$playerresult item=player name=playerresult}
							<div class="myteam-result-body">
								<div class="small" >{$smarty.foreach.playerresult.iteration}</div>
								<div class="large">
								{if $player.connect_id}
									<img src="https://graph.facebook.com/{$player.connect_id}/picture" alt="" style="width:30px;"/>
								{else}
									<img src="{$base_dir}images/avatar.jpg" alt="" style="width:30px;"/>
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
	</div>
	{else}
	<div id="myteam3" class="myteam-list">
		<div class="myteam-body">
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
			<div class="myteam-prizebox">
				<a href="{$base_dir}rules" target="_blank" style="float:left; color:#000; text-decoration:underline; margin:15px 0 0 0; width:100%; text-align:center">Click here to know the rules</a>
				{if $tournament->status != 'Completed'}
				<div style="float:left; clear:both; margin:15px 0 0 0; text-align:center; width:100%; font-weight:bold;">Results will be announced shorlty</div>
				{/if}
				<!--<a href="{$base_dir}how-it-works">Click here to know how it works</a>-->
			</div>
			<div class="loading myteam-loading" id="myteam-loading"></div>
			<div class="myteam-result" style="width: 95%;margin: 0 auto; float:none">
			{if $results}
			<div class="myteam-result-head">
				<div class="small">Rank</div>
				<div class="large" style="text-align:center">Player Name</div>
				<div class="small">Runs</div>
			</div>
			{foreach from=$results item=winner name=winners}
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
					<div class="large">{if $winner.run}{$winner.run}{else}0{/if}</div>
					 {if  $winner.prize_money > 0}
					 <div style="float:left">
						<div class="small"><b><span class="WebRupee">Rs.</span>{$winner.prize_money}</b></div>
					 </div>
					 {/if}
				</div>
			{/foreach}
		{else}
		<div style="width:100%; font-size:25px; text-align:center">Results will be announced shorlty</div>
		{/if}
		</div>
		</div>
	</div>
	{/if}
</div>