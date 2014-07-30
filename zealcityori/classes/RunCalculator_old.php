<?php
class RunCalculator
{
	protected $cocrun = array('batting' => 0, 'battingbonus' => 0, 'bowling' => 0, 'fielding' => 0);
	protected $performance = array();
	public $type;
	
	public function calculate($performance)
	{
		$this->cocrun = array('batting' => 0, 'battingbonus' => 0, 'bowling' => 0, 'fielding' => 0);
		$this->performance = $performance;		
		switch($this->type)
		{
			case '50-50':				
				$this->batting_odi();
				$this->batting_bonus_odi();
				$this->bowling_odi();
				$this->fielding_odi();
				return $this->cocrun;
				break;
				
			case '20-20':
				$this->batting_t20();
				$this->batting_bonus_t20();
				$this->bowling_t20();
				$this->fielding_t20();
				return $this->cocrun;
				break;
				
			case 'test':
			
				$this->batting_test();
				$this->batting_bonus_test();
				$this->bowling_test();
				$this->fielding_test();
				return $this->cocrun;
				break;
		}
	}
	
	private function batting_odi()
	{
		$this->cocrun['batting'] = $this->performance['runs'];
		if($this->performance['runs'] >= 100)
			$this->cocrun['batting'] += 20;
		else if($this->performance['runs'] >= 50)
			$this->cocrun['batting'] += 5;
		if($this->performance['balls'] > 0)
			$strikerate = ($this->performance['runs']/$this->performance['balls']) * 100;
		else
			$strikerate = 0;
		if($strikerate >= 121)
			$this->cocrun['batting'] += 10;
		else if($strikerate > 100 && $strikerate <= 120)
			$this->cocrun['batting'] += 5;
		else if($strikerate < 50 && $this->performance['balls'] > 0)
			$this->cocrun['batting'] -= 5;
		$this->cocrun['batting'] += $this->performance['consfour'] * 10;
		$this->cocrun['batting'] += $this->performance['conssix'] * 20;
	}
	
	private function batting_bonus_odi()
	{
		if($this->performance['fours'] >= 10)
			$this->cocrun['battingbonus'] += 15;
		else if($this->performance['fours'] >= 6 && $this->performance['fours'] <= 9)
			$this->cocrun['battingbonus'] += 10;
		else if($this->performance['fours'] >= 3 && $this->performance['fours'] <= 5)
			$this->cocrun['battingbonus'] += 5;
		if($this->performance['sixs'] >= 6)
			$this->cocrun['battingbonus'] += 20;
		else if($this->performance['sixs'] >= 4 && $this->performance['sixs'] <= 5)
			$this->cocrun['battingbonus'] += 15;
		else if($this->performance['sixs'] >= 2 && $this->performance['sixs'] <= 3)
			$this->cocrun['battingbonus'] += 10;
	}
	
	private function bowling_odi()
	{
		$this->cocrun['bowling'] += $this->performance['maiden'] * 6;
		$this->cocrun['bowling'] += $this->performance['wickets'] * 25;
		if($this->performance['wickets'] >= 5)
			$this->cocrun['bowling'] += 20;
		else if($this->performance['wickets'] >= 3)
			$this->cocrun['bowling'] += 10;
			
		if($this->performance['overs'] > 0)
			$economyRate = ($this->performance['rungiven']/$this->performance['overs']) * 6;
		else
			$economyRate = 0;
		if($economyRate >= 7.5)
			$this->cocrun['bowling'] -= 10;
		else if($economyRate < 5 && $this->performance['overs'] != 0)
			$this->cocrun['bowling'] += 10;
			
		$this->cocrun['bowling'] += $this->performance['wide'] * -2;
		$this->cocrun['bowling'] += $this->performance['no_balls'] * -3;
	}
	
	private function fielding_odi()
	{
		if($this->performance['caught'] > 0)
			$this->cocrun['fielding'] += $this->performance['caught']*10;
		if($this->performance['stumped'] > 0)
			$this->cocrun['fielding'] += $this->performance['stumped']*15;
		if($this->performance['runout'] > 0)
			$this->cocrun['fielding'] += $this->performance['runout']*15;		
	}
	
	private function batting_t20()
	{
		$this->cocrun['batting'] = $this->performance['runs'];
		if($this->performance['runs'] >= 100)
			$this->cocrun['batting'] += 20;
		else if($this->performance['runs'] >= 50)
			$this->cocrun['batting'] += 10;			
		else if($this->performance['runs'] >= 30)
			$this->cocrun['batting'] += 5;		
		
		if($this->performance['balls'] > 0)
			$strikerate = ($this->performance['runs']/$this->performance['balls']) * 100;
		else
			$strikerate = 0;
		if($strikerate >=200)
			$this->cocrun['batting'] += 25;
		else if($strikerate >= 141 && $strikerate <= 199)
			$this->cocrun['batting'] += 15;
		else if($strikerate >= 121 && $strikerate <= 140)
			$this->cocrun['batting'] += 10;
		else if($strikerate > 100 && $strikerate <= 120)
			$this->cocrun['batting'] += 5;
		else if($strikerate < 100 && $this->performance['balls'] > 0)
			$this->cocrun['batting'] -= 10;
		$this->cocrun['battingbonus'] += $this->performance['consfour'] * 15;
		$this->cocrun['battingbonus'] += $this->performance['conssix'] * 25;
	}
	
	private function batting_bonus_t20()
	{
		if($this->performance['fours'] >= 10)
			$this->cocrun['battingbonus'] += 20;
		else if($this->performance['fours'] >= 6 && $this->performance['fours'] <= 9)
			$this->cocrun['battingbonus'] += 10;
		else if($this->performance['fours'] >= 3 && $this->performance['fours'] <= 5)
			$this->cocrun['battingbonus'] += 5;
		if($this->performance['sixs'] >= 6)
			$this->cocrun['battingbonus'] += 30;
		else if($this->performance['sixs'] >= 4 && $this->performance['sixs'] <= 5)
			$this->cocrun['battingbonus'] += 20;
		else if($this->performance['sixs'] >= 2 && $this->performance['sixs'] <= 3)
			$this->cocrun['battingbonus'] += 10;
	}
	
	private function bowling_t20()
	{
		$this->cocrun['bowling'] += $this->performance['maiden'] * 10;
		$this->cocrun['bowling'] += $this->performance['wickets'] * 25;
		if($this->performance['wickets'] >= 5)
			$this->cocrun['bowling'] += 30;
		else if($this->performance['wickets'] >= 3)
			$this->cocrun['bowling'] += 15;
		
		if($this->performance['overs'] > 0)
			$economyRate = ($this->performance['rungiven']/$this->performance['overs']) * 6;
		else
			$economyRate = 0;
		if($economyRate >= 10)
			$this->cocrun['bowling'] -= 15;
		else if($economyRate>9.01 && $economyRate <= 9.99)
			$this->cocrun['bowling'] -= 10;
		else if($economyRate>8.01 && $economyRate <= 9)
			$this->cocrun['bowling'] -= 5;
		else if($economyRate>6.01 && $economyRate <= 7)
			$this->cocrun['bowling'] += 10;
		else if($economyRate <= 6 && $this->performance['overs'] != 0)
			$this->cocrun['bowling'] += 15;
		
		$this->cocrun['bowling'] += $this->performance['wide'] * -2;
		$this->cocrun['bowling'] += $this->performance['no_balls'] * -3;
	}
	
	private function fielding_t20()
	{
		if($this->performance['caught'] > 0)
			$this->cocrun['fielding'] += $this->performance['caught']*10;
		if($this->performance['stumped'] > 0)
			$this->cocrun['fielding'] += $this->performance['stumped']*15;
		if($this->performance['runout'] > 0)
			$this->cocrun['fielding'] += $this->performance['runout']*15;
	}
	
	private function batting_test()
	{
		$this->cocrun['batting'] = $this->performance['runs'];
		if($this->performance['runs'] >= 200)
			$this->cocrun['batting'] += 50;
		else if($this->performance['runs'] >= 100)
			$this->cocrun['batting'] += 20;			
		else if($this->performance['runs'] >= 50)
			$this->cocrun['batting'] += 5;
		if($this->performance['balls'] > 0)
			$strikerate = ($this->performance['runs']/$this->performance['balls']) * 100;
		else
			$strikerate = 0;
		if($strikerate >=69 && $this->performance['balls'] > 0)
			$this->cocrun['batting'] += 10;
		$this->cocrun['batting'] += $this->performance['consfour'] * 10;
		$this->cocrun['batting'] += $this->performance['conssix'] * 20;
	}
	
	private function batting_bonus_test()
	{
		if($this->performance['fours'] >= 15)
			$this->cocrun['battingbonus'] += 20;
		else if($this->performance['fours'] >= 10 && $this->performance['fours'] <= 14)
			$this->cocrun['battingbonus'] += 15;
		else if($this->performance['fours'] >= 5 && $this->performance['fours'] <= 9)
			$this->cocrun['battingbonus'] += 10;
		if($this->performance['sixs'] >= 5)
			$this->cocrun['battingbonus'] += 20;
		else if($this->performance['sixs'] >= 3 && $this->performance['sixs'] <= 4)
			$this->cocrun['battingbonus'] += 15;
	}
	
	private function bowling_test()
	{
		$this->cocrun['bowling'] += $this->performance['maiden'] * 6;
		$this->cocrun['bowling'] += $this->performance['wickets'] * 25;
		if($this->performance['wickets'] >= 5)
			$this->cocrun['bowling'] += 25;
		else if($this->performance['wickets'] >= 3)
			$this->cocrun['bowling'] += 15;
	}
	
	private function fielding_test()
	{
		if($this->performance['caught'] > 0)
			$this->cocrun['fielding'] += $this->performance['caught']*10;
		if($this->performance['stumped'] > 0)
			$this->cocrun['fielding'] += $this->performance['stumped']*15;
		if($this->performance['runout'] > 0)
			$this->cocrun['fielding'] += $this->performance['runout']*15;
	}
}