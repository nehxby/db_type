<?php

class DB_Type_Pgsql_Polygon extends DB_Type_Pgsql_Path
{
	function __construct()
	{
		parent::__construct(TRUE);
	}

	/**
	 * Return native type name for this value.
	 *
	 * @return string
	 */
	public function getNativeType()
	{
		return 'Polygon';
	}

	/**
	 * @param bool $is_closed
	 * @throws Exception
	 */
	public function setIsClosed($is_closed)
	{
		if (!$is_closed) {
			throw new Exception('Polygon must be closed!');
		}
		parent::setIsClosed($is_closed);
	}
}
