<?php
class DB_Type_Exception_Length extends DB_Type_Exception_Common
{
	public function __construct(DB_Type_Wrapper_Length $type, $given)
	{
		parent::__construct($type, "output", "length within [{$type->getMin()}, {$type->getMax()}]", $given, 0);
	}
}
