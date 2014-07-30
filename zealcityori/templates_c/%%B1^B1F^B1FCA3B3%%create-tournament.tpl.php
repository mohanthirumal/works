<?php /* Smarty version 2.6.27, created on 2014-04-18 13:53:27
         compiled from create-tournament.tpl */ ?>
<div class="createTournamentContent">
	<div class="createTournamentRightcontent">
		<div class="createTournamentmainContent">
			<div class="createTournamentTitleContent">
				<div class="createTournamentTitle">Create Tournament</div>
			</div>
            <form method="post" id="createtournament" onsubmit="return false;">
                <div class="main-tournament-content">
                    <div class="inner-tournament-content">
                        <div class="tournament-values">Tournament name:</div>
                        <div class="tournament-values"><input type="text" name="tournamentName" id="tournamentName" class="tboxsize" value="" /></div>
                        <div class="setClassContent">
                        <div class="tournament-values">Type:</div>
                            <div class="tournament-values">
                                <div class="fill-Content">
                                    <div class="styled-select-one">
                                    	<select name="type" id="type" class="sboxsize" onchange="zeal1.tournament.changeType()">
                                            <option value="0">---- Select -----</option>
                                            <option value="3">Daily</option>
                                            <option value="7">Weekly</option>
                                            <option value="8">Series</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="setClassContent week-series hide">
                            <div class="tournament-values">Choose week:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
                                     <select name="weekly" id="weekly" class="sboxsize" onchange="zeal1.tournament.changeWeek()">
                                            <option value="0">---- Select -----</option>
                                             <?php $_from = $this->_tpl_vars['weeks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['weeks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['weeks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['week']):
        $this->_foreach['weeks']['iteration']++;
?>
                                            <option value="<?php echo $this->_foreach['weeks']['iteration']; ?>
"><?php echo $this->_tpl_vars['week']; ?>
</option>
                                             <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                                <!--<input list="browsers" name="browser">-->
                            </div>
                        </div>
                        <div class="setClassContent week-series hide">
                            <div class="tournament-values">No of Matches:</div>
                            <div class="tournament-values"  style="text-align:left; text-indent: 15px;">
                            	<label class="tboxsize" id="matchCount" name="matchCount"></label>
                            </div>
						</div>
                            
                        <div class="setClassContent daily-match hide" >
                            <div class="tournament-values ">Schedule:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
                                	<select name="match" id="match" class="sboxsize" >
                                        <option value="0">---- Select ----</option>
                                        <?php $_from = $this->_tpl_vars['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
                                        <option value="<?php echo $this->_tpl_vars['match']['id']; ?>
"><?php echo $this->_tpl_vars['match']['t1name']; ?>
 Vs <?php echo $this->_tpl_vars['match']['t2name']; ?>
 - <?php echo $this->_tpl_vars['match']['match_name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
								</div>
                                <!--<input list="browsers" name="browser">-->
                            </div>
                        </div>
                        <div class="setClassContent series-list hide" >
                            <div class="tournament-values ">Series:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
                                	<select name="series" id="series" class="sboxsize" onchange="zeal1.tournament.seriesMatch()">
                                        <option value="0">---- Select -----</option>
                                        <?php $_from = $this->_tpl_vars['series']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['series'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['series']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['serie']):
        $this->_foreach['series']['iteration']++;
?>
                                            <option value="<?php echo $this->_tpl_vars['serie']['id']; ?>
"><?php echo $this->_tpl_vars['serie']['tournament_name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                                <!--<input list="browsers" name="browser">-->
                            </div>
                        </div>
                        <div class="setClassContent week-match hide">
                            <div class="tournament-values">Schedule:</div>
                            <div class="schedule-values">
                                <div class="inner-content-schedule week-shedule">
                                </div>
                                <div style="float:left; width:90%;">
                                        <div class="more-class-content hide" onclick="$('.main-class-cotant').show();$(this).hide();">More</div>
                                </div>
                            </div>
                        </div>
						<div class="setClassContent">
                            <div class="tournament-values">Entry Fee:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
                                    <select name="entryfee1" id="entryfee1" class="sboxsize" onchange="zeal1.tournament.updatePrizeList($('#players'));">
                                        <option value="0">---- Select -----</option>
                                        <?php $_from = $this->_tpl_vars['entryfee']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['entryfee'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['entryfee']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['entryfee']):
        $this->_foreach['entryfee']['iteration']++;
?>
                                            <option value="<?php echo $this->_tpl_vars['entryfee']['id']; ?>
"><?php echo $this->_tpl_vars['entryfee']['amount']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
								</div>
                            </div>
                        </div>
						<div class="setClassContent" id="player-container">
                            <div class="tournament-values">Player:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
                                    <select name="players" id="players" class="sboxsize" onchange="zeal1.tournament.updatePrizeList(this);">
                                        <?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['players'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['players']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['player']):
        $this->_foreach['players']['iteration']++;
?>
                                            <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['display_name']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
								</div>
                            </div>
                        </div>
                        <div class="setClassContent prize-box hide">
                            <div class="tournament-values">Prizes:</div>
                            <div class="schedule-values">
                                <div class="inner-content-schedule prize-list-container" style="min-height:90px;">
                                    <!--<div class="fix-content-border">
                                        <div class="first-class-content first">1st</div>
                                        <div class="price-content">Rs 100</div>
                                    </div>
                                    <div class="fix-content-border">
                                        <div class="first-class-content second">2nd</div>
                                        <div class="price-content">Rs 100</div>
                                    </div>
                                    <div class="fix-content-border">
                                        <div class="first-class-content third">3rd</div>
                                        <div class="price-content">Rs 100</div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
						<!--<div class="setClassContent" id="player-container">
                            <div class="tournament-values">Private:</div>
                            <div class="tournament-values">
                            	<div class="styled-select-one">
									<input type="checkbox" name="privatetour" value="1" class="chckbox-private-tour"/>(only invited friends can join)
								</div>
                            </div>
                        </div>-->
                    </div>
                    <input type="button" class="submit-class-content" value="Create" onclick="createtournamentValidate();"/>
                    <input type="hidden" value="<?php echo $this->_tpl_vars['cash1']; ?>
" name="userCash" id="userCash"/>
					<input type="hidden" value="createteam" name="action"/>
                </div>
            </form>
		</div>
	</div>
    <div class="success-dialog invite-dialog hide" id="invite-dialog">
        <div class="createTournamentTitleContent" style="margin-bottom: 30px;">
            <div class="createTournamentTitle popup-title">Create Tournament</div>
            <div class="close-btn" onclick="zeal1.tournament.cancelCreate()"></div>
        </div>
        <div class="invite-text">Do you want to create this tournament and <br/> invite your friends?</div>
        <div class="invite-text" style="font-size:12px;">Please note: You will automatically join in any <br/> tournament you create</div>
        <div class="sub-canbtn">
            <div class="create-submit" style="float:left;" onclick="zeal.jQuery(this).hide();zeal1.tournament.confirmCreate();">Create</div>
            <div class="create-submit" onclick="zeal1.tournament.cancelCreate()">Cancel</div>
        </div>
    </div> 
    <div class="success-dialog deposit-dialog hide" id="deposit-dialog">
        <div class="createTournamentTitleContent" style="margin-bottom: 30px;">
            <div class="createTournamentTitle popup-title">Create Tournament</div>
            <div class="close-btn" onclick="zeal1.tournament.cancelCreate()"></div>
        </div>
        <div class="invite-text">Oops it seems you dont have enough<br/> money to create this tournament. Would <br/>you like to deposit cash in order to create<br/> this tournament.</div>
        <div class="sub-canbtn">
            <a href="<?php echo $this->_tpl_vars['base_dir']; ?>
deposit"><div class="create-submit" id="depositId1" style="float:left;">Deposit</div></a>
            <div class="create-submit" onclick="zeal1.tournament.cancelCreate()">Cancel</div>
        </div>
    </div>
	
    <div class="success-dialog invite-dialog hide" id="invite-dialog3">
        <div class="createTournamentTitleContent" style="margin-bottom: 30px;">
            <div class="createTournamentTitle popup-title" id="popup-titleId">Error</div>
            <div class="close-btn" onclick="zeal1.tournament.cancelCreate()"></div>
        </div>
        <div class="invite-text" id="invite-textId"></div>
        <div class="sub-canbtn" style="width:150px; margin:0 0 15px 120px">
           <div class="create-submit" id="create-submitId" onclick="zeal1.tournament.cancelCreate()">Ok</div>
        </div>
    </div> 
	
	
	
</div>
<script>zeal1.tournament.flagUrl = '<?php echo $this->_tpl_vars['imageurl']; ?>
';</script>