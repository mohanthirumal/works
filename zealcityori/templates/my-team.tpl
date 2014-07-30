<div class="myteam" id="myteam">
	<div style="padding:10px; background-color:#EBEBEB; font-weight:bold; font-size:18px; margin:10px 0 10px 0;">
    	<div style="float:left">{$tournament->name}</div>
        <div style="text-align:right;">Status - {$tournament->status}</div>
    </div>
	<div class="live-score-menu">
		<ul>
        	{if $tournament->tournament_type_id == 1 || $tournament->tournament_type_id == 3}
        		<a href="{$base_dir}tournament"><div class="tournament-back-icon"></div></a>
			{else}
            	<a href="{$base_dir}my-period-tournament-details/{$tournament->tournament_type_id}-type/{$tournament->id}"><div class="tournament-back-icon"></div></a>
			{/if}
			<li class="active" onclick="zeal.index.showContent('myteam-list', 'myteam', 1, this, 'live-score-menu')">My Team</li>
			{if $tournament->tournament_type_id == 1 || $tournament->tournament_type_id == 3}
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 2, this, 'live-score-menu')">Tournament Details</li>
			{/if}
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 3, this, 'live-score-menu')">Result</li>
		</ul>		
		<div style="float:right; margin:10px 10px 0 0;">
			<div>No.of.Changes : {$myTournament.no_of_changes}/{$tournament->no_of_changes}
                {if $enableedit}
				{if $tournament->tournament_type_id == 1 || $tournament->tournament_type_id == 3}
					<a href="{$base_dir}my-tournament/{$tournament->tournament_type_id}-type/{$tournament->id}/0">Edit</a>
				{else}
					<a href="{$base_dir}my-tournament/{$tournament->tournament_type_id}-type/{$tournament->id}/{$match->id}">Edit</a>
				{/if}
                {/if}
            </div>
        </div>        
	</div>
	<div id="myteam1" class="myteam-list">		
		{include file='my-team-list.tpl'}
	</div>
	<div id="myteam2" class="myteam-list" style="display:none;">
		<div class="myteam-body">
			<div class="myteam-tour-details">
				<div class="myteam-tour-details-inner">
					<div class="live-match-indiv fixtures" style="margin-left:100px;">
						<div class="flag"><img src="{$imageurl}{$match->team1Details->flag_url}" alt="{$match->team1Details->teamname}" /></div>
						<div class="v-image-area"></div>
						<div class="flag"><img src="{$imageurl}{$match->team2Details->flag_url}" alt="{$match->team2Details->teamname}" /></div>
					</div>
					<div class="tour-detail-label">Tournament Name:</div>
					<div class="tour-detail-label"><b>{$tournament->name}</b></div>
					<div class="tour-detail-label">Type:</div>
					<div class="tour-detail-label"><b>{$match->type}</b></div>
					<div class="tour-detail-label">Tournament ID:</div>
					<div class="tour-detail-label"><b>{$tournament->id}</b></div>
					<div class="tour-detail-label">Entry Fee:</div>
					<div class="tour-detail-label"><b><span class="WebRupee">Rs.</span>{$tournament->entry_fee}</b></div>
					<div class="tour-detail-label">Players:</div>
					<div class="tour-detail-label"><b>{$tournament->joinPlayers}/{$tournament->players}</b></div>
				</div>
			</div>
		</div>
	</div>
	<div id="myteam3" class="myteam-list" style="display:none;">
		{include file='my-team-result.tpl'}
	</div>
</div>