<?php /* Smarty version 2.6.27, created on 2014-04-11 12:16:23
         compiled from research-details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'research-details.tpl', 38, false),)), $this); ?>
<div class="research-details">
	<div class="left-container" style="background-color:#fff">
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
				<!--<li onclick="zeal.index.showContent('research-content', 'research-content', 9, this, 'research-menu')">Points Table</li>
				<!--<li onclick="zeal.index.showContent('research-content', 'research-content', 10, this, 'research-menu')">Schedule</li>-->
			</ul>
		</div>
		
	</div>
	<div class="right-container" style="background-color:#fff">
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
								<?php $_from = $this->_tpl_vars['upcomingMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['upcomingMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['upcomingMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['upcomingMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div style="float:left">
											<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
											<div class="v-image-area"></div>
											<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
										</div>
										<div class="clear"></div>
										<div class="upcoming-matches-indi-team1">
											<?php echo $this->_tpl_vars['match']['team1']; ?>

										</div>
										<div class="upcoming-matches-indi-team2">
											<?php echo $this->_tpl_vars['match']['team2']; ?>

										</div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.upComingMatches(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.pitchReport(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.weatherReport(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.teams(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.players(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['getPreviousMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['getPreviousMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['getPreviousMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['getPreviousMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.completedGames(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.starPlayers(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
								<?php $_from = $this->_tpl_vars['recentMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recentMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recentMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['recentMatches']['iteration']++;
?>
								<div class="upcoming-matches-indi">
									<div class="medium"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</div>
									<div class="large">
										<div class="flag" style="margin-left:30px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt=""></div>
										<div class="v-image-area"></div>
										<div class="flag" style="margin-left:-5px;"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt=""></div>
									</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['venue']; ?>
</div>
									<div class="large align-left"><?php echo $this->_tpl_vars['match']['city']; ?>
</div>
									<div class="medium"><input type="button" class="addfunds" value="View" style="margin:10px 0 0 30px" onclick="zeal.research.prediction(<?php echo $this->_tpl_vars['match']['id']; ?>
);"/></div>
								</div>
								<?php endforeach; endif; unset($_from); ?>
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
					<p>Tri Nation Series Points Table</p>
				</div>
				<div class="research-table-prediction">
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
						<?php $_from = $this->_tpl_vars['points']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['points'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['points']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['point']):
        $this->_foreach['points']['iteration']++;
?>
                                <div class="points-table-body point-table-cont">
                                    <div class="large"><?php echo $this->_tpl_vars['point']['team_name']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['total_match_played']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['won']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['lost']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['tie']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['no_result']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['points']; ?>
</div>
                                    <div class="medium"><?php echo $this->_tpl_vars['point']['net_run_rate']; ?>
</div>
                                </div>
						<?php endforeach; endif; unset($_from); ?>
					</div>
				</div>
			</div>
		</div>
		<!--------------------------------------------------- Points Table -------------------------------------------------->
	</div>
</div>