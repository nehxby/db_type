<?php

class DB_Type_Exception_Point extends DB_Type_Exception_Common
{
	public function __construct(DB_Type_Abstract_Base $type, $given)
	{
		parent::__construct($type, "output", "array with two numbers", $given, 0);
	}
}
