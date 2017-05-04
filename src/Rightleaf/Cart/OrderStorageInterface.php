<?php namespace Rightleaf\Cart;
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class OrderStorageException extends \Exception
{

}

/**
* Source Class
*/
interface OrderStorageInterface
{

    public function save();

    public function addProduct(Product $prodcut, $qty = 1);
    public function removeProduct($hash);
    public function addCoupon($couponId);
    public function removeCoupon($couponId);
    public function removeAllCoupons();

    public function getTotalItems();
    public function getProducts();

    public function getDiscount();
    public function setDiscount($discount);
}
