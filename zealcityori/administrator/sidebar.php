<div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <div class="side-user">
              <div class="avatar"><img src="<?php echo $users->avatar;?>" style="width:50px; height:50px;" alt="Avatar" /></div>
              <div class="info">
                <a href="#"><?php echo $users->name;?></a>
                <img src="images/state_online.png" alt="Status" /> <span>Online</span>
              </div>
            </div>
            <ul class="cl-vnavigation">
              <li><a href="#"><i class="fa fa-home"></i><span>Dashboard</span></a>
                <ul class="sub-menu">
                  <li class="active"><a href="index.php">Version 1</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-file"></i><span>Pages</span></a>
                <ul class="sub-menu">
                  <li><a href="kitty.php">Kitty</a></li>
                  <li class="active"><a href="tournament.php">Tournament</a></li>
                  <li><a href="points.php">Points</a></li>
				<li><a href="pointupdator.php">Points Updator</a></li>
				 <li><a href="calculate_leaderboard.php">Calculate Leaderboard</a></li>
				 <li><a href="deposit.php">Deposit</a></li>
				 <li><a href="withdraw.php">Withdraw</a></li>
				 <li><a href="users.php">Users</a></li>
				 <li><a href="blockuser.php">Block Users</a></li>
				 <li><a href="setting.php">Setting</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <input type="text" class="form-control search" placeholder="Search..." />
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>