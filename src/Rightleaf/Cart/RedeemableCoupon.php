<?php namespace Rightleaf\Cart;

use Rightleaf\Cart\CouponInterface;

/**
* Redeemable Coupon for 1 free item
* @package  Rightleaf\Cart
*/
class RedeemableCoupon extends Coupon implements CouponInterface {

	public function setCouponRules($id, $new_price)
	{
		return $this->setRules(array($id => $new_price));
	}

	public function applyCoupon(Order $order)
	{
		$products = $order->getProducts();
		$couponRules = $this->getRules();

		foreach ($products as $id => $product) {
			foreach ($couponRules as $product_id => $price) {
				if ($id == $product_id) {
					$product->setPrice($price);
				}
			}
		}
	}

	public function removeCoupon(Order $order)
	{
		$products = $order->getProducts();
		$couponRules = $this->getRules();

		foreach ($products as $id => $product) {
			foreach ($couponRules as $product_id => $price) {
				if ($id == $product_id) {
					$product->setPrice($product->getOriginalPrice());
				}
			}
		}

	}

	public function redeemCoupon($coupon_id)
	{
		return $coupon->setRedeemedOrderId($id);
	}
}