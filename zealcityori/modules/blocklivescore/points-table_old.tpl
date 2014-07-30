<div class="rightcontext">
	<div class="content_title">
		<p>Points Table</p>
	</div>
		<div class="points-table-container">
        	<div class="group1" style="">
                <div class="group-a">GROUP A</div>
                <div class="points-table-head point-table-cont">
                    <div class="small">SNo</div>
                    <div class="large">Team Name</div>
                    <div class="medium">Points</div>
                </div>
			</div>
            {assign var=val value=1}
            <div class="group1-teams">
                {foreach from=$points item=point name=points}
                    {if $point.group == 'A'}
                        <div class="points-table-body point-table-cont">
                            <div class="small">{$val}</div>
                            <div class="large">{$point.team_name}</div>
                            <div class="medium">{$point.points}</div>
                        </div>
                        {assign var=val value=$val+1}
                    {/if}
                {/foreach}
            </div>
            <div class="group1">
                <div class="group-a">GROUP B</div>
                <div class="points-table-head point-table-cont">
                    <div class="small">SNo</div>
                    <div class="large">Team Name</div>
                    <div class="medium">Points</div>
                </div>
			</div>
            {assign var=val1 value=1}
            <div class="group1-teams">
                {foreach from=$points item=point name=points}
                    {if $point.group == 'B'}
                        <div class="points-table-body point-table-cont">
                            <div class="small">{$val1}</div>
                            <div class="large">{$point.team_name}</div>
                            <div class="medium">{$point.points}</div>
                        </div>
                        {assign var=val1 value=$val1+1}
                    {/if}
                {/foreach}
			</div>
		</div>	
		<a href="research-details.php"><div class="more score-more" style="margin-top:5px;">MORE</div></a>
</div>