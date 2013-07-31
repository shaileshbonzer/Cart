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
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function testShouldInstantiateWithDefaults()
    {
        $order = new Order();
        $this->assertEquals("Unknown Order", $order->getName(), 'Order instantiated with wrong name');
    }

}