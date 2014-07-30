<div class="leaderboards-container">
	<div class="left-container">
    	<div class="head"><div class="head-title">LEADERBOARDS</div></div>
        <div class="lboard-area">
        	<ul class="menu-area">
				<li class="weekly-menu active" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 3, this, 'lboard-area')">Championship</li>
            	<li class="weekly-menu" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 1, this, 'lboard-area')">Weekly</li>
                <li class="weekly-menu" style="cursor:pointer" onclick="zeal.index.showContent('leaderboards', 'leaderboard', 2, this, 'lboard-area')">Monthly</li>
            </ul>
            <div class="lboard-menu">
            	<div class="small" style="width:50px;"><b>S.No</b></div>
                <div class="extra-large"><b>Name</b></div>
                <div class="large"><b>Runs</b></div>
                <div class="small"><b>Rank</b></div>
            </div>
			<div class="leaderboards" id="leaderboard1" style="display:none;">
				<div class="leaderboard-dates">{$weeklyStartDate} to {$weeklyEndDate}</div>
				{foreach from=$weeklyLeaderboard item=leaderboard name=leaderboards}
				<div class="table-values{if $weeklyRank.rank == $smarty.foreach.leaderboards.iteration} highlight-user{/if}">
					<div class="small" style="width:50px;">{$smarty.foreach.leaderboards.iteration}</div>
					<div class="extra-large">
						{if $leaderboard.connect_id}
							<img src="https://graph.facebook.com/{$leaderboard.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$leaderboard.username}
					</div>
					<div class="large-flag">{$leaderboard.cash}</div>
					<div class="small">{$smarty.foreach.leaderboards.iteration}</div>
				</div>
				{/foreach}
				{if $weeklyRank && $weeklyRank.rank > 10}
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;">{$weeklyRank.rank}</div>
					<div class="extra-large">
						{if $weeklyRank.connect_id}
							<img src="https://graph.facebook.com/{$weeklyRank.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$weeklyRank.username}
					</div>
					<div class="large-flag">{$weeklyRank.cash}</div>
					<div class="small">{$weeklyRank.rank}</div>
				</div>
				{/if}
			</div>
			<div class="leaderboards" id="leaderboard2" style="display:none;">
				<div class="leaderboard-dates">{$monthlyStartDate} to {$monthlyEndDate}</div>
				{foreach from=$monthlyLeaderboard item=leaderboard name=leaderboards}
				<div class="table-values{if $monthlyRank.rank == $smarty.foreach.leaderboards.iteration} highlight-user{/if}">
					<div class="small" style="width:50px;">{$smarty.foreach.leaderboards.iteration}</div>
					<div class="extra-large">
						{if $leaderboard.connect_id}
							<img src="https://graph.facebook.com/{$leaderboard.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$leaderboard.username}
					</div>
					<div class="large-flag">{$leaderboard.cash}</div>
					<div class="small">{$smarty.foreach.leaderboards.iteration}</div>
				</div>
				{/foreach}
				{if $monthlyRank && $monthlyRank.rank > 10}
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;">{$monthlyRank.rank}</div>
					<div class="extra-large">
						{if $monthlyRank.connect_id}
							<img src="https://graph.facebook.com/{$monthlyRank.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$monthlyRank.username}
					</div>
					<div class="large-flag">{$monthlyRank.cash}</div>
					<div class="small">{$monthlyRank.rank}</div>
				</div>
				{/if}
			</div>
			<div class="leaderboards" id="leaderboard3">
				<div class="leaderboard-dates"></div>
				{foreach from=$championLeaderboard item=leaderboard name=leaderboards}
				<div class="table-values{if $championRank.rank == $smarty.foreach.leaderboards.iteration} highlight-user{/if}">
					<div class="small" style="width:50px;">{$smarty.foreach.leaderboards.iteration}</div>
					<div class="extra-large">
						{if $leaderboard.connect_id}
							<img src="https://graph.facebook.com/{$leaderboard.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$leaderboard.username}
					</div>
					<div class="large-flag">{$leaderboard.cash}</div>
					<div class="small">{$smarty.foreach.leaderboards.iteration}</div>
				</div>
				{/foreach}
				{if $championRank && $championRank.rank > 10}
				<div class="table-values highlight-user">
					<div class="small" style="width:50px;">{$championRank.rank}</div>
					<div class="extra-large">
						{if $championRank.connect_id}
							<img src="https://graph.facebook.com/{$championRank.connect_id}/picture" alt=""/>
						{else}
							<img src="{$base_dir}images/avatar.jpg" alt="" />
						{/if}
						{$championRank.username}
					</div>
					<div class="large-flag">{$championRank.cash}</div>
					<div class="small">{$championRank.rank}</div>
				</div>
				{/if}
			</div>
        </div>
    </div>
    <div class="right-container">

		<div class="leaderboard-head-title">
			<ul>
				<li onclick="zeal.index.showContent('prizes', 'prize', 2, this, 'leaderboard-head-title')">Championship</li>
				<li onclick="zeal.index.showContent('prizes', 'prize', 1, this, 'leaderboard-head-title')">VIP</li>
			</ul>
		</div>
		<div class="prizes" id="prize2">
			<div class="prizes-championship"></div>
		</div>
		<div class="prizes" id="prize1" style="display:none;">
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