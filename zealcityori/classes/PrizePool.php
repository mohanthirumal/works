<?php
class PrizePool extends Tournament
{
	public $id;
	public $name;
	public $prize_amount;
	public $prize = array();
	public $prizes_array = array();
	public $amount;
	public $min;
	public $max;
	protected 	$table = 'coc_prize_pool';
	protected 	$identifier = 'id';
	
	public function __construct($id, $players = NULL, $entry_fee = NULL, $kitty = NULL, $user = NULL)
	{
		if($id)
		{
			parent::__construct($id);
			if($user)
			{
				$prizes = new PrizePool($id);
				$player = new players($players);
				if($player->player >= $prizes->min && $player->player <= $prizes->max)
				{
					$entryFee = new EntryFee($entry_fee);
					$entry_fee = $entryFee->amount;
					$this->amount = $entry_fee * $player->player;
					$this->calculateCashPrize();
				}
			}
			else if($players)
			{
				$total = $players * $entry_fee;
				$this->amount = ($total) - (($total/100) * $kitty);
				if($entry_fee == 0)
					$this->dbprizes($id);
				else
					$this->calculatePrize($players);
			}
		}
	}
	
	
	
	private function dbprizes($id)
	{
		$sql = 'SELECT prize_amount FROM coc_prize_pool where id = '.$id.'';
		$ress = Db::getInstance()->ExecuteS($sql);
		
		$this->prizes_array = explode(',',$ress[0]['prize_amount']);
		
		for($i=1;$i<=count($this->prizes_array);$i++)
		{
			$this->prize[$i] = $this->prizes_array[$i-1];
		}
	}
	
	private function calculatePrize($players)
	{
		if($this->name == 'Top 3')
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
		else if($this->name == 'Winner takes all')
		{
			$this->prize[1] = $this->amount;
		}
		else if($this->name == 'Top few')
		{
			$this->prize[1] = (int)(($this->amount/100) * 33);
			$this->prize[2] = (int)(($this->amount/100) * 22);
			$this->prize[3] = (int)(($this->amount/100) * 16);
			$this->prize[4] = (int)(($this->amount/100) * 12);
			$this->prize[5] = (int)(($this->amount/100) * 10);
			$this->prize[6] = (int)(($this->amount/100) * 7);
		}
		else if($this->name=='Free Prize')
		{
			$this->prize[1] = (int)(50);
			$this->prize[2] = (int)(50);
			$this->prize[3] = (int)(50);
		}
	}
	
	public function calculateCashPrize()
	{
		if($this->name == 'Top 3')
		{
			$this->prize[0] = (int)(($this->amount/100) * 40);
			$this->prize[1] = (int)(($this->amount/100) * 25);
			$this->prize[2] = (int)(($this->amount/100) * 15);
		}
		else if($this->name == 'Top 2')
		{
			$this->prize[0] = (int)(($this->amount/100) * 50);
			$this->prize[1] = (int)(($this->amount/100) * 30);
		}
		else if($this->name == 'Winner takes all')
		{
			$this->prize[0] = (int)(($this->amount/100) * 80);
		}
		else if($this->name == 'Top few')
		{
			$this->prize[0] = (int)(($this->amount/100) * 29);
			$this->prize[1] = (int)(($this->amount/100) * 19);
			$this->prize[2] = (int)(($this->amount/100) * 14);
			$this->prize[3] = (int)(($this->amount/100) * 12);
			$this->prize[4] = (int)(($this->amount/100) * 6);
		}
	}
	
	public function getUserPrizePoolList()
	{
		$sql = 'SELECT id, name FROM coc_prize_pool WHERE user_type = 1';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	
}