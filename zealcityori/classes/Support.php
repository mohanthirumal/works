<?php
class Support extends ObjectModel
{
	public $id;
	public $name;
	public $email;
	public $content;
	protected 	$table = 'coc_support';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	
	public function getFields()
	{
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['name'] = pSQL($this->name);
		$fields['email'] = pSQL($this->email);
		$fields['content'] = pSQL($this->content);
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
		$this->secure_key = md5(uniqid(rand(), true));
	 	if (!parent::add($autodate, $nullValues))
			return false;
		return true;
	}
	
	public function update($nullValues = false)
	{
	 	return parent::update(true);
	}
}