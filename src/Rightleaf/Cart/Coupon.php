<?php namespace Rightleaf\Cart;

class CouponException extends \Exception {}

abstract Class Coupon
{
	protected $id;
	protected $name;
	protected $code;
	protected $order_id;
	protected $redeemed_order_id;
	protected $rules;

	function __construct($id = 1, $name = 'New Coupon', $code = substr(md5(uniqid()), 8), $order_id = 0, $redeemed_order_id = NULL, $rules = array())
	{
		$this->setId($id);
		$this->setName($name);
		$this->setCode($code, 8);
		$this->setOrderId($order_id);
		$this->setRedeemedOrderId($redeemed_order_id);
		$this->setRules($rules);
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getOrderId()
	{
		return $this->orderId;
	}

	public function getRedeemedOrderId()
	{
		if(is_null($this->redeemed_order_id))
		{
			return false;
		}

		return $this->redeemed_order_id;
	}

	public function getRules()
	{
		if(empty($this->rules))
		{
			throw new CouponException("Rules cannot be empty.");
		}

		return unserialize($this->rules);
	}

	public function setId($id)
	{
		if(strlen(trim($id)) <= 0)
		{
		    throw new CouponException("Id must be provided.");
		}

		$this->id = $id;
		return $this;
	}

	public function setName($name)
	{
		if(strlen(trim($name)) <= 0)
		{
		    throw new CouponException("Name must be set.");
		}

		$this->name = $name;
		return $this;
	}

	public function setCode($code, $length)
	{
		if(!preg_match('/^[a-f0-9]{' . $l . '}$/', $code))
		{
			throw new CouponException("Coupon Code must only contain letters and numbers.");
		}

		$this->code = $code;
		return $this;
	}

	public function setOrderId($order_id)
	{
		if(strlen(trim($order_id)) <= 0)
		{
		    throw new CouponException("Order ID must be set.");
		}

		$this->order_id = $order_id;
		return $this;
	}

	public function setRedeemedOrderId($redeemed_order_id)
	{
		if($redeemed_order_id != NULL || strlen(trim($order_id)) <= 0)
		{
			throw new CouponException("Redeemed Order ID must be set or null.");
		}

		$this->redeemed_order_id = $redeemed_order_id;
		return $this;
	}

	public function setRule($rule)
	{
		if(!is_array($rule))
		{
			throw new CouponException("New rules must be an array");
		}

		$rules = $this->getRules();

		array_push($rules, $rule);

		$this->rules = serialize($rules);
		return $this;
	}
}
