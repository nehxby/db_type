<?php

class DB_Type_Exception_Path extends DB_Type_Exception_Common
{
	public function __construct(DB_Type_Abstract_Base $type, $given)
	{
		parent::__construct($type, "output", "array of Point", $given, 0);
	}
}
