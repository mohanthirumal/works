<?php /* Smarty version 2.6.27, created on 2014-04-11 12:16:30
         compiled from F:%5Cxampp%5Chtdocs%5Czealcityori/modules/latestwinner/latestwinner.tpl */ ?>
<div class="leaderboard-container">
	<div class="head">
		<div class="tabs">
			<ul>
				<li class="active" onclick="zeal.index.showContent('body', 'latest-winner-container', 1, this, 'tabs')" style="cursor:pointer;">Latest Winners</li>
				<li onclick="zeal.index.showContent('body', 'latest-winner-container', 2, this, 'tabs')" style="cursor:pointer;">Leaderboards</li>
			</ul>
		</div>
	</div>
	<div class="body" id="latest-winner-container1">
		<?php if ($this->_tpl_vars['winners']): ?>
		<?php $_from = $this->_tpl_vars['winners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['winners'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['winners']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['winner']):
        $this->_foreach['winners']['iteration']++;
?>
		<div class="home-winner-indiv">
			<div class="winner-image">
				<?php if ($this->_tpl_vars['winner']['connect_id']): ?>
				<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['winner']['connect_id']; ?>
/picture" alt="" width="65px" height="65px"/>
				<?php else: ?>
				<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt=""/>
				<?php endif; ?>
			</div>
			<div class="winner-desc">
				<span><?php echo $this->_tpl_vars['winner']['tournamentname']; ?>
</span><br/>
				<?php echo $this->_tpl_vars['winner']['username']; ?>

			</div>
		</div>
		<div class="row-divider"></div>
		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<div style="text-align:center; font-weight:bold; margin-top:20px;">No Winners</div>
		<?php endif; ?>
	</div>
	<div class="body latest-leaderboard" id="latest-winner-container2">
		<div class="lboard-menu">
			<div class="extra-large"><b>Name</b></div>
			<div class="small"><b>Runs</b></div>
			<div class="small"><b>Rank</b></div>
		</div>
	<?php $_from = $this->_tpl_vars['leaderboards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['leaderboards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['leaderboards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['leaderboard']):
        $this->_foreach['leaderboards']['iteration']++;
?>
		<div class="table-values">
			<div class="extra-large"><?php echo $this->_tpl_vars['leaderboard']['username']; ?>
</div>
			<div class="small"><?php echo $this->_tpl_vars['leaderboard']['cash']; ?>
</div>
			<div class="small"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
		</div>
	<?php endforeach; endif; unset($_from); ?>
	</div>
</div>
<script language="javascript">
<?php echo '
var i1 = 0
var speed = 1
function scrollTestNews()
{
	i1 = i1 + speed
	var div = document.getElementById("latest-winner-container1")
	div.scrollTop = i1
	if (i1 > div.scrollHeight - 490) {i1 = 0}
	setTimeout("scrollTestNews()",100)
}
scrollTestNews();
'; ?>

</script>