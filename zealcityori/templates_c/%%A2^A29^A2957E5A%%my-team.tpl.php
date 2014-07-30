<?php /* Smarty version 2.6.27, created on 2014-04-21 14:30:41
         compiled from my-team.tpl */ ?>
<div class="myteam" id="myteam">
	<div style="padding:10px; background-color:#EBEBEB; font-weight:bold; font-size:18px; margin:10px 0 10px 0;">
    	<div style="float:left"><?php echo $this->_tpl_vars['tournament']->name; ?>
</div>
        <div style="text-align:right;">Status - <?php echo $this->_tpl_vars['tournament']->status; ?>
</div>
    </div>
	<div class="live-score-menu">
		<ul>
        	<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
        		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
tournament"><div class="tournament-back-icon"></div></a>
			<?php else: ?>
            	<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-period-tournament-details/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
"><div class="tournament-back-icon"></div></a>
			<?php endif; ?>
			<li class="active" onclick="zeal.index.showContent('myteam-list', 'myteam', 1, this, 'live-score-menu')">My Team</li>
			<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 2, this, 'live-score-menu')">Tournament Details</li>
			<?php endif; ?>
			<li onclick="zeal.index.showContent('myteam-list', 'myteam', 3, this, 'live-score-menu')">Result</li>
		</ul>		
		<div style="float:right; margin:10px 10px 0 0;">
			<div>No.of.Changes : <?php echo $this->_tpl_vars['myTournament']['no_of_changes']; ?>
/<?php echo $this->_tpl_vars['tournament']->no_of_changes; ?>

                <?php if ($this->_tpl_vars['enableedit']): ?>
				<?php if ($this->_tpl_vars['tournament']->tournament_type_id == 1 || $this->_tpl_vars['tournament']->tournament_type_id == 3): ?>
					<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/0">Edit</a>
				<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
my-tournament/<?php echo $this->_tpl_vars['tournament']->tournament_type_id; ?>
-type/<?php echo $this->_tpl_vars['tournament']->id; ?>
/<?php echo $this->_tpl_vars['match']->id; ?>
">Edit</a>
				<?php endif; ?>
                <?php endif; ?>
            </div>
        </div>        
	</div>
	<div id="myteam1" class="myteam-list">		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'my-team-list.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<div id="myteam2" class="myteam-list" style="display:none;">
		<div class="myteam-body">
			<div class="myteam-tour-details">
				<div class="myteam-tour-details-inner">
					<div class="live-match-indiv fixtures" style="margin-left:100px;">
						<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']->team1Details->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['match']->team1Details->teamname; ?>
" /></div>
						<div class="v-image-area"></div>
						<div class="flag"><img src="<?php echo $this->_tpl_vars['imageurl']; ?>
<?php echo $this->_tpl_vars['match']->team2Details->flag_url; ?>
" alt="<?php echo $this->_tpl_vars['match']->team2Details->teamname; ?>
" /></div>
					</div>
					<div class="tour-detail-label">Tournament Name:</div>
					<div class="tour-detail-label"><b><?php echo $this->_tpl_vars['tournament']->name; ?>
</b></div>
					<div class="tour-detail-label">Type:</div>
					<div class="tour-detail-label"><b><?php echo $this->_tpl_vars['match']->type; ?>
</b></div>
					<div class="tour-detail-label">Tournament ID:</div>
					<div class="tour-detail-label"><b><?php echo $this->_tpl_vars['tournament']->id; ?>
</b></div>
					<div class="tour-detail-label">Entry Fee:</div>
					<div class="tour-detail-label"><b><span class="WebRupee">Rs.</span><?php echo $this->_tpl_vars['tournament']->entry_fee; ?>
</b></div>
					<div class="tour-detail-label">Players:</div>
					<div class="tour-detail-label"><b><?php echo $this->_tpl_vars['tournament']->joinPlayers; ?>
/<?php echo $this->_tpl_vars['tournament']->players; ?>
</b></div>
				</div>
			</div>
		</div>
	</div>
	<div id="myteam3" class="myteam-list" style="display:none;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'my-team-result.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>