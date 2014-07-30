<?php
require_once('PlayerBatPerformance.php');
require_once('PlayerBowlPerformance.php');
class RunCalculator
{
	protected $match_id;
	protected $player_id;
	protected $inn_id;
	//protected $cocrun = 0;
	protected $bat;
	protected $bowl;
	public $type;
	public $odiresult;
	public $t20result;
	public $testresult;
	protected $cocrun = array('batting' => 0, 'bowling' => 0, 'fielding' => 0);
	
	public function calculate($match_id, $player_id, $inn_id)
	{
		//$this->cocrun = 0;
		$this->cocrun = array('batting' => 0, 'bowling' => 0, 'fielding' => 0);
		$this->bat = new PlayerBatPerformance($match_id, $player_id, $inn_id);
		$this->bowl = new PlayerBowlPerformance($match_id, $player_id, $inn_id);
		$this->type=$this->type;
		$this->odivalues();
		$this->t20Values();
		$this->testValues();
		switch($this->type)
		{
			case "50-50":
				if(!empty($this->bat->id))
				{
					
					$this->batting();
					$this->strikeRate();
					$this->bonus();	
				}
				if(!empty($this->bowl->id))
				{
					$this->bowling();
					$this->economyRate();					
				}
				$this->fielding();
				return $this->cocrun;
				break;
				
			case "20-20":
				if(!empty($this->bat->id))
				{
					$this->battingT20();
					$this->strikeRateT20();
					$this->bonusT20();
				}
				if(!empty($this->bowl->id))
				{
					$this->bowlingT20();
					$this->economyRateT20();
				}
				$this->fieldingT20();				
				return $this->cocrun;
				break;	
					
			case "test":
				if(!empty($this->bat->id))
				{
					$this->battingTest();
					$this->strikeRateTest();
					$this->bonusTest();
				}
				if(!empty($this->bowl->id))
				{
					$this->bowlingTest();
					$this->fieldingTest();
				}
				return $this->cocrun;
				break;	
		}
	}
	
	private function odivalues()
	{
		$sql="SELECT * FROM coc_points_system where type='ODI'";
		$res = mysql_query($sql);
		$this->odiresult = array();
		while($esultresource=mysql_fetch_array($res))
		{		
			$this->odiresult[$esultresource['key']]=$esultresource['run'];
		}
	}
	
	private function t20Values()
	{
		$sql="SELECT * FROM coc_points_system where type='T20'";
		$res = mysql_query($sql);
		$this->t20result = array();
		while($esultresource=mysql_fetch_array($res))
		{
			$this->t20result[$esultresource['key']]=$esultresource['run'];			
		}
	}
	
	private function testValues()
	{
		$sql="SELECT * FROM coc_points_system where type='TEST'";
		$res = mysql_query($sql);
		$this->testresult = array();
		while($esultresource=mysql_fetch_array($res))
		{
			$this->testresult[$esultresource['key']]=$esultresource['run'];
		}
	}
	
											/* ODI  Run  Calculation */
	private function batting()
	{
		$this->cocrun['batting'] = $this->bat->runs;
		if($this->bat->runs >= 100)
			$this->cocrun['batting'] += $this->odiresult['CENTURY'];
		else if($this->bat->runs >= 50)
			$this->cocrun['batting'] += $this->odiresult['HALF_CENTURY'];
		$this->cocrun['batting'] += $this->bat->consfour * 10;
		$this->cocrun['batting'] += $this->bat->conssix * 20;
		//$this->cocrun += $this->bat->consfour *  $this->t20result['FOUR_CONSECUTIVE'];
		//$this->cocrun += $this->bat->conssix *  $this->t20result['SIX_CONSECUTIVE'];
	}
	
	private function strikeRate()
	{
		if($this->bat->balls > 0)
			$strikerate = ($this->bat->runs/$this->bat->balls) * 100;
		else
			$strikerate = 0;
		if($strikerate >= 121)
			$this->cocrun['batting'] += $this->odiresult['STRIKE_RATE_121_ABOVE'];
		else if($strikerate >= 100 && $strikerate <= 120)
			$this->cocrun['batting'] += $this->odiresult['STRIKE_RATE_100_TO_120'];
		else if($strikerate < 50 && $this->bat->balls > 0  )
			$this->cocrun['batting'] += $this->odiresult['STRIKE_RATE_BELOW_50'];
	}
	
	private function bonus()
	{
		if($this->bat->fours >= 10)
			$this->cocrun['batting'] += 15;
		else if($this->bat->fours >= 6 && $this->bat->fours <= 9)
			$this->cocrun['batting'] += $this->odiresult['FOUR_6_TO_9'];
		else if($this->bat->fours >= 3 && $this->bat->fours <= 5)
			$this->cocrun['batting'] += $this->odiresult['FOUR_3_TO_5'];
		if($this->bat->sixs >= 6)
			$this->cocrun['batting'] += $this->odiresult['SIX_6_ABOVE'];
		else if($this->bat->sixs >= 4 && $this->bat->sixs <= 5)
			$this->cocrun['batting'] += $this->odiresult['SIX_4_TO_5'];
		else if($this->bat->sixs >= 2 && $this->bat->sixs <= 3)
			$this->cocrun['batting'] += $this->odiresult['SIX_2_TO_3'];
	}
	
	private function bowling()
	{
		$this->cocrun['bowling'] += $this->bowl->maiden * 6;
		$this->cocrun['bowling'] += $this->bowl->wickets * 25;
		if($this->bowl->wickets >= 5)
			$this->cocrun['bowling'] += $this->odiresult['WICKET_5_HAUL'];
		else if($this->bowl->wickets >= 3)
			$this->cocrun['bowling'] += $this->odiresult['WICKET_3_HAUL'];
		
	}
	
	private function economyRate()
	{
		if($this->bowl->balls > 0)
			$economyRate = ($this->bowl->runs/$this->bowl->balls) * 6;
		else
			$economyRate = 0;
		if($economyRate > 7.5)
			$this->cocrun['bowling'] += $this->odiresult['ECONOMY_RATE_ABOVE_7.5'];
		else if($economyRate < 5 && $this->bowl->balls !=0)
			$this->cocrun['bowling'] += $this->odiresult['ECONOMY_RATE_BELOW_5'];
		$this->cocrun['bowling'] += $this->bowl->wide * $this->odiresult['WIDES'];
		$this->cocrun['bowling'] += $this->bowl->noball * $this->odiresult['NO_BALLS'];
	}
	
	private function fielding()
	{
		if($this->bowl->caught>0)
			$this->cocrun['fielding'] += $this->odiresult['CATCH'] * $this->bowl->caught;
		if($this->bowl->stumped>0)
			$this->cocrun['fielding'] += $this->odiresult['STUMPING'] * $this->bowl->stumped;
		if($this->bowl->runout>0)
			$this->cocrun['fielding'] += $this->odiresult['RUNOUT'] * $this->bowl->runout;
	}
	
												/* T20 Run Calculation  */
	private function battingT20()
	{
		$this->cocrun['batting'] = $this->bat->runs;
		if($this->bat->runs >= 100)
			$this->cocrun['batting'] += $this->t20result['CENTURY'];
		else if($this->bat->runs >= 50)
			$this->cocrun['batting'] += $this->t20result['HALF_CENTURY'];
		else if($this->bat->runs >= 30)
			$this->cocrun['batting'] += $this->t20result['30 RUNS'];
		$this->cocrun['batting'] += $this->bat->consfour *  $this->t20result['FOUR_CONSECUTIVE'];
		$this->cocrun['batting'] += $this->bat->conssix *  $this->t20result['SIX_CONSECUTIVE'];
		
	}
	private function strikeRateT20()
	{
		if($this->bat->balls > 0)
			$strikerate = ($this->bat->runs/$this->bat->balls) * 100;
		else
			$strikerate = 0;
		if($strikerate >=200)
			$this->cocrun['batting'] += $this->t20result['STRIKE_RATE_200_AND ABOVE'];
		else if($strikerate >= 141 && $strikerate <= 199)
			$this->cocrun['batting'] += $this->t20result['STRIKE_RATE_141_to 199'];
		else if($strikerate >= 121 && $strikerate <= 140)
			$this->cocrun['batting'] += $this->t20result['STRIKE_RATE_121_to 140'];
		else if($strikerate > 100 && $strikerate < 121)
			$this->cocrun['batting'] += $this->t20result['STRIKE_RATE_100_TO_120'];
		else if($strikerate < 100 && $this->bat->balls > 0 )
			$this->cocrun['batting'] += $this->t20result['STRIKE_RATE_BELOW_100'];
		
	}	
	
	private function bonusT20()
	{
		if($this->bat->fours >= 10)
			$this->cocrun['batting'] += $this->t20result['FOUR_10_ABOVE'];
		else if($this->bat->fours >= 6 && $this->bat->fours <= 9)
			$this->cocrun['batting'] += $this->t20result['FOUR_6_TO_9'];
		else if($this->bat->fours >= 3 && $this->bat->fours <= 5)
			$this->cocrun['batting'] += $this->t20result['FOUR_3_TO_5'];
		if($this->bat->sixs >= 6)
			$this->cocrun['batting'] += $this->t20result['SIX_6_ABOVE'];
		else if($this->bat->sixs >= 4 && $this->bat->sixs <= 5)
			$this->cocrun['batting'] += $this->t20result['SIX_4_TO_5'];
		else if($this->bat->sixs >= 2 && $this->bat->sixs <= 3)
			$this->cocrun['batting'] += $this->t20result['SIX_2_TO_3'];
	}
	
	private function bowlingT20()
	{
		$this->cocrun['bowling'] += $this->bowl->maiden * $this->t20result['MAIDENS'];
		$this->cocrun['bowling'] += $this->bowl->wickets * $this->t20result['WICKETS'];
		if($this->bowl->wickets >= 5)
			$this->cocrun['bowling'] += $this->t20result['WICKET_5_HAUL'];
		else if($this->bowl->wickets >= 3)
			$this->cocrun['bowling'] += $this->t20result['WICKET_3_HAUL'];
	}
	
	private function economyRateT20()
	{
		if($this->bowl->balls > 0)
			$economyRate = ($this->bowl->runs/$this->bowl->balls) * 6;
		else
			$economyRate = 0;
		if($economyRate >= 10)
			$this->cocrun['bowling'] += $this->t20result['ECONOMY_RATE_ABOVE_10'];
		else if($economyRate>=9.01 && $economyRate <= 9.99)
			$this->cocrun['bowling'] += $this->t20result['ECONOMY_RATE_9.01 TO 9.99'];
		else if($economyRate>=8.01 && $economyRate <= 9)
			$this->cocrun['bowling'] += $this->t20result['ECONOMY_RATE_8.01 TO 8.99'];
		else if($economyRate>=7.01 && $economyRate < 8)
			$this->cocrun['bowling'] -= $this->t20result['ECONOMY_RATE_7.01 TO 8.00'];
		else if($economyRate>=6.01 && $economyRate <= 7)
			$this->cocrun['bowling'] += $this->t20result['ECONOMY_RATE_6.01 TO 7.00'];
		else if($economyRate <= 6 && $this->bowl->balls != 0)
			$this->cocrun['bowling'] += $this->t20result['ECONOMY_RATE_BELOW 6.00'];
			
		$this->cocrun['bowling'] += $this->bowl->wide * $this->t20result['WIDES'];
		$this->cocrun['bowling'] += $this->bowl->noball * $this->t20result['NO_BALLS'];
	}
	
	private function fieldingT20()
	{
		if($this->bowl->caught > 0)
			$this->cocrun['fielding'] += $this->t20result['CATCH'] * $this->bowl->caught;
		if($this->bowl->stumped > 0)
			$this->cocrun['fielding'] += $this->t20result['STUMPING'] * $this->bowl->stumped;
		if($this->bowl->runout > 0)
			$this->cocrun['fielding'] += $this->t20result['RUNOUT'] * $this->bowl->runout;
	}
	
												/*    TEST  Run Calculation */
	private function battingTest()
	{
		$this->cocrun['batting'] = $this->bat->runs;
		if($this->bat->runs >= 200)
			$this->cocrun['batting'] += $this->testresult['DOUBLE_CENTURY'];
		else if($this->bat->runs >= 100)
			$this->cocrun['batting'] += $this->testresult['CENTURY'];			
		else if($this->bat->runs >= 50)
			$this->cocrun['batting'] += $this->testresult['HALF_CENTURY'];
		$this->cocrun['batting'] += $this->bat->consfour * $this->testresult['FOUR_CONSECUTIVE'];
		$this->cocrun['batting'] += $this->bat->conssix * $this->testresult['SIX_CONSECUTIVE'];
	}
	
	private function strikeRateTest()
	{
		if($this->bat->balls > 0)
			$strikerate = ($this->bat->runs/$this->bat->balls) * 100;
		else
			$strikerate = 0;
		if($strikerate >=69)
			$this->cocrun['batting'] += $this->testresult['STRIKE_RATE_ABOVE 69'];
	}
	
	private function bonusTest()
	{
		if($this->bat->fours >= 15)
			$this->cocrun['batting'] += $this->testresult['FOUR_ABOVE 15'];
		else if($this->bat->fours >= 10 && $this->bat->fours <= 14)
			$this->cocrun['batting'] += $this->testresult['FOUR_10_TO 14'];
		else if($this->bat->fours >= 5 && $this->bat->fours <= 9)
			$this->cocrun['batting'] += $this->testresult['FOUR_5_TO_9'];
		if($this->bat->sixs >= 5)
			$this->cocrun['batting'] += $this->testresult['SIX_ABOVE 5'];
		else if($this->bat->sixs >= 3 && $this->bat->sixs <= 4)
			$this->cocrun['batting'] += $this->testresult['SIX_3_TO_4'];
	}
	
	private function bowlingTest()
	{
		$this->cocrun['bowling'] += $this->bowl->maiden * $this->testresult['MAIDENS'];
		$this->cocrun['bowling'] += $this->bowl->wickets * $this->testresult['WICKETS'];
		if($this->bowl->wickets >= 5)
			$this->cocrun['bowling'] += $this->testresult['WICKET_5_HAUL'];
		else if($this->bowl->wickets >= 3)
			$this->cocrun['bowling'] += $this->testresult['WICKET_3_HAUL'];
		$this->cocrun['bowling'] += $this->bowl->wide * $this->testresult['WIDES'];
		$this->cocrun['bowling'] += $this->bowl->noball * $this->testresult['NO_BALLS'];	
		
	}
	
	private function fieldingTest()
	{
		if($this->bowl->caught > 0)
			$this->cocrun['fielding'] += $this->testresult['CATCH'] * $this->bowl->caught ;
		if($this->bowl->stumped > 0)
			$this->cocrun['fielding'] += $this->testresult['STUMPING'] * $this->bowl->stumped;
		if($this->bowl->runout > 0)
			$this->cocrun['fielding'] += $this->testresult['RUNOUT'] * $this->bowl->runout;
	}
	
}


