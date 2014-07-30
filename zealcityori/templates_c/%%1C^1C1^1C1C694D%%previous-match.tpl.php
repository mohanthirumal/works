<?php /* Smarty version 2.6.27, created on 2014-04-11 12:16:30
         compiled from F:%5Cxampp%5Chtdocs%5Czealcityori/modules/blocklivescore/previous-match.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'F:\\xampp\\htdocs\\zealcityori/modules/blocklivescore/previous-match.tpl', 14, false),array('modifier', 'string_format', 'F:\\xampp\\htdocs\\zealcityori/modules/blocklivescore/previous-match.tpl', 14, false),)), $this); ?>
<div class="rightcontext previous-match">
	<div class="content_title">
		<div class="prevmatch_img"></div>
		<p>Previous Matches</p>
	</div>
	<?php if (isset ( $this->_tpl_vars['previous'] )): ?>
	<?php $_from = $this->_tpl_vars['previous']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matches'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matches']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['match']):
        $this->_foreach['matches']['iteration']++;
?>
	<a href="http://www.cricville.com/fullscore/?id=<?php echo $this->_tpl_vars['match']['match_id']; ?>
" target="_blank">
	<div class="prev_match1">
		<div class="prev_match_team1"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t1flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t1name']; ?>
" /></div>		
		<div class="score_detail">
			<?php if ($this->_tpl_vars['match']['t1score']): ?>
			<div class="prev_score"><?php echo $this->_tpl_vars['match']['t1score']; ?>
/<?php echo $this->_tpl_vars['match']['t1wickets']; ?>
</div>
			<?php $this->assign('overnum', ((is_array($_tmp=((is_array($_tmp=".")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['match']['t1overs']/6) : explode($_tmp, $this->_tpl_vars['match']['t1overs']/6)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f"))); ?>
			<div class="prev_over"><?php echo $this->_tpl_vars['overnum'][0]; ?>
.<?php echo $this->_tpl_vars['match']['t1overs']%6; ?>
 ov</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['match']['t3score']): ?>
			<div class="prev_score"><?php echo $this->_tpl_vars['match']['t3score']; ?>
/<?php echo $this->_tpl_vars['match']['t3wickets']; ?>
</div>
			<?php $this->assign('overnum', ((is_array($_tmp=((is_array($_tmp=".")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['match']['t3overs']/6) : explode($_tmp, $this->_tpl_vars['match']['t3overs']/6)))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.0f") : smarty_modifier_string_format($_tmp, "%.0f"))); ?>
			<div class="prev_over"><?php echo $this->_tpl_vars['overnum'][0]; ?>
.<?php echo $this->_tpl_vars['match']['t3overs']%6; ?>
 ov</div>
			<?php endif; ?>
		</div>
		<div class="prev_versus">Vs</div>
		<div class="prev_match_team2"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']['t2flag']; ?>
" alt="<?php echo $this->_tpl_vars['match']['t2name']; ?>
" /></div>
		<div class="score_detail">
			<?php if ($this->_tpl_vars['match']['t2score']): ?>
			<div class="prev_score"><?php echo $this->_tpl_vars['match']['t2score']; ?>
/<?php echo $this->_tpl_vars['match']['t2wickets']; ?>
</div>
			<div class="prev_over"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['t2overs']/6)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
.<?php echo $this->_tpl_vars['match']['t2overs']%6; ?>
 ov</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['match']['t4score']): ?>
			<div class="prev_score"><?php echo $this->_tpl_vars['match']['t4score']; ?>
/<?php echo $this->_tpl_vars['match']['t4wickets']; ?>
</div>
			<div class="prev_over"><?php echo ((is_array($_tmp=$this->_tpl_vars['match']['t4overs']/6)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
.<?php echo $this->_tpl_vars['match']['t4overs']%6; ?>
 ov</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="prev_match1_detail">
		<p id="prev_match1_detail1"><?php echo $this->_tpl_vars['match']['tournament_name']; ?>
 - <?php echo $this->_tpl_vars['match']['match_name']; ?>
</p>
		<p id="prev_match1_detail2">Played at <?php echo $this->_tpl_vars['match']['venue']; ?>
 <?php echo $this->_tpl_vars['match']['city']; ?>
  </p>
	</div>
	</a>
	<div class="star_player_divider"></div>
	<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<div class="match-score-indi" style="height:180px; line-height:80px; text-align:center; background-color:#fff;">
			<b>No Matches</b>
		</div>
	<?php endif; ?>
	<!--<div class="title1"><a href="#">More</a></div> -->
</div>