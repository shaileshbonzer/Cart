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

}