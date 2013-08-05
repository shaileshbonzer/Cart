<?php

namespace Rightleaf\Cart\Tests;

use Rightleaf\Cart\Order;
use Rightleaf\Cart\Product;

use \Mockery as m;


/**
* Product Tests
*/
class OrderTest extends \PHPUnit_Framework_TestCase {

    /**
     * test we load up ok.
     *
     * @return void
     * @author
     **/
    public function testShouldInstantiateWithDefaults()
    {
        $order = new Order();
        $this->assertEquals("Unknown Order", $order->getName(), 'Order instantiated with wrong name');
    }

    /**
     * Should setup with no products... duh.
     *
     * @return void
     * @author
     **/
    public function testWeHaveNoProductsByDefault()
    {
        $order = new Order();
        $this->assertEquals(0, $order->totalItems(), 'There should have been 0 items in order');
    }

    /**
     * Test adding a product to an order
     *
     * @return void
     * @author
     **/
    public function testWeCanAddAProduct()
    {
        $order = new Order();
        $product = \Mockery::mock("Rightleaf\Cart\Product");

        $order->addProduct($product);

        $this->assertEquals(1, $order->totalItems());
    }

    /**
     * Calculate product totals
     *
     * @return void
     * @author
     **/
    public function testOrderShouldCalculateProductTotals()
    {
        $expectedTotal  = 0;
        $totalProductsToTest  = rand(2,10);

        $order = new Order();

        for($i = 0; $i<=$totalProductsToTest; $i++)
        {
            $prodPrice = rand(1, 999);
            $expectedTotal += $prodPrice;

            $prod = \Mockery::mock("Rightleaf\Cart\Product");
            $prod->shouldReceive('getPrice')->andReturn($prodPrice);

            $order->addProduct($prod);

        }

        $this->assertEquals($expectedTotal, $order->subTotal(), 'Subtotal Didnt Match');

    }

}