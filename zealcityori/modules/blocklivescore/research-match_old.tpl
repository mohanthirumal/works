<div class="rightcontext">
	<div class="content_title">
		<p>Match Details</p>
	</div>
	<div class="team1">
		<img src="{$imageurl}{$researchmatch->team1Details->flag_url}" class="team1_img" />
		<div class="team_name">{$researchmatch->team1Details->teamname}</div>
	</div>            
	<div class="versus_img"></div>
	<div class="team1">
		<img src="{$imageurl}{$researchmatch->team2Details->flag_url}" class="team1_img" />
		<div class="team_name">{$researchmatch->team2Details->teamname}</div>
	</div>   
	<div class="match_detail">
		<table id="match_detail_table" border="1"  width="290" cellpadding="5">
			<tr>
				<td align="right" style="color:#686868;">Match :</td>
				<td style="text-indent:3px; font-weight:bold;">{$researchmatch->tour->tournament_name}, {$researchmatch->match_name}</td>
			</tr>
			<tr>
				<td align="right" style="color:#686868;">Venue :</td>
				<td style="text-indent:3px; font-weight:bold;">{$researchmatch->venue->venue}</td>
			</tr>
			<tr>
				<td align="right" style="color:#686868;">Type :</td>
				<td style="text-indent:3px; font-weight:bold;">{$researchmatch->type}</td>
			</tr>
			<tr>
				<td align="right" style="color:#686868;">Start Date :</td>
				<td style="text-indent:3px; font-weight:bold;">{$researchmatch->match_date|date_format:"%D"}</td>
			</tr>
		</table>
	</div>
	<div class="match-details-advance">
		<a href="research-details"><div class="weather_img"></div></a>
		<a href="research-details"><div class="pitchreport_img"></div></a>
		<a href="research-details"><div class="starplayer_icon"></div></a>
	</div>
	<a href="{$base_dir}tournament"><div class="full_score_btn" style="cursor:pointer;">View Tournament</div></a>
</div>