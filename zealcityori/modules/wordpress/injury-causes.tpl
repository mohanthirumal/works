<div class="injury_causes">
	<div class="title">
		<p>Injury Causes</p>
	</div>
	{foreach from=$proscorner item=post name=posts}
	<div class="cause1">
		<div class="injure_detail">
			{$post|truncate:300:"..."}
		</div>
	</div>
	{/foreach}
	<div class="title1"><a href="research-details.php" style="border:0; margin:0;"><div class="more score-more" style="margin:3px 5px 0 0;">MORE</div></a></div>
</div>