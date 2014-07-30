<?php /* Smarty version 2.6.27, created on 2014-06-20 11:42:32
         compiled from F:%5Cxampp%5Chtdocs%5Czealcityori/modules/blocklivescore/livescore-sidebar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'F:\\xampp\\htdocs\\zealcityori/modules/blocklivescore/livescore-sidebar.tpl', 72, false),array('modifier', 'date_format', 'F:\\xampp\\htdocs\\zealcityori/modules/blocklivescore/livescore-sidebar.tpl', 73, false),)), $this); ?>
  <!-- Live score widget new Box start--> 
<div class="live-score-widjet">
	<div class="live-score-menu rightscore">
		<ul>
			<?php if ($this->_tpl_vars['liveScores']): ?>
			<li class="active" onclick="zeal.index.showContent('match-score', 'livescore', 1, this, 'rightscore')">Live Scores</li>
			<?php endif; ?>
			<li<?php if (! $this->_tpl_vars['liveScores']): ?> class="active" <?php endif; ?> onclick="zeal.index.showContent('match-score', 'livescore', 2, this, 'rightscore')">Fixtures</li>
			<li onclick="zeal.index.showContent('match-score', 'livescore', 3, this, 'rightscore')">Results</li>
		</ul>
	</div>
	<?php if ($this->_tpl_vars['liveScores']): ?>
	<div class="match-score" id="livescore1">
		<?php $_from = $this->_tpl_vars['liveScores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['liveScores'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['liveScores']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['liveScore']):
        $this->_foreach['liveScores']['iteration']++;
?>
			<a href="http://www.cricville.com/fullscore/?id=<?php echo $this->_tpl_vars['liveScore']->match->id; ?>
" target="_blank">
                <div class="match-score-indivi<?php if (( $this->_foreach['liveScores']['iteration'] > 1 )): ?> hide<?php endif; ?>" id="livescoreindi<?php echo $this->_foreach['liveScores']['iteration']; ?>
">
                    <div class="linetop"></div>
					<div style="height:20px; width:100%; float:left;"></div>
                    <div class="venue"><?php echo $this->_tpl_vars['liveScore']->batting->teamname; ?>
 Vs <?php echo $this->_tpl_vars['liveScore']->bowling->teamname; ?>
, <?php echo $this->_tpl_vars['liveScore']->match->match_name; ?>
 at</div>
                    <div class="venue"><?php echo $this->_tpl_vars['liveScore']->match->venue->venue; ?>
 <?php echo $this->_tpl_vars['liveScore']->match->venue->city; ?>
</div>
					<div style="height:20px; width:100%; float:left;"></div>
                    <div class="flagarea"<?php if (! isset ( $this->_tpl_vars['liveScore']->currentInnings )): ?> style="margin-left:65px;"<?php endif; ?>>
                        <img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->batting->flag_url; ?>
" alt="" class="team1-flag"/><br />
                        <?php echo $this->_tpl_vars['liveScore']->batting->teamname; ?>

                    </div>
                    <div class="vs-area"><img src="images/vs_img.png" class="versus"/></div>
                    <div class="flagarea">
                        <img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->bowling->flag_url; ?>
" alt="" class="team1-flag"/><br />
                        <?php echo $this->_tpl_vars['liveScore']->bowling->teamname; ?>

                    </div>
                    <?php if (isset ( $this->_tpl_vars['liveScore']->currentInnings )): ?>
                    <div class="team1-score-area"><div class="team1-score"><?php echo $this->_tpl_vars['liveScore']->batting->team_nickname; ?>
:<?php echo $this->_tpl_vars['liveScore']->score; ?>
/<?php echo $this->_tpl_vars['liveScore']->wickets; ?>
</div></div>   	                                                                   
                    <div class="totalovers"><?php echo $this->_tpl_vars['liveScore']->overs; ?>
 overs</div>
                    <?php endif; ?>
                    <div class="match-score-status"><?php if (isset ( $this->_tpl_vars['liveScore']->status )): ?><?php echo $this->_tpl_vars['liveScore']->status; ?>
<?php endif; ?></div>
					<div style="height:20px; width:100%; float:left;"></div>                    
                </div>
			</a>
		<?php endforeach; endif; unset($_from); ?>
		<div class="livescore-list">
		<div class="linetop"></div>
			<img  src="images/ARROW_left.png" class="left-move" onclick="zeal.sidebar.scrollRight(100, 'sidebar-scorecard-nav-inner');"/>
			<div class="sidebar-scorecard-nav">
				<div class="sidebar-scorecard-nav-inner">
					<?php $_from = $this->_tpl_vars['liveScores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['liveScores'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['liveScores']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['liveScore']):
        $this->_foreach['liveScores']['iteration']++;
?>
					<div class="vert-line"></div>
					<div class="other-livematch1" onclick="zeal.index.showContent('match-score-indivi', 'livescoreindi', <?php echo $this->_foreach['liveScores']['iteration']; ?>
,this,'')">
						<img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->batting->flag_url; ?>
" alt="" class="otherlive-team1-flag"/>
						<img src="images/vs_img.png" class="other-versus"/>
						<img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->bowling->flag_url; ?>
" alt="" class="otherlive-team2-flag"/>
					</div>
					<script>zeal.sidebar.scoreScroll++;</script>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			</div>
			<div class="vert-line"></div>
			<img  src="images/ARROW_RIGHT.png" class="right-move" onclick="zeal.sidebar.scrollLeft(100, 'sidebar-scorecard-nav-inner');"/>
		</div>
	 </div>
	 <?php endif; ?>
	 <div class="match-score <?php if ($this->_tpl_vars['liveScores']): ?> hide<?php endif; ?>" id="livescore2">
	 	<div class="index-fixtures-cont">
		<?php if ($this->_tpl_vars['upcomingMatches']): ?>
		<?php $_from = $this->_tpl_vars['upcomingMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['upcomingMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['upcomingMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['upcomingMatch']):
        $this->_foreach['upcomingMatches']['iteration']++;
?>
		<div class="index-fixtures-indi">
			<div class="index-fixtures-left">
				<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['upcomingMatch']['t1flag']; ?>
" alt="<?php echo $this->_tpl_vars['upcomingMatch']['teamname']; ?>
" /></div>
				<div class="v-image-area"></div>
				<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['upcomingMatch']['t2flag']; ?>
" alt="<?php echo $this->_tpl_vars['upcomingMatch']['teamname']; ?>
" /></div>
			</div>
			<div class="index-fixtures-right">
				<b><?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['team1'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 V <?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['team2'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 - <?php echo $this->_tpl_vars['upcomingMatch']['match_name']; ?>
</b><br/>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B') : smarty_modifier_date_format($_tmp, '%B')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%e') : smarty_modifier_date_format($_tmp, '%e')); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['date']['time']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['date']['time'])); ?>
 IST
			</div>
		</div>
		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<div class="match-score-indi" style="height:120px; line-height:120px; text-align:center;">
			<b>No Matches</b>
		</div>
		<?php endif; ?>
		<div class="match-score-indi even last"><a href="http://www.cricville.com/fixtures/" target="_blank"><input type="button" class="more score-more" value="MORE" /></a></div>
		</div>
	</div>
	 <div class="match-score hide" id="livescore3">
	 	<div class="index-fixtures-cont">
	 	<?php if ($this->_tpl_vars['resultMatches']): ?>
		<?php $_from = $this->_tpl_vars['resultMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['resultMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['resultMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['resultMatch']):
        $this->_foreach['resultMatches']['iteration']++;
?>
		<a href="http://www.cricville.com/fullscore/?id=<?php echo $this->_tpl_vars['resultMatch']->match->id; ?>
" target="_blank">
		<div class="index-fixtures-indi">
			<div class="index-fixtures-left">
				<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['resultMatch']->batting->flag_url; ?>
" alt="" /></div>
				<div class="v-image-area"></div>
				<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['resultMatch']->bowling->flag_url; ?>
" alt="" /></div>
			</div>
			<div class="index-fixtures-right">
				<b><?php echo ((is_array($_tmp=$this->_tpl_vars['resultMatch']->batting->team_nickname)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
 V <?php echo ((is_array($_tmp=$this->_tpl_vars['resultMatch']->bowling->team_nickname)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</b><br/>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['resultMatch']->match->match_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B') : smarty_modifier_date_format($_tmp, '%B')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['resultMatch']->match->match_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%e') : smarty_modifier_date_format($_tmp, '%e')); ?>
 - 
				<?php if ($this->_tpl_vars['resultMatch']->match->won_team_id == $this->_tpl_vars['resultMatch']->batting->id): ?>
					<?php echo $this->_tpl_vars['resultMatch']->batting->team_nickname; ?>
 won the match
				<?php elseif ($this->_tpl_vars['resultMatch']->match->won_team_id == 0): ?>
					<?php echo $this->_tpl_vars['resultMatch']->match->resultstatus; ?>

				<?php else: ?>
					<?php echo $this->_tpl_vars['resultMatch']->bowling->team_nickname; ?>
 won the match
				<?php endif; ?>
			</div>
		</div>
		</a>
		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<div class="match-score-indi" style="height:120px; line-height:120px; text-align:center;">
			<b>No Matches</b>
		</div>
		<?php endif; ?>
		</div>
		<div class="match-score-indi even last"><a href="http://www.cricville.com/results/" target="_blank"><input type="button" class="more score-more" value="MORE" /></a></div>
	 </div>
</div>
<!-- Live score widget new Box END--> 