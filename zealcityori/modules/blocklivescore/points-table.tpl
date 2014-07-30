<div class="rightcontext">
	<div class="content_title">
		<p>Points Table</p>
	</div>
		<div class="points-table-container">
        	<div class="group1" style="">
                <div class="points-table-head point-table-cont">
                    <div class="small">SNo</div>
                    <div class="large">Team Name</div>
                    <div class="medium">Points</div>
                </div>
			</div>
            <div class="group1-teams">
                {foreach from=$points item=point name=points}
                        <div class="points-table-body point-table-cont">
                            <div class="small">{$smarty.foreach.points.iteration}</div>
                            <div class="large">{$point.team_name}</div>
                            <div class="medium">{$point.points}</div>
                        </div>
                {/foreach}
            </div>
		</div>	
		<a href="research-details.php"><div class="more score-more" style="margin-top:5px;">MORE</div></a>
</div>