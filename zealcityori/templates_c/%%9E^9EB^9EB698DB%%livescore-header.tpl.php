<?php /* Smarty version 2.6.27, created on 2014-05-07 15:44:07
         compiled from F:%5Cxampp%5Chtdocs%5Czealcityori/modules/blocklivescore/livescore-header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'F:\\xampp\\htdocs\\zealcityori/modules/blocklivescore/livescore-header.tpl', 42, false),)), $this); ?>
<div class="live-match-cont">
	<div class="live-match-left" onmouseout="zeal.index.scrollTopTimer();" onmouseover="zeal.index.scrollRight(186,'live-match-center-inner', 1);"></div>
	<div class="live-match-center">
		<div class="live-match-center-inner">
			<?php $_from = $this->_tpl_vars['liveScores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['liveScores'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['liveScores']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['liveScore']):
        $this->_foreach['liveScores']['iteration']++;
?>
			<a href="http://www.cricville.com/fullscore/?id=<?php echo $this->_tpl_vars['liveScore']->match->id; ?>
" target="_blank">
			<div class="live-match-indiv live">
				<div class="inner">
					<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->batting->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['liveScore']->batting->teamname; ?>
" /></div>
					<div class="v-image-area"></div>
					<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['liveScore']->bowling->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['liveScore']->bowling->teamname; ?>
" /></div>
                    <?php if (isset ( $this->_tpl_vars['liveScore']->currentInnings )): ?>
					<div class="score-text">
						<div class="score"><b><?php echo $this->_tpl_vars['liveScore']->batting->team_nickname; ?>
</b>-<?php echo $this->_tpl_vars['liveScore']->score; ?>
/<?php echo $this->_tpl_vars['liveScore']->wickets; ?>
</div>
						<div class="overs">Overs : <?php echo $this->_tpl_vars['liveScore']->overs; ?>
</div>
					</div>
					<?php if (isset ( $this->_tpl_vars['liveScore']->innings[$this->_tpl_vars['bowlTeamId']][1]['score'] )): ?>
					<div class="clear"></div>
					<?php $this->assign('bowlTeamId', ($this->_tpl_vars['liveScore']->bowling->id)); ?>
					<?php echo $this->_tpl_vars['liveScore']->bowling->team_nickname; ?>
: <?php echo $this->_tpl_vars['liveScore']->innings[$this->_tpl_vars['bowlTeamId']][1]['score']; ?>
/<?php echo $this->_tpl_vars['liveScore']->innings[$this->_tpl_vars['bowlTeamId']][1]['wickets']; ?>

					<?php endif; ?>
                    <?php else: ?>
                    <div class="score-text score-text1">
	                    <div class="teams"><?php echo $this->_tpl_vars['liveScore']->batting->team_nickname; ?>
 V <?php echo $this->_tpl_vars['liveScore']->bowling->team_nickname; ?>
</div>
						<div class="match-details">Match Delayed</div>
					</div>
                    <?php endif; ?>
				</div>
			</div>
			</a>
			<script>zeal.index.scoreScroll++;</script>
			<?php endforeach; endif; unset($_from); ?>
			<?php $_from = $this->_tpl_vars['upcomingMatches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['upcomingMatches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['upcomingMatches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['upcomingMatch']):
        $this->_foreach['upcomingMatches']['iteration']++;
?>
			<!--<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details">-->
			<a href="http://www.cricville.com/fixtures/" target="_blank">
			<div class="live-match-indiv fixtures">
				<div class="inner">
					<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['upcomingMatch']['t1flag']; ?>
" alt="<?php echo $this->_tpl_vars['upcomingMatch']['teamname']; ?>
" /></div>
                    <div class="v-image-area"></div>
					<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['upcomingMatch']['t2flag']; ?>
" alt="<?php echo $this->_tpl_vars['upcomingMatch']['teamname']; ?>
" /></div>
					<div class="score-text score-text1">
						<div class="teams"><?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%A') : smarty_modifier_date_format($_tmp, '%A')); ?>
</div>
						<div class="match-details"><?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B') : smarty_modifier_date_format($_tmp, '%B')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['upcomingMatch']['match_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%e') : smarty_modifier_date_format($_tmp, '%e')); ?>
</div>
					</div>
				</div>
			</div>
			</a>
			<script>zeal.index.scoreScroll++;</script>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	</div>
	<div class="live-match-right" onmouseover="zeal.index.scrollLeft(186,'live-match-center-inner',1);" onmouseout="zeal.index.scrollTopTimer();"></div>
</div>