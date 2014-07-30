<?php
class ObjectModel
{
	public $id = NULL;
	protected $table = NULL;
	protected $identifier = NULL;
	public function __construct($id = NULL)
	{
		if($id)
		{
			$sql = 'SELECT * FROM `'.$this->table.'` a WHERE a.`'.$this->identifier.'` = '.(int)($id);
			$result = Db::getInstance()->ExecuteS($sql);
			if($result)
			{
				$this->id = (int)($id);
				foreach ($result AS $row)
					foreach ($row AS $key => $value)
						if (key_exists($key, $this))
							$this->{$key} = $value;
			}
		}
	}
	
	/**
	 * Save current object to database (add or update)
	 *
	 * return boolean Insertion result
	 */
	public function save($nullValues = false, $autodate = true)
	{
		return (int)($this->id) > 0 ? $this->update($nullValues) : $this->add($autodate, $nullValues);
	}

	/**
	 * Add current object to database
	 *
	 * return boolean Insertion result
	 */
	public function add($autodate = true, $nullValues = false)
	{
	 	if (!Validate::isTableOrIdentifier($this->table))
			die(Tools::displayError('not table or identifier : ').$this->table);

		/* Automatically fill dates */
		if ($autodate AND key_exists('date_add', $this))
			$this->date_add = date('Y-m-d H:i:s');
		if ($autodate AND key_exists('date_upd', $this))
			$this->date_upd = date('Y-m-d H:i:s');

		/* Database insertion */
		if ($nullValues)
			$result = Db::getInstance()->autoExecuteWithNullValues($this->table, $this->getFields(), 'INSERT');
		else
			$result = Db::getInstance()->autoExecute($this->table, $this->getFields(), 'INSERT');

		if (!$result)
			return false;
		/* Get object id in database */
		$this->id = Db::getInstance()->Insert_ID();		
		return $result;
	}

	/**
	 * Update current object to database
	 *
	 * return boolean Update result
	 */
	public function update($nullValues = false)
	{
	 	if (!Validate::isTableOrIdentifier($this->identifier) OR !Validate::isTableOrIdentifier($this->table))
			die(Tools::displayError());


		/* Automatically fill dates */
		if (key_exists('date_upd', $this))
			$this->date_upd = date('Y-m-d H:i:s');

		/* Database update */
		if ($nullValues)
			$result = Db::getInstance()->autoExecuteWithNullValues($this->table, $this->getFields(), 'UPDATE', '`'.pSQL($this->identifier).'` = '.(int)($this->id));
		else
			$result = Db::getInstance()->autoExecute($this->table, $this->getFields(), 'UPDATE', '`'.pSQL($this->identifier).'` = '.(int)($this->id));
		if (!$result)
			return false;
		
		return $result;
	}

	/**
	 * Delete current object from database
	 *
	 * return boolean Deletion result
	 */
	public function delete()
	{
	 	if (!Validate::isTableOrIdentifier($this->identifier) OR !Validate::isTableOrIdentifier($this->table))
	 		die(Tools::displayError());

		$this->clearCache();

		/* Database deletion */
		$result = Db::getInstance()->Execute('DELETE FROM `'.pSQL($this->table).'` WHERE `'.pSQL($this->identifier).'` = '.(int)($this->id));
		if (!$result)
			return false;
		
		return $result;
	}

	/**
	 * Delete several objects from database
	 *
	 * return boolean Deletion result
	 */
	public function deleteSelection($selection)
	{
		if (!is_array($selection) OR !Validate::isTableOrIdentifier($this->identifier) OR !Validate::isTableOrIdentifier($this->table))
			die(Tools::displayError());
		$result = true;
		foreach ($selection AS $id)
		{
			$this->id = (int)($id);
			$result = $result AND $this->delete();
		}
		return $result;
	}	
}