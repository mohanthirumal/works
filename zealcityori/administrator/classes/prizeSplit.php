<?php
class priSep
{
	public $user_id;
	public $tournament_id;
	public $run;
	public $prizecount;
	public $c=1;
	public $amtdiv = Array();
	public $count=1;
	public function __construct($runs,$user_id,$tour_id, $pri,$oldcoin)
	{	
		$this->prizecount = count($pri);
		$sql3="INSERT INTO coc_leaderboard(tournament_id, user_id, prize_money, rank) VALUES ";
		//var_dump($user_id);
		for($i=1;$i<=$this->prizecount;$i++)
		{
			if($runs[$i]['runs'] == $runs[$i+1]['runs'])
			{
				for($j=$i;$j<=$runs;$j++)
				{
					if($runs[$j]['runs'] == $runs[$j+1]['runs'])
						$this->c = $this->c + 1;
					else
						break;
				}
				$amtdiv = $pri[$i]/$this->c;
			}
		}
		$b = 1;
		for($i=1;$i<=$this->prizecount;$i++)
		{
			if($runs[$i]['runs'] == $runs[$i+1]['runs'])
			{
				$a = $i;
				for($j=1;$j<=$this->c;$j++)
				{
					//echo $a . "a+<br/>";
					$sql3 .= "(
							".$tour_id[$i]['tournament_id'].",
							".$user_id[$a]['user_id'].",
							".$amtdiv.",
							".$this->count."),";
					//echo $a . "<br/>";
					$sql="UPDATE coc_users SET cash = cash + ".$amtdiv.",coin = coin + ".$oldcoin." WHERE id = ".$user_id[$a]['user_id']." ";
					mysql_query($sql);
					$a = $a + 1;
				}
				$this->prizecount = $this->prizecount + 1;
				$this->count = $this->count + 1;
				$b = $a ;
			}
			else
			{
				//echo $b . "b+<br/>";
				if($pri[$i] != '')
				{
					$sql3 .= "(
							".$tour_id[$i]['tournament_id'].",
							".$user_id[$b]['user_id'].",
							".$pri[$i].",
							".$this->count."),";
					$sql="UPDATE coc_users SET cash = cash + ".$pri[$i].",coin = coin + ".$oldcoin." WHERE id = ".$user_id[$b]['user_id']." ";
					mysql_query($sql);
					//echo $sql;
					$b = $b + 1;
				}
			}
			$this->count = $this->count + 1;
		}
		
		//$this->amtinst();
		//echo $sql3;
		$sql3=substr($sql3,0,-1);
		mysql_query($sql3);	
		//exit();
	}
	
	public function amtinst()
	{
		echo "next";
		
		var_dump($runs);
		
	}
}