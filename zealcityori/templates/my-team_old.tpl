<div class="myteam" id="myteam">
	<div style="padding:10px; background-color:#EBEBEB; font-weight:bold; font-size:18px; margin:10px 0 10px 0;">
    	<div style="float:left">{$tournament->name}</div>
        <div style="text-align:right;">Status - {$tournament->status}</div>
    </div>
	<div class="live-score-menu">
		<ul>
			<li class="active" onclick="zeal.index.showContent('myteam-list', 'myteam', 1, this, 'live-score-menu')">My Team</li>
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 2, this, 'live-score-menu')">Tournament Details</li>			
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 3, this, 'live-score-menu')">Result</li>
		</ul>		
		<div style="float:right; margin:10px 10px 0 0;">
			<div>No.of.Changes : {$myTournament.no_of_changes}/{$tournament->no_of_changes}
                {if $myTournament.no_of_changes < $tournament->no_of_changes }
					<a href="{$base_dir}my-tournament/{$tournament->id}">Edit</a>
                {/if}
            </div>
        </div>        
	</div>
	<div id="myteam1" class="myteam-list">		
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
				{foreach from=$players item=player name=players}
				<li class="myteam-table-row">
					<div class="extra-large left-align"><img src="{$imageurl}players/{$player.photo_url}" alt=""/>{$player.player_name|truncate:10}{if isset($player.captain)}(c){/if}</div>
					<div class="small">{$player.runs}</div>
					<div class="small">{$player.balls}</div>
					<div class="small">{$player.fours}</div>
					<div class="small">{$player.sixs}</div>
					<div class="medium">{if $player.runs == 0}0{else}{math equation="(( x / y ) * z )" x=$player.runs y=$player.balls z=100 format="%.2f"}{/if}</div>
					<div class="medium bonus">{$player.coc.battingbonus}</div>
					<div class="medium total">{$player.coc.battingbonus+$player.coc.batting}</div>
					{assign var=overnum value="."|explode:$player.overs/6|string_format:"%.0f"}
					<div class="small">{$overnum[0]}.{$player.overs%6}</div>
					<div class="small">{$player.maiden}</div>
					<div class="small">{$player.rungiven}</div>
					<div class="small">{$player.wickets}</div>
					<div class="small">{if $player.overs == 0}0{else}{math equation="(( x / y ) * z )" x=$player.rungiven y=$player.overs z=6 format="%.2f"}{/if}</div>
					<div class="medium bonus">0</div>
					<div class="medium total">{$player.coc.bowling}</div>
					<div class="small">{$player.caught}</div>
					<div class="small">{$player.runout}</div>
					<div class="small">{$player.stumped}</div>
					<div class="medium bonus">0</div>
					<div class="medium total">{$player.coc.fielding}</div>
					<div class="large grandtotal">{$player.coc.battingbonus+$player.coc.batting+$player.coc.bowling+$player.coc.fielding}</div>
				</li>
				{assign var="scoretotal" value=$scoretotal+$player.coc.battingbonus+$player.coc.batting+$player.coc.bowling+$player.coc.fielding}
				{/foreach}
			</ul>
			<div class="clear"></div>
			<div class="my-team-coach">Coach: {$coach}</div>
			<div class="my-team-total">Total: {$scoretotal+$coach_run}</div>
		</div>
	</div>
	<div id="myteam2" class="myteam-list" style="display:none;">
		<div class="myteam-body">
			<div class="myteam-tour-details">
				<div class="myteam-tour-details-inner">
					<div class="tour-detail-label">Tournament Name:</div>
					<div class="tour-detail-label"><b>{$tournament->name}</b></div>
					<div class="tour-detail-label">Type:</div>
					<div class="tour-detail-label"><b>{$match->type}</b></div>
					<div class="tour-detail-label">Tournament ID:</div>
					<div class="tour-detail-label"><b>{$tournament->id}</b></div>
					<div class="tour-detail-label">Entry Fee:</div>
					<div class="tour-detail-label"><b>{$tournament->entry_fee}</b></div>
					<div class="tour-detail-label">Players:</div>
					<div class="tour-detail-label"><b>{$tournament->joinPlayers}/{$tournament->players}</b></div>
				</div>
			</div>
		</div>
	</div>
	<div id="myteam3" class="myteam-list" style="display:none;">
		<div class="myteam-body myteam-result">
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
            	<a href="{$base_dir}rules" style="float:left; color:#000; text-decoration:underline; margin:15px 0 0 0; width:100%; text-align:center">Click here to know the rules</a>
				{if empty($winners)}
				<div style="float:left; clear:both; margin:15px 0 0 0; text-align:center; width:100%; font-weight:bold;">Results not yet announced</div>
				{/if}
                <!--<a href="{$base_dir}how-it-works">Click here to know how it works</a>-->
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
						<div class="small">{$smarty.foreach.winners.iteration}</div>
						<div class="large">
							{if $winner.connect_id}
								<img src="https://graph.facebook.com/{$winner.connect_id}/picture" alt=""/>
							{else}
								<img src="{$base_dir}images/avatar.jpg" alt="" />
							{/if}
							{$winner.username}
						</div>
						<div class="small">{if $winner.run}{$winner.run}{else}0{/if}</div>
                        <div style="width:20px; height:25px; float:left">
                       		{if $smarty.foreach.winners.iteration <= $prizetot  }
                            	{if $smarty.foreach.winners.iteration ==1}
                                	<div class="medal" style="float:left; margin-top:8px;"><img src="{$base_dir}images/Social_gold.png" width="20" height="25"/></div>
								{elseif $smarty.foreach.winners.iteration == 2}   
                                	<div class="medal" style="float:left; margin-top:8px;"><img src="{$base_dir}images/Social_platinum.png" width="20" height="25"/></div>
								{elseif $smarty.foreach.winners.iteration == 3 || $smarty.foreach.winners.iteration == 4 || $smarty.foreach.winners.iteration == 5 || $smarty.foreach.winners.iteration == 6}
									<div class="medal" style="float:left; margin-top:8px;"><img src="{$base_dir}images/social_silver.png" width="20" height="25"/></div>
                                {/if}
                            {/if}
						</div>
						<div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1({$winner.user_id},{$tournament->id})">View Team</a></div>
					</div>
					{/foreach}
				{else}
					<div id="dynamicresult">
						<div class="myteam-result-head">
							<div class="small">No</div>
							<div class="large">Player Name</div>
							<div class="large">Team Name</div>
							<div class="small">Teams</div>
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
									<img src="https://graph.facebook.com/{$player.connect_id}/picture" alt=""/>
								{else}
									<img src="{$base_dir}images/avatar.jpg" alt="" />
								{/if}
								{$player.username}
								</div>
								<div class="large">{$player.teamname}&nbsp;</div>
								<div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1({$player.user_id},{$tournament->id})">View Team</a></div>
							</div>                        
						{/foreach}
					</div>
					<script>setTimeout("zeal.userteam.dynamicResult({$tournament->id});", 1);</script>
				{/if}
			</div>
		</div>
	</div>
</div>
<script>setTimeout("zeal.userteam.dynamicScore({$tournament->id});", refreshInterval);</script>