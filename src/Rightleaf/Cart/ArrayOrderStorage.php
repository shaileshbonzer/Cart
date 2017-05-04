<?php namespace Rightleaf\Cart;

use Rightleaf\Cart\OrderStorageInterface;

/**
 * Class ArrayOrderStorage
 * @package Rightleaf\Cart
 */
class ArrayOrderStorage implements OrderStorageInterface
{

    protected $products = array();
    protected $shipping = array();
    protected $coupons = array();
    protected $billing = array();
    protected $product_dependants = array();
    protected $discount = 0;

    /**
     * Save session state
     *
     * @return void
     * @author array();
     **/
    public function save()
    {
        return array(
            'shipping' => $this->shipping,
            'billing' => $this->billing,
            'products' => $this->products,
            'discount' => $this->discount
        );
    }


    /**
     * @param Product $product
     * @param int $qty
     * @return string
     */
    public function addProduct(Product $product, $qty = 1)
    {
        $hash = uniqid();
        while(in_array($hash, $this->products))
        {
            $hash = uniqid();
        }
        $this->products[$hash] = $product;

        return $hash;

    }

    /**
     * Remove a product by it's hash
     *
     * @return void
     * @author
     **/
    public function removeProduct($hash)
    {
        if(!array_key_exists($hash, $this->products))
        {
            throw new OrderStorageException('Cannot remove nonexistant product');
        }

        unset($this->products[$hash]);
    }

    /**
     * Add a coupon by id
     *
     * @return void
     * @author
     **/
    public function addCoupon($couponId)
    {
        if (in_array($couponId, $this->coupons)) {
              throw new OrderStorageException("Coupon already exists.");
        }

        array_push($this->coupons, $couponId);
    }

    /**
     * Remove a coupon by id
     *
     * @return void
     * @author
     **/
    public function removeCoupon($couponId)
    {
        if (!in_array($couponId, $this->coupons)) {
            throw new OrderStorageException("Coupon doesn't exist");
        }

        unset($this->coupons[array_search($couponId, $this->coupons)]);
    }

    public function removeAllCoupons()
    {
        unset($this->coupons);
    }

    /**
     * Save get total items in cart
     *
     * @return void
     * @author
     **/
    public function getTotalItems()
    {
        return count($this->products);
    }

    /**
     * return the product array
     *
     * @return void
     * @author
     *  @TODO this should be SPL interator - but not now...
     **/
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * return the discount applied by coupon
     *
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set discount amount
     *
     * @param $discount
     * @return mixed
     */
    public function setDiscount($discount)
    {
        return $this->discount = $discount;
    }
}