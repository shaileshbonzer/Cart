<?php namespace Rightleaf\Cart;
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class OrderException extends \Exception {}

/**
* Order class for creating generic orders
*/
class Order
{
    protected $orderStorage;

    public function __construct(OrderStorageInterface $orderStorage)
    {
        $this->orderStorage = $orderStorage;
    }

    /**
     * give us back the total items
     *
     * @return void
     * @author
     **/
    public function totalItems()
    {
        return $this->orderStorage->getTotalItems();
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->orderStorage->getProducts();
    }

    /**
     * Calculate the subtotal
     *
     * @return void
     * @author
     **/
    public function subTotal()
    {
        return $this->orderStorage->subTotal();
    }

    /**
     * Get discount applied
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->orderStorage->getDiscount();
    }

    /**
     * Set discount for order
     *
     * @param $discount
     * @return mixed
     */
    public function setDiscount($discount)
    {
        return $this->orderStorage->setDiscount($discount);
    }

    /**
     * Add Item to a product
     *
     * @return void
     * @author
     **/
    public function addProduct(Product $product)
    {
        return $this->orderStorage->addProduct($product);
    }

    /**
     * [addCoupon description]
     * @param integer $couponId coupon id
     */
    public function addCoupon($couponId)
    {
        return $this->orderStorage->addCoupon($couponId);
    }

    public function removeCoupon($couponId)
    {
        return $this->orderStorage->removeCoupon($couponId);
    }

    public function removeAllCoupons()
    {
        return $this->orderStorage->removeAllCoupons();
    }

    /**
     * Remove product from cart
     *
     * @return void
     * @author
     **/
    public function removeProduct($hash)
    {
        $this->orderStorage->removeProduct($hash);
    }

    /**
     * Save the order
     *
     * @return void
     * @author
     **/
    public function save()
    {
        return $this->orderStorage->save();
    }

}