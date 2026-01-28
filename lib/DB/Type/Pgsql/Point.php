<?php

class DB_Type_Pgsql_Point extends DB_Type_Abstract_Primitive
{

	function __construct()
	{
	}

	/**
	 * Convert PHP variable to a native format.
	 *
	 * @param mixed $value
	 * @return string|null
	 * @throws DB_Type_Exception_Point
	 * @throws DB_Type_Exception_Numeric
	 */
	public function output($value)
	{
		if ($value === NULL) return NULL;
		if (!is_array($value)) throw new DB_Type_Exception_Point($this, $value);
		if (sizeof($value) !== 2) throw new DB_Type_Exception_Point($this, $value);

		$numericParser = new DB_Type_Numeric();
		$value[0] = $numericParser->output($value[0]);
		$value[1] = $numericParser->output($value[1]);

		return '(' . join(',', $value) . ')';
	}

	/**
	 * Parse a native value into PHP variable.
	 * Throws exception if parsing process is finished
	 * before the string is ended.
	 *
	 * @param string $native
	 * @return mixed
	 */
	public function input($native, $for = '')
	{
		if (empty($native)) return NULL;

		// ( x , y )
		$value = str_replace(['(', ')'], '', $native);
		return explode(',', $value);
	}

	/**
	 * Return native type name for this value.
	 *
	 * @return string
	 */
	public function getNativeType()
	{
		return 'Point';
	}

	public function getEmpty()
	{
		return [0, 0];
	}
}
