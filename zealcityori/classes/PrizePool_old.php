<?php
class PrizePool extends Tournament
{
	public $id;
	public $name;
	public $prize = array();
	private $amount;
	protected 	$table = 'coc_prize_pool';
	protected 	$identifier = 'id';
	
	public function __construct($id, $players, $entry_fee, $kitty)
	{
		//parent::__construct($id);
		$total = $players * $entry_fee;
		$this->amount = ($total) - (($total/100) * $kitty);
		switch($id)
		{
			case 1:
				$this->name="Winner takes all";
				$this->prize[1] = $this->amount;
				break;
			case 2:
				$this->name="Top 3";
				$this->calculateTop3($players);
				break;
			case 3:
				$this->name="Top Few";
				$this->calculateTopFew();
				break;
			case 4:
				$this->name = 'Free Prize 50';
				$this->freePrizes50();
				break;
			case 5:
				$this->name = 'Free Prize 100';
				$this->freePrizes100();
				break;
			case 6:
				$this->name = 'Free Prize 250';
				$this->freePrizes250();
				break;
			case 7:
				$this->name = 'Free Prize 500';
				$this->freePrizes500();
				break;
			case 8:
				$this->name = 'Free Prize 750';
				$this->freePrizes750();
				break;
			case 9:
				$this->name = 'Free Prize 150';
				$this->freePrizes150();
				break;
			case 10:
				$this->name = 'Free Prize 150 - 2';
				$this->freePrizes150_2();
				break;
			case 11:
				$this->name = 'Free Prize 100 - 2';
				$this->freePrizes100_2();
				break;
			case 12:
				$this->name = 'Free Prize 100_50_2';
				$this->freePrizes100_50_2();
				break;
			case 13:
				$this->name = 'Free Prize 600_300_150_100_50_25';
				$this->freePrizes600_300_150_100_50_25();
				break;
			case 14:
				$this->name = 'Free Prize 250_150_100';
				$this->freePrizes250_150_100();
				break;
			case 15:
				$this->name = 'Free Prize 500_250_150_100_50_25';
				$this->freePrizes500_250_150_100_50_25_6();
				break;
			case 16:
				$this->name = 'Top few 200_125_75_50_25_25';
				$this->Topfew200_125_75_50_25_25();
				break;			
			case 17:
				$this->name = 'Free Prize 150_100_50';
				$this->FreePrize150_100_50();
				break;
		}		
	}
	
	private function calculateTop3($players)
	{
		if($players <= 15)
		{
			$this->prize[1] = (int)(($this->amount/100) * 66);
			$this->prize[2] = (int)(($this->amount/100) * 33);
		}
		else if($players > 15)
		{
			$this->prize[1] = (int)(($this->amount/100) * 50);
			$this->prize[2] = (int)(($this->amount/100) * 30);
			$this->prize[3] = (int)(($this->amount/100) * 20);
		}
	}
	
	private function calculateTopFew()
	{
		$this->prize[1] = (int)(($this->amount/100) * 33);
		$this->prize[2] = (int)(($this->amount/100) * 22);
		$this->prize[3] = (int)(($this->amount/100) * 16);
		$this->prize[4] = (int)(($this->amount/100) * 12);
		$this->prize[5] = (int)(($this->amount/100) * 10);
		$this->prize[6] = (int)(($this->amount/100) * 7);
	}
	
	private function freePrizes50()
	{
		$this->prize[1] = (int)(50);
		$this->prize[2] = (int)(50);
		$this->prize[3] = (int)(50);
	}
	
	private function freePrizes100()
	{
		$this->prize[1] = (int)(100);
		$this->prize[2] = (int)(100);
		$this->prize[3] = (int)(100);
	}
	
	private function freePrizes150()
	{
		$this->prize[1] = (int)(150);
		$this->prize[2] = (int)(150);
		$this->prize[3] = (int)(150);
	}
	
	private function freePrizes250()
	{
		$this->prize[1] = (int)(250);
		$this->prize[2] = (int)(250);
	}
	
	private function freePrizes500()
	{
		$this->prize[1] = (int)(500);
	}
	
	private function freePrizes750()
	{
		$this->prize[1] = (int)(750);
	}
	
	private function freePrizes150_2()
	{
		$this->prize[1] = (int)(150);
		$this->prize[2] = (int)(150);
	}
	
	private function freePrizes100_2()
	{
		$this->prize[1] = (int)(100);
		$this->prize[2] = (int)(100);
	}
	
	private function freePrizes100_50_2()
	{
		$this->prize[1] = (int)(100);
		$this->prize[2] = (int)(50);
	}
	
	private function freePrizes600_300_150_100_50_25()
	{
		$this->prize[1] = (int)(600);
		$this->prize[2] = (int)(300);
		$this->prize[3] = (int)(150);
		$this->prize[4] = (int)(100);
		$this->prize[5] = (int)(50);
		$this->prize[6] = (int)(25);
	}
	
	private function freePrizes250_150_100()
	{
		$this->prize[1] = (int)(250);
		$this->prize[2] = (int)(150);
		$this->prize[3] = (int)(100);
	}
	
	private function freePrizes500_250_150_100_50_25_6()
	{
		$this->prize[1] = (int)(500);
		$this->prize[2] = (int)(250);
		$this->prize[3] = (int)(150);
		$this->prize[4] = (int)(100);
		$this->prize[5] = (int)(50);
		$this->prize[6] = (int)(25);
	}
	
	private function Topfew200_125_75_50_25_25()
	{
		$this->prize[1] = (int)(200);
		$this->prize[2] = (int)(125);
		$this->prize[3] = (int)(75);
		$this->prize[4] = (int)(50);
		$this->prize[5] = (int)(25);
		$this->prize[6] = (int)(25);
	}
	
	private function FreePrize150_100_50()
	{
		$this->prize[1] = (int)(150);
		$this->prize[2] = (int)(100);
		$this->prize[3] = (int)(50);
	}
}