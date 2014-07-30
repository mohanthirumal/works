<div class="index-discursion">
	<div class="live-score-menu tournament-tab">
		<ul>
			<li class="active" onclick="zeal.index.showContent('index-research-main', 'content-main', 2, this, 'tournament-tab')">News</li>
			<!--<li onclick="zeal.index.showContent('index-research-main', 'content-main', 1, this, 'tournament-tab')">Research</li>			-->
			<li onclick="zeal.index.showContent('index-research-main', 'content-main', 4, this, 'tournament-tab')">Blogs</li>
		</ul>
	</div>
	<div class="index-research-main" id="content-main1" style="display:none;">
		<div class="index-discussion-tab">
			<div class="index-discussion-tab-inner" onclick="zeal.index.showContent('research-index', 'content', 1, this, 'tournament-tab')">
				<div class="star-player"></div>
				<div>Star Players</div>
			</div>
			<div class="index-discursion-divider"></div>
			<div class="index-discussion-tab-inner pitch-condition-tab" onclick="zeal.index.showContent('research-index', 'content', 2, this, 'tournament-tab')">
				<div class="pitch-condition"></div>
				<div>Pitch Condition</div>
			</div>
			<div class="index-discursion-divider"></div>
			<div class="index-discussion-tab-inner weather-report-tab" onclick="zeal.index.showContent('research-index', 'content', 3, this, 'tournament-tab')">
				<div class="weather-report"></div>
				<div>Weather Report</div>
			</div>
			<!--<div class="index-discursion-divider"></div>
			<div class="index-discussion-tab-inner head-to-head-tab" onclick="zeal.index.showContent('research-index', 'content', 4, this, 'tournament-tab')">
				<div class="head-to-head"></div>
				<div>Pro's Corner</div>
			</div>-->
			<div class="index-discursion-divider"></div>
			<div class="index-discussion-tab-inner weather-report-tab" onclick="zeal.index.showContent('research-index', 'content', 5, this, 'tournament-tab')">
				<div class="previous-matches"></div>
				<div>Previous Matches</div>
			</div>
		</div>
		<div class="row-divider"></div>
		<!--------------------------------------------- Star Players : start ------------------------------------------------------>
		<div class="research-index" id="content1">
			{foreach from=$starPlayers item=starPlayer name=starPlayers}
			<div class="star-player-container">
				<div class="star-player-desc">
					{$starPlayer.content|truncate:400:"..."}
				</div>
			</div>
			<div class="row-divider"></div>
			{/foreach}
			<div class="star-player-container">
				<a href="{$base_dir}research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Star Players : END ------------------------------------------------------>
		<!--------------------------------------------- Pitch Condition : start ------------------------------------------------------>
		<div class="research-index" id="content2" style="display:none">
			<div class="research-index-inner">
			{$pitchCondition|truncate:1300:"..."}
			</div>
			<div class="row-divider"></div>
			<div class="star-player-container">
				<a href="{$base_dir}research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Pitch Condition : END ------------------------------------------------------>
		<!--------------------------------------------- Weather Report : start ------------------------------------------------------>
		<div class="research-index" id="content3" style="display:none">
			<div class="research-index-inner">
			{$weatherReport|truncate:1300:"..."}
			</div>
			<div class="row-divider"></div>
			<div class="star-player-container">
				<a href="{$base_dir}research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Weather Report : ENDS ------------------------------------------------------>
		<!--------------------------------------------- Pros Corner : ENDS ------------------------------------------------------>
		<div class="research-index" id="content4" style="display:none">
			{foreach from=$prosCorners item=prosCorner name=prosCorners}
			<div class="star-player-container">
				<div class="star-player-desc">
					{$prosCorner.content|truncate:450:"..."}
				</div>
			</div>
			<div class="row-divider"></div>
			{/foreach}
			<div class="star-player-container">
				<a href="{$base_dir}research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Pros Corner : ENDS ------------------------------------------------------>
		<!--------------------------------------------- Previous Match : STARTS ------------------------------------------------------>
		<div class="research-index" id="content5" style="display:none">
			<div class="research-index-inner">
			{$PREVIOUSMATCH}
			</div>
		</div>
		<!--------------------------------------------- Previous Match : ENDS ------------------------------------------------------>
	</div>
	<div class="index-research-main" id="content-main2">
		{foreach from=$news item=prosCorner name=news}
		<div class="star-player-container">
			<div class="star-player-desc">
				<a href="{$base_dir}blog/?p={$prosCorner.id}"><img src="{$prosCorner.thumb}" alt=""/></a>
				<a href="{$base_dir}blog/?p={$prosCorner.id}">{$prosCorner.title|truncate:450:"..."}</a>
			</div>
		</div>
		<div class="row-divider"></div>
		{/foreach}
		<div class="star-player-container">
			<a href="{$base_dir}research"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
		</div>
	</div>
	<!--<div class="index-research-main" id="content-main3" style="display:none;">
		{foreach from=$prosCorners item=prosCorner name=prosCorners}
		<div class="star-player-container">
			<div class="star-player-desc">
				{$prosCorner|truncate:450:"..."}
			</div>
		</div>
		<div class="row-divider"></div>
		{/foreach}
		<div class="star-player-container">
			<input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/>
		</div>
	</div>-->
	<div class="index-research-main" id="content-main4" style="display:none;">
		{foreach from=$blogs item=prosCorner name=blogs}
		<div class="star-player-container">
			<div class="star-player-desc">
				<a href="{$base_dir}blog/?p={$prosCorner.id}"><img src="{$prosCorner.thumb}" alt=""/></a>
				<a href="{$base_dir}blog/?p={$prosCorner.id}">{$prosCorner.title|truncate:450:"..."}</a>
			</div>
		</div>
		<div class="row-divider"></div>
		{/foreach}
		<div class="star-player-container">
			<a href="{$base_dir}research"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
		</div>
	</div>
</div>