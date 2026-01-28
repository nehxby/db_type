<?php

class DB_Type_Pgsql_Path extends DB_Type_Abstract_Primitive
{
	private $_is_closed;

	function __construct($is_closed)
	{
		$this->_is_closed = $is_closed;
	}

	/**
	 * Convert PHP variable to a native format.
	 *
	 * @param mixed $value
	 * @return string|null
	 * @throws DB_Type_Exception_Path
	 * @throws DB_Type_Exception_Point
	 * @throws DB_Type_Exception_Numeric
	 */
	public function output($value)
	{
		if ($value === NULL) return NULL;
		if (!is_array($value)) throw new DB_Type_Exception_Path($this, $value);

		$pointParser = new DB_Type_Pgsql_Point();
		$value = array_map(function ($v) use ($pointParser) {
			return $pointParser->output($v);
		}, $value);

		if ($this->_is_closed) {
			return '(' . join(',', $value) . ')';
		} else {
			return '[' . join(',', $value) . ']';
		}
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

		// [ ( x1 , y1 ) , ... , ( xn , yn ) ]
		// ( ( x1 , y1 ) , ... , ( xn , yn ) )
		if ($this->_is_closed) {
			$value = str_replace(['((', '))'], '', $native);
		} else {
			$value = str_replace(['[(', ')]'], '', $native);
		}

		$values = explode('),(', $value);
		$values = array_map(function ($v) {
			return explode(',', $v);
		}, $values);

		return $values;
	}

	/**
	 * Return native type name for this value.
	 *
	 * @return string
	 */
	public function getNativeType()
	{
		return 'Path';
	}

	public function getEmpty()
	{
		return [];
	}

	/**
	 * @return bool
	 */
	public function isClosed()
	{
		return $this->_is_closed;
	}

	/**
	 * @param bool $is_closed
	 */
	public function setIsClosed($is_closed)
	{
		$this->_is_closed = $is_closed;
	}
}
