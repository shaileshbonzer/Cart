<?php namespace Rightleaf\Coupon;
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class CouponException extends \Exception {}

/**
* Coupon Class
*/
class Coupon
{
	protected $cart;

	function __construct(\Rightleaf\Cart\Order $cart)
	{
		$this->cart = $cart;
	}

	public function setPrice(\Rightleaf\Cart\Product $product, $price)
	{
		$product->setPrice($price);
	}

	public function applyCoupon($hash, $price)
	{
		$products = $this->cart->getProducts();
		$this->setPrice($products[$hash], $price);
		return $this->cart;
	}
}