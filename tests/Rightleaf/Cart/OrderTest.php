<?php namespace Rightleaf\Cart\Tests;

use Rightleaf\Cart\Order;
use Rightleaf\Cart\Product;

use \Mockery as m;


/**
* Product Tests
*/
class OrderTest extends \PHPUnit_Framework_TestCase {

    /**
     * Should setup with no products... duh.
     *
     * @return void
     * @author
     **/
    public function testWeHaveNoProductsByDefault()
    {
        $mockStorage = m::mock('Rightleaf\Cart\OrderStorageInterface');
        $mockStorage->shouldReceive('getTotalItems')->andReturn(0);
        $order = new Order($mockStorage);
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
        $mockStorage = m::mock('Rightleaf\Cart\OrderStorageInterface');
        $mockStorage->shouldReceive('addProduct')->once();
        $mockStorage->shouldReceive('getTotalItems')->once()->andReturn(1);

        $order = new Order($mockStorage);

        $product = m::mock("Rightleaf\Cart\Product");

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
        $mockStorage = m::mock('Rightleaf\Cart\OrderStorageInterface');
        $mockStorage->shouldReceive('addProduct')->times(3);
        $mockStorage->shouldReceive('getTotalItems')->once()->andReturn(3);
        $order = new Order($mockStorage);

        for($i = 0; $i<=2; $i++)
        {
            $prod = m::mock("Rightleaf\Cart\Product");
            $order->addProduct($prod);

        }

        $mockStorage->shouldReceive('subTotal')->once()->andReturn(99);
        $this->assertEquals(99, $order->subTotal(), 'Subtotal Didnt Match');

    }

    /**
     * Return All Products
     */
    public function testShouldRetunAllProductsOnGet()
    {
        $mockStorage = m::mock('Rightleaf\Cart\ArrayOrderStorage');
        $mockStorage->shouldReceive('addProduct')->times(2);

        $order = new Order($mockStorage);
        $expectedProducts = array();

        for($i = 0; $i<=1; $i++)
        {
            $prod = m::mock("Rightleaf\Cart\Product");
            $hash = $order->addProduct($prod);
            $expectedProducts[$hash] = $prod;
        }

        $mockStorage->shouldReceive('getProducts')
                    ->times(1)
                    ->andReturn($expectedProducts);

        $this->assertEquals($expectedProducts, $order->getProducts(),
                            'Order Didnt Save - Messed Up');
    }

    /**
     * Return all products in orderstorage
     *
     * @return void
     * @author
     **/
    public function testShouldReturnAllProductsOnSave()
    {
        $mockStorage = m::mock('Rightleaf\Cart\ArrayOrderStorage');
        $mockStorage->shouldReceive('addProduct')->times(2);



        $order = new Order($mockStorage);
        $expectedProducts = array();

        for($i = 0; $i<=1; $i++)
        {
            $prod = m::mock("Rightleaf\Cart\Product");
            $hash = $order->addProduct($prod);
            $expectedProducts[$hash] = $prod;
        }

        $mockStorage->shouldReceive('save')->times(1)->andReturn(
            array('products'=>$expectedProducts,
                 'shipping'=>array(),
                 'billing'=>array())
        );

        $this->assertEquals(
                array('products'=>$expectedProducts,
                 'shipping'=>array(),
                 'billing'=>array()
                ), $order->save(), 'Order Didnt Dave Messed Up');

    }
}