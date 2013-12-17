<?php namespace Rightleaf\Cart;

class CouponException extends \Exception {}

abstract Class Coupon
{
	protected $code;

	function __construct($code = NULL)
	{
		$this->setCode($code);
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}
}
