<?php namespace Rightleaf\Cart;

use Rightleaf\Cart\OrderStorageInterface;

/**
 * Class ArrayStorage
 * @package Rightleaf\Cart
 */
class ArrayStorage implements OrderStorageInterface
{

    protected $products = [];
    protected $shipping = [];
    protected $billing = [];

    /**
     * Save session state
     *
     * @return void
     * @author array();
     **/
    public function save()
    {
        return [
            'shipping' => $this->shipping,
            'billing' => $this->billing,
            'products' => $this->products
        ];
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

}