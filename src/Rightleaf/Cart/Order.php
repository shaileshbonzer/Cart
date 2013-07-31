<?php
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rightleaf\Cart;

class OrderException extends \Exception {}

/**
* Order class for creating generic orders
*/
class Order
{
    protected $name = "Unknown Order";
    protected $id = NULL;
    protected $subTotal = 0;
    protected $products = [];

    // public function __construct(OrderSource $source)
    // {
    // $this->order = $source;
    // }

    /**
     * Get the order's name
     *
     * @return void
     * @author
     **/
    public function getName()
    {
        return $this->name;
    }

    /**
     * give us back the total items
     *
     * @return void
     * @author
     **/
    public function totalItems()
    {
        return count($this->products);
    }

    /**
     * Calculate the subtotal
     *
     * @return void
     * @author
     **/
    public function subTotal()
    {
        $this->subTotal = 0;
        foreach($this->products as $p)
        {
            $this->subTotal += $p->getPrice();
        }

        return $this->subTotal;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function addProduct(Product $product)
    {
        array_push($this->products, $product);
    }

}