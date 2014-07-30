<div class="content_title">
	<p>News</p>
</div>
{foreach from=$news item=post name=posts}
<div class="star_player_detail">
	<a href="{$base_dir}blog/?p={$post.id}"><img src="{$post.thumb}" alt=""/></a>
	<a href="{$base_dir}blog/?p={$post.id}" style="text-decoration:none; color:#000;">{$post.title|truncate:500:"..."}</a>
</div>
<div class="star_player_divider"></div>
{/foreach}
<a href="{$base_dir}blog/?cat={$catid}"><div class="more score-more">MORE</div></a>