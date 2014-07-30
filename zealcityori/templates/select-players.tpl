<div class="innercontainer">
	<div class="innerheader"><input type="button" value="Select Players" class="tournlobbybutton"/></div>
	<div class="select-team">
		<h2>{$team1->teamname}</h2>
		<ul id="team1">
		{foreach from=$team1players item=player name=team1players}
			<li rel="team1_{$player.id}" onclick="zeal.players.add(this);">{$player.player_name}</li>
		{/foreach}
		</ul>
	</div>
	<div class="select-team">
		<h2>{$team2->teamname}</h2>
		<ul id="team2">
		{foreach from=$team2players item=player name=team2players}
			<li rel="team2_{$player.id}" onclick="zeal.players.add(this);">{$player.player_name}</li>
		{/foreach}
		</ul>
	</div>
	<div class="select-team">
		<h2>My Team</h2>
		<ul id="myteam"></ul>
	</div>
	<div class="clear"></div>
	<div class="joinbut"><div class="butname" onclick="">Join</div></div>
	<div class="cancelbut"><div class="butname" onclick="zeal.tournament.closeTournament();">Cancel</div></div>
</div>
<script>
{literal}
//zeal.jQuery("#team1 li").each(function() {
//	zeal.jQuery(this).click(function(){
//		zeal.jQuery(this).prependTo('#myteam');
//	});
//});
//zeal.jQuery("#team2 li").each(function() {
//	zeal.jQuery(this).click(function(){
//		zeal.jQuery(this).prependTo('#myteam');
//	});
//});
//zeal.jQuery("#myteam li").each(function() {
//	zeal.jQuery(this).click(function(){
//		if(zeal.jQuery(this).attr('rel') == "team1")
//			zeal.jQuery(this).prependTo('#team1');
//		else
//			zeal.jQuery(this).prependTo('#team2');
//	});
//});
{/literal}
</script>