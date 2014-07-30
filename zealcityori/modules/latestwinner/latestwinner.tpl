<div class="leaderboard-container">
	<div class="head">
		<div class="tabs">
			<ul>
				<li class="active" onclick="zeal.index.showContent('body', 'latest-winner-container', 1, this, 'tabs')" style="cursor:pointer;">Latest Winners</li>
				<li onclick="zeal.index.showContent('body', 'latest-winner-container', 2, this, 'tabs')" style="cursor:pointer;">Leaderboards</li>
			</ul>
		</div>
	</div>
	<div class="body" id="latest-winner-container1">
		{if $winners}
		{foreach from=$winners item=winner name=winners}
		<div class="home-winner-indiv">
			<div class="winner-image">
				{if $winner.connect_id}
				<img src="https://graph.facebook.com/{$winner.connect_id}/picture" alt="" width="65px" height="65px"/>
				{else}
				<img src="{$base_dir}images/avatar.jpg" alt=""/>
				{/if}
			</div>
			<div class="winner-desc">
				<span>{$winner.tournamentname}</span><br/>
				{$winner.username}
			</div>
		</div>
		<div class="row-divider"></div>
		{/foreach}
		{else}
		<div style="text-align:center; font-weight:bold; margin-top:20px;">No Winners</div>
		{/if}
	</div>
	<div class="body latest-leaderboard" id="latest-winner-container2">
		<div class="lboard-menu">
			<div class="extra-large"><b>Name</b></div>
			<div class="small"><b>Runs</b></div>
			<div class="small"><b>Rank</b></div>
		</div>
	{foreach from=$leaderboards item=leaderboard name=leaderboards}
		<div class="table-values">
			<div class="extra-large">{$leaderboard.username}</div>
			<div class="small">{$leaderboard.cash}</div>
			<div class="small">{$smarty.foreach.leaderboards.iteration}</div>
		</div>
	{/foreach}
	</div>
</div>
<script language="javascript">
{literal}
var i1 = 0
var speed = 1
function scrollTestNews()
{
	i1 = i1 + speed
	var div = document.getElementById("latest-winner-container1")
	div.scrollTop = i1
	if (i1 > div.scrollHeight - 490) {i1 = 0}
	setTimeout("scrollTestNews()",100)
}
scrollTestNews();
{/literal}
</script>