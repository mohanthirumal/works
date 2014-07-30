<div class="content_title">
	<div class="pro_img"></div>
	<p>Pro's Corner</p>
</div>
{foreach from=$proscorner item=post name=posts}
<div class="pro_player_detail">
	{$post|truncate:400:"..."}
</div>
<div class="star_player_divider"></div>
{/foreach}
<a href="research-details.php"><div class="more score-more">MORE</div></a>