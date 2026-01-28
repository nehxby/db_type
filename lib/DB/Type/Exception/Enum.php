<?php

class DB_Type_Exception_Enum extends DB_Type_Exception_Common
{
	public function __construct(DB_Type_Pgsql_Enum $type, $given)
	{
		$items = join(',', $type->getItems());
		parent::__construct($type, "output", "one of [$items]", $given, 0);
	}
}
