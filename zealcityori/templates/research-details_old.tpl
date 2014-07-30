<div class="research-details">
	<div class="left-container">
		<div class="research-menu">
			<ul>
				<li class="active" onclick="zeal.index.showContent('research-content', 'research-content', 1, this, 'research-menu')">Upcoming Matches</li>
				<li onclick="zeal.index.showContent('research-content', 'research-content', 2, this, 'research-menu')">Pitch Report</li>
				<li onclick="zeal.index.showContent('research-content', 'research-content', 3, this, 'research-menu')">Weather Report</li>
				<!--<li onclick="zeal.index.showContent('research-content', 'research-content', 4, this, 'research-menu')">Teams</li>-->
				<li onclick="zeal.index.showContent('research-content', 'research-content', 5, this, 'research-menu')">Teams</li>
				<!--<li onclick="zeal.index.showContent('research-content', 'research-content', 6, this, 'research-menu')">Completed Games</li>-->
				<li onclick="zeal.index.showContent('research-content', 'research-content', 7, this, 'research-menu')">Star Players</li>
				<li onclick="zeal.index.showContent('research-content', 'research-content', 8, this, 'research-menu')">Predictions</li>
				<li onclick="zeal.index.showContent('research-content', 'research-content', 9, this, 'research-menu')">Points Table</li>
				<!--<li onclick="zeal.index.showContent('research-content', 'research-content', 10, this, 'research-menu')">Schedule</li>-->
			</ul>
		</div>
		
	</div>
	<div class="right-container">
		<!--------------------------------------------------- Upcoming Matches -------------------------------------------------->
		<div class="upcoming-matches research-content" id="research-content1">
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-upcoming" class="addfunds hide" value="back" onclick="zeal.research.closeUpComingMatches();"/>
				<div class="match-details-title">Match Details</div>
				<div class="research-table research-table-upcoming">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large" >Ground</div>
								<div class="large" >City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$upcomingMatches item=match name=upcomingMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div style="float:left">
											<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
											<div class="v-image-area"></div>
											<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
										</div>
										<div class="clear"></div>
										<div class="upcoming-matches-indi-team1">
											{$match.team1}
										</div>
										<div class="upcoming-matches-indi-team2">
											{$match.team2}
										</div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.upComingMatches({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="rightcontext research-table-content research-table-content-upcoming" style="margin-left:100px;" id="research-upcomingmatches">					
				</div>
			</div>
		</div>
		<!--------------------------------------------------- Upcoming Matches -------------------------------------------------->
		<!--------------------------------------------------- Pitch Report -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content2" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-pitch" class="addfunds hide" value="back" onclick="zeal.research.closePitchReport();"/>
				<div class="content_title">
					<div class="pitchreport_img"></div>
					<p>Pitch report</p>
				</div>
				<div class="research-table-pitch">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.pitchReport({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="pitch_rep_detail research-table-content-pitch" id="pitch-report-post"></div>
			</div>
		</div>
		<!--------------------------------------------------- Pitch Report -------------------------------------------------->
		<!--------------------------------------------------- Weather Report -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content3" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-weather" class="addfunds hide" value="back" onclick="zeal.research.closeWeatherReport();"/>
				<div class="content_title">
					<div class="weather_img"></div>
					<p>Weather Report</p>
				</div>
				<div class="research-table-weather">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.weatherReport({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="weather_rep_detail research-table-content-weather" id="research-weather-report"></div>
			</div>
		</div>
		<!--------------------------------------------------- Weather Report -------------------------------------------------->
		<!--------------------------------------------------- Teams -------------------------------------------------->
		<!--<div class="Pitch-report research-content" id="research-content4" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-teams" class="addfunds hide" value="back" onclick="zeal.research.closeTeams();"/>
				<div class="content_title">
					<div class="weather_img"></div>
					<p>Teams</p>
				</div>
				<div class="research-table-teams">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.teams({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="rightcontext research-table-content-teams" id="research-teams" style="margin-left:100px;"></div>
			</div>
		</div>-->
		<!--------------------------------------------------- Teams -------------------------------------------------->
		<!--------------------------------------------------- Players -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content5" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-players" class="addfunds hide" value="back" onclick="zeal.research.closePlayers();"/>
				<div class="content_title">					
					<p>Teams</p>
				</div>
				<div class="research-table-players">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.players({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="rightcontext  research-table-content-players" id="research-players" style="margin-left:100px;">					
				</div>
			</div>
		</div>
		<!--------------------------------------------------- Players -------------------------------------------------->
		<!--------------------------------------------------- Completed Games -------------------------------------------------->
		<!--<div class="Pitch-report research-content" id="research-content6" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-comptd-games" class="addfunds hide" value="back" onclick="zeal.research.closeCompletedGames();"/>
				<div class="content_title">
					<p>Completed Games</p>
				</div>
				<div class="research-table-comptd-games">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$getPreviousMatches item=match name=getPreviousMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.completedGames({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="rightcontext  research-table-content-comptd-games" id="research-players" style="margin-left:100px;"></div>
			</div>
		</div>-->
		<!--------------------------------------------------- Completed Games -------------------------------------------------->
		<!--------------------------------------------------- Star Players -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content7" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-star-player" class="addfunds hide" value="back" onclick="zeal.research.closeStarPlayers();"/>
				<div class="content_title">
					<p>star Players</p>
				</div>
				<div class="research-table-star-player">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.starPlayers({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="pitch_rep_detail  research-table-content-star-player" id="research-star-player"></div>
			</div>
		</div>
		<!--------------------------------------------------- Star Players -------------------------------------------------->
		<!--------------------------------------------------- Prediction -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content8" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-prediction" class="addfunds hide" value="back" onclick="zeal.research.closePrediction();"/>
				<div class="content_title">
					<p>Prediction</p>
				</div>
				<div class="research-table-prediction">
					<div class="upcoming-matches-head">
						<div class="research-matches">
							<div class="research-table-head">
								<div class="medium">Date</div>
								<div class="large">Match</div>
								<div class="large">Ground</div>
								<div class="large">City</div>
								<div class="medium">View</div>
							</div>
							<div class="research-table-body">
								{foreach from=$recentMatches item=match name=recentMatches}
								<div class="upcoming-matches-indi">
									<div class="medium">{$match.match_date|date_format:"%D"}</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="{$imageurl}{$match.t1flag}" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="{$imageurl}{$match.t2flag}" alt=""></div>
									</div>
									<div class="large align-left">{$match.venue}</div>
									<div class="large align-left">{$match.city}</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.prediction({$match.id});"/></div>
								</div>
								{/foreach}
							</div>
						</div>
					</div>
				</div>
				<div class="pitch_rep_detail  research-table-content-prediction" id="research-prediction"></div>
			</div>
		</div>
		<!--------------------------------------------------- Prediction -------------------------------------------------->
		<!--------------------------------------------------- Points Table -------------------------------------------------->
		<div class="Pitch-report research-content" id="research-content9" style="display:none;">			
			<div class="upcoming-matches-body">
				<input type="button" id="research-back-prediction" class="addfunds hide" value="back" onclick="zeal.research.closePrediction();"/>
				<div class="content_title">
					<p>Champions Trophy Points Table</p>
				</div>
				<div class="research-table-prediction">
                	<div class="group-a">GROUP A</div>
					<div class="points-table-container">
						<div class="points-table-head point-table-cont">
							<div class="large">Team Name</div>
							<div class="medium">M</div>
							<div class="medium">Won</div>
							<div class="medium">Lost</div>
							<div class="medium">Tie</div>
							<div class="medium">No Result</div>
							<div class="medium">Points</div>
							<div class="medium">NRR</div>
						</div>
						{foreach from=$points item=point name=points}
                        	{if $point.group == 'A'}
                                <div class="points-table-body point-table-cont">
                                    <div class="large">{$point.team_name}</div>
                                    <div class="medium">{$point.total_match_played}</div>
                                    <div class="medium">{$point.won}</div>
                                    <div class="medium">{$point.lost}</div>
                                    <div class="medium">{$point.tie}</div>
                                    <div class="medium">{$point.no_result}</div>
                                    <div class="medium">{$point.points}</div>
                                    <div class="medium">{$point.net_run_rate}</div>
                                </div>
							{/if}
						{/foreach}
					</div>
                    <div class="group-a">GROUP B</div>
                    <div class="points-table-container">
                        <div class="points-table-head point-table-cont">
                            <div class="large">Team Name</div>
                            <div class="medium">M</div>
                            <div class="medium">Won</div>
                            <div class="medium">Lost</div>
                            <div class="medium">Tie</div>
                            <div class="medium">No Result</div>
                            <div class="medium">Points</div>
                            <div class="medium">NRR</div>
                        </div>
                        {foreach from=$points item=point name=points}
                            {if $point.group == 'B'}
                                <div class="points-table-body point-table-cont">
                                    <div class="large">{$point.team_name}</div>
                                    <div class="medium">{$point.total_match_played}</div>
                                    <div class="medium">{$point.won}</div>
                                    <div class="medium">{$point.lost}</div>
                                    <div class="medium">{$point.tie}</div>
                                    <div class="medium">{$point.no_result}</div>
                                    <div class="medium">{$point.points}</div>
                                    <div class="medium">{$point.net_run_rate}</div>
                                </div>
                            {/if}
                        {/foreach}
					</div>	
				</div>
			</div>
		</div>
		<!--------------------------------------------------- Points Table -------------------------------------------------->
	</div>
</div>