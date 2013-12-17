<?php namespace Rightleaf\Cart;

use Rightleaf\Cart\CouponInterface;

/**
* Redeemable Coupon for 1 free item
* @package  Rightleaf\Cart
*/
class RedeemableCoupon extends Coupon implements CouponInterface {

	function setCouponRule($product_id, $new_product_price)
	{
		return $this->setRules(array($product_id => $new_product_price));
	}

	function applyCoupon(OrderStorageInterface $order)
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

	function removeCoupon(OrderStorageInterface $order)
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

	function redeemCoupon($coupon_id)
	{
		return $coupon->setRedeemedOrderId($id);
	}
}