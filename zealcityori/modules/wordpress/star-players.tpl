<div class="content_title">
	<div class="starplayer_icon"></div>
	<p>Star Players</p>
</div>
{foreach from=$starplayers item=post name=posts}
<div class="star_player_detail">
	{$post.content|truncate:400:"..."}
</div>
<div class="star_player_divider"></div>
{/foreach}
<a href="research-details.php"><div class="more score-more">MORE</div></a>