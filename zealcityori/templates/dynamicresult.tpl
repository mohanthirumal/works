<div class="myteam-result-head">
	<div class="small">Rank</div>
	<div class="large">Player Name</div>
	<div class="large">Team Name</div>
	<div class="small">Teams</div>
	<div class="small">Runs</div>
</div>
{foreach from=$playerresult item=player name=playerresult}
	{if $player.user_id == $user->id}<script>zeal.jQuery('#myteam-rank').text({$smarty.foreach.playerresult.iteration});</script>{/if}
	<div class="myteam-result-body{if $player.user_id == $user->id} highlight-user{/if}">
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
		<div class="small"><a href="#"class="lobby-join" onclick="zeal.userteam.selectTournament1({$player.user_id},{$tournament->id}, {$tournament->tournament_type_id}, {$match->id})">View Team</a></div>
		<div class="small">{$player.run}</div>
	</div>                        
{/foreach}