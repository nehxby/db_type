<?php
class DB_Type_Exception_Bounds extends DB_Type_Exception_Common
{
	public function __construct(DB_Type_Wrapper_Bounds $type, $given)
	{
		parent::__construct($type, "output", "value within [{$type->getMin()}, {$type->getMax()}]", $given, 0);
	}
}
