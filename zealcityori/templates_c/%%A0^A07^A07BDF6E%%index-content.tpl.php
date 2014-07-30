<?php /* Smarty version 2.6.27, created on 2014-04-15 19:50:23
         compiled from F:%5Cxampp%5Chtdocs%5Czealcityori/modules/wordpress/index-content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'F:\\xampp\\htdocs\\zealcityori/modules/wordpress/index-content.tpl', 42, false),)), $this); ?>
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
			<?php $_from = $this->_tpl_vars['starPlayers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['starPlayers'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['starPlayers']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['starPlayer']):
        $this->_foreach['starPlayers']['iteration']++;
?>
			<div class="star-player-container">
				<div class="star-player-desc">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['starPlayer']['content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 400, "...") : smarty_modifier_truncate($_tmp, 400, "...")); ?>

				</div>
			</div>
			<div class="row-divider"></div>
			<?php endforeach; endif; unset($_from); ?>
			<div class="star-player-container">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Star Players : END ------------------------------------------------------>
		<!--------------------------------------------- Pitch Condition : start ------------------------------------------------------>
		<div class="research-index" id="content2" style="display:none">
			<div class="research-index-inner">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['pitchCondition'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1300, "...") : smarty_modifier_truncate($_tmp, 1300, "...")); ?>

			</div>
			<div class="row-divider"></div>
			<div class="star-player-container">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Pitch Condition : END ------------------------------------------------------>
		<!--------------------------------------------- Weather Report : start ------------------------------------------------------>
		<div class="research-index" id="content3" style="display:none">
			<div class="research-index-inner">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['weatherReport'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1300, "...") : smarty_modifier_truncate($_tmp, 1300, "...")); ?>

			</div>
			<div class="row-divider"></div>
			<div class="star-player-container">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Weather Report : ENDS ------------------------------------------------------>
		<!--------------------------------------------- Pros Corner : ENDS ------------------------------------------------------>
		<div class="research-index" id="content4" style="display:none">
			<?php $_from = $this->_tpl_vars['prosCorners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prosCorners'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prosCorners']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prosCorner']):
        $this->_foreach['prosCorners']['iteration']++;
?>
			<div class="star-player-container">
				<div class="star-player-desc">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['prosCorner']['content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 450, "...") : smarty_modifier_truncate($_tmp, 450, "...")); ?>

				</div>
			</div>
			<div class="row-divider"></div>
			<?php endforeach; endif; unset($_from); ?>
			<div class="star-player-container">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research-details"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
			</div>
		</div>
		<!--------------------------------------------- Pros Corner : ENDS ------------------------------------------------------>
		<!--------------------------------------------- Previous Match : STARTS ------------------------------------------------------>
		<div class="research-index" id="content5" style="display:none">
			<div class="research-index-inner">
			<?php echo $this->_tpl_vars['PREVIOUSMATCH']; ?>

			</div>
		</div>
		<!--------------------------------------------- Previous Match : ENDS ------------------------------------------------------>
	</div>
	<div class="index-research-main" id="content-main2">
		<?php $_from = $this->_tpl_vars['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['news'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['news']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prosCorner']):
        $this->_foreach['news']['iteration']++;
?>
		<div class="star-player-container">
			<div class="star-player-desc">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
blog/?p=<?php echo $this->_tpl_vars['prosCorner']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['prosCorner']['thumb']; ?>
" alt=""/></a>
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
blog/?p=<?php echo $this->_tpl_vars['prosCorner']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['prosCorner']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 450, "...") : smarty_modifier_truncate($_tmp, 450, "...")); ?>
</a>
			</div>
		</div>
		<div class="row-divider"></div>
		<?php endforeach; endif; unset($_from); ?>
		<div class="star-player-container">
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
		</div>
	</div>
	<!--<div class="index-research-main" id="content-main3" style="display:none;">
		<?php $_from = $this->_tpl_vars['prosCorners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['prosCorners'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['prosCorners']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prosCorner']):
        $this->_foreach['prosCorners']['iteration']++;
?>
		<div class="star-player-container">
			<div class="star-player-desc">
				<?php echo ((is_array($_tmp=$this->_tpl_vars['prosCorner'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 450, "...") : smarty_modifier_truncate($_tmp, 450, "...")); ?>

			</div>
		</div>
		<div class="row-divider"></div>
		<?php endforeach; endif; unset($_from); ?>
		<div class="star-player-container">
			<input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/>
		</div>
	</div>-->
	<div class="index-research-main" id="content-main4" style="display:none;">
		<?php $_from = $this->_tpl_vars['blogs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['blogs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['blogs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['prosCorner']):
        $this->_foreach['blogs']['iteration']++;
?>
		<div class="star-player-container">
			<div class="star-player-desc">
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
blog/?p=<?php echo $this->_tpl_vars['prosCorner']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['prosCorner']['thumb']; ?>
" alt=""/></a>
				<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
blog/?p=<?php echo $this->_tpl_vars['prosCorner']['id']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['prosCorner']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 450, "...") : smarty_modifier_truncate($_tmp, 450, "...")); ?>
</a>
			</div>
		</div>
		<div class="row-divider"></div>
		<?php endforeach; endif; unset($_from); ?>
		<div class="star-player-container">
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
research"><input type="button" class="more score-more" value="MORE"  style="margin-bottom:10px;"/></a>
		</div>
	</div>
</div>