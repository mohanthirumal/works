<?php /* Smarty version 2.6.27, created on 2014-04-11 14:19:35
         compiled from leaderboard.tpl */ ?>
<div class="leaderboards-container">
	<div class="left-container">
    	<div class="head"><div class="head-title">LEADERBOARDS</div></div>
        <div class="lboard-area">
        	<ul class="menu-area">
				<!--<li class="weekly-menu active" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 3, this, 'lboard-area')">Championship</li>-->
            	<li class="weekly-menu active" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 1, this, 'lboard-area')">Weekly</li>
                <li class="weekly-menu" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 2, this, 'lboard-area')">Monthly</li>
            </ul>
            <div class="lboard-menu">
            	<div class="small" style="width:50px;"><b>S.No</b></div>
                <div class="extra-large"><b>Name</b></div>
                <div class="large"><b>Runs</b></div>
                <div class="small"><b>Rank</b></div>
            </div>
			<div class="leaderboards" id="leaderboard1" >
				<div class="leaderboard-dates"><?php echo $this->_tpl_vars['weeklyStartDate']; ?>
 to <?php echo $this->_tpl_vars['weeklyEndDate']; ?>
</div>
				<?php $_from = $this->_tpl_vars['weeklyLeaderboard']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['leaderboards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['leaderboards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['leaderboard']):
        $this->_foreach['leaderboards']['iteration']++;
?>
				<div class="table-values<?php if ($this->_tpl_vars['weeklyRank']['rank'] == $this->_foreach['leaderboards']['iteration']): ?> highlight-user<?php endif; ?>">
					<div class="small" style="width:50px;"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['leaderboard']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['leaderboard']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['leaderboard']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['leaderboard']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['weeklyRank'] && $this->_tpl_vars['weeklyRank']['rank'] > 10): ?>
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;"><?php echo $this->_tpl_vars['weeklyRank']['rank']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['weeklyRank']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['weeklyRank']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['weeklyRank']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['weeklyRank']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_tpl_vars['weeklyRank']['rank']; ?>
</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="leaderboards" id="leaderboard2" style="display:none;">
				<div class="leaderboard-dates"><?php echo $this->_tpl_vars['monthlyStartDate']; ?>
 to <?php echo $this->_tpl_vars['monthlyEndDate']; ?>
</div>
				<?php $_from = $this->_tpl_vars['monthlyLeaderboard']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['leaderboards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['leaderboards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['leaderboard']):
        $this->_foreach['leaderboards']['iteration']++;
?>
				<div class="table-values<?php if ($this->_tpl_vars['monthlyRank']['rank'] == $this->_foreach['leaderboards']['iteration']): ?> highlight-user<?php endif; ?>">
					<div class="small" style="width:50px;"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['leaderboard']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['leaderboard']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['leaderboard']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['leaderboard']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['monthlyRank'] && $this->_tpl_vars['monthlyRank']['rank'] > 10): ?>
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;"><?php echo $this->_tpl_vars['monthlyRank']['rank']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['monthlyRank']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['monthlyRank']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['monthlyRank']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['monthlyRank']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_tpl_vars['monthlyRank']['rank']; ?>
</div>
				</div>
				<?php endif; ?>
			</div>
			<!--<div class="leaderboards" id="leaderboard3">
				<div class="leaderboard-dates"></div>
				<?php $_from = $this->_tpl_vars['championLeaderboard']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['leaderboards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['leaderboards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['leaderboard']):
        $this->_foreach['leaderboards']['iteration']++;
?>
				<div class="table-values<?php if ($this->_tpl_vars['championRank']['rank'] == $this->_foreach['leaderboards']['iteration']): ?> highlight-user<?php endif; ?>">
					<div class="small" style="width:50px;"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['leaderboard']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['leaderboard']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['leaderboard']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['leaderboard']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_foreach['leaderboards']['iteration']; ?>
</div>
				</div>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['championRank'] && $this->_tpl_vars['championRank']['rank'] > 10): ?>
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;"><?php echo $this->_tpl_vars['championRank']['rank']; ?>
</div>
					<div class="extra-large">
						<?php if ($this->_tpl_vars['championRank']['connect_id']): ?>
							<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['championRank']['connect_id']; ?>
/picture" alt=""/>
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['base_dir']; ?>
images/avatar.jpg" alt="" />
						<?php endif; ?>
						<?php echo $this->_tpl_vars['championRank']['username']; ?>

					</div>
					<div class="large-flag"><?php echo $this->_tpl_vars['championRank']['cash']; ?>
</div>
					<div class="small"><?php echo $this->_tpl_vars['championRank']['rank']; ?>
</div>
				</div>
				<?php endif; ?>
			</div>-->
        </div>
    </div>
    <div class="right-container">

		<div class="leaderboard-head-title">
			<ul>
				<!--<li onclick="zeal.index.showContent('prizes', 'prize', 2, this, 'leaderboard-head-title')">Championship</li>-->
				<li onclick="zeal.index.showContent('prizes', 'prize', 1, this, 'leaderboard-head-title')">VIP</li>
			</ul>
		</div>
		<!--<div class="prizes" id="prize2">
			<div class="prizes-championship"></div>
		</div>-->
		<div class="prizes" id="prize1"">
			<div class="lboard-area">
				<div class="menu-area"><div class="gift-to-won">Gifts to be won</div></div>
				<div class="lboard-menu" id="lboard-menu-darkline">
					<div class="items">Items</div>
					<div class="item-name">Items Name</div>
					<!--<div class="code">Code</div>-->
					<div class="availability">Availability</div>
					<div class="zccoins">ZC coins </div>
					<div class="getit">Get it</div>
				</div>
				<div class="gift-values">
					<div class="items-value"><div class="shirt-img"><img src="images/autographed bats.jpg" class="product-img"/></div></div>
					<div class="item-name-value">Autographed Bats</div>
					<div class="availability-value">0/100</div>
					<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">3000</div></div>
					<div class="getit-value"><div class="details-button">Get It</div></div>
				</div>             
				<div class="gift-values">
					<div class="gift-values">
						<div class="items-value"><div class="shirt-img"><img src="images/karbonn mobiles.jpg" class="product-img"/></div></div>
						<div class="item-name-value">karbon Mobile</div>
						<div class="availability-value">0/50</div>
						<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">4500</div></div>
						<div class="getit-value"><div class="details-button">Get It</div></div>
					</div>
				</div>             
				<div class="gift-values">
					<div class="gift-values">
						<div class="items-value"><div class="shirt-img"><img src="images/ipad3_film_3.jpg" class="product-img"/></div></div>
						<div class="item-name-value">Tablet</div>
						<div class="availability-value">0/30</div>
						<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">45000</div></div>
						<div class="getit-value"><div class="details-button">Get It</div></div>
					</div>             
				</div>             
				<div class="gift-values">
					<div class="gift-values">
						<div class="items-value"><div class="shirt-img"><img src="images/psp.jpg" class="product-img"/></div></div>
						<div class="item-name-value">Psp</div>
						<div class="availability-value">0/20</div>
						<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">10500</div></div>
						<div class="getit-value"><div class="details-button">Get It</div></div>
					</div>             
				</div>
				<div class="gift-values">
					<div class="gift-values">
						<div class="items-value"><div class="shirt-img"><img src="images/xbox.jpg" class="product-img"/></div></div>
						<div class="item-name-value">Xbox</div>
						<div class="availability-value">0/15</div>
						<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">40500</div></div>
						<div class="getit-value"><div class="details-button">Get It</div></div>
					</div>             
				</div>
				<div class="gift-values">
					<div class="gift-values">
						<div class="items-value"><div class="shirt-img"><img src="images/iphone 5.png" class="product-img"/></div></div>
						<div class="item-name-value">Iphone 5</div>
						<div class="availability-value">0/10</div>
						<div class="zccoins-value"><div class="icon-img"></div><div class="amount-value">69000</div></div>
						<div class="getit-value"><div class="details-button">Get It</div></div>
					</div>             
				</div>
			</div>
		</div>
    </div>
</div>