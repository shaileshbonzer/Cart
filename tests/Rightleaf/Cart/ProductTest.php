<?php

namespace Rightleaf\Cart\Tests;

use Rightleaf\Cart\Product;

class DefaultProduct extends Product {}

/**
* Product Tests
*/
class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Just making sure we are running
     *
     * @return void
     * @author
     **/
    public function testIsRunning()
    {
        $this->assertTrue(true);
    }

    /**
     * Can the product return the price
     *
     * @return void
     * @author
     **/
    public function testProductReturnsPrice()
    {
        $product = new DefaultProduct();
        $this->assertGreaterThanOrEqual(0, $product->getPrice(), 'Price is not positive integer');
    }

    /**
     * Test Price can be set
     *
     * @return void
     * @author
     **/
    public function testPriceCanBeSet()
    {
        $product = new DefaultProduct();
        $product->setPrice(99);
        $this->assertEquals(99, $product->getPrice(), 'Price set does not match expected');
    }

    /**
     * Product Should throw exception if price is wrong
     *
     * @return void
     * @author
     **/
    public function testProductShouldThrowExceptionIfPriceIsNotPositive()
    {
        $this->setExpectedException('RightLeaf\\Cart\\ProductException', 'Price must be a positive intiger');
        $product = new DefaultProduct();
        $product->setPrice(-99);
    }

    /**
     * product should have an 'Unknown Product' Name
     *
     * @return void
     * @author
     **/
    public function testProductShouldReturnDefaultName()
    {
        $product = new DefaultProduct();
        $this->assertEquals('Unkown Product', $product->getName(), 'Product doesnt return default name');
    }

    /**
     * Product should return a string name
     *
     * @return void
     * @author
     **/
    public function testShouldBeAbleToSetName()
    {
        $product = new DefaultProduct();
        $product->setName('Name I Set');
        $this->assertEquals('Name I Set', $product->getName(), 'Product doesnt return name we set');
    }

    /**
     * Product name should not change if new name is no strlen > 0
     *
     * @return void
     * @author
     **/
    public function testNameShouldNotBeChangedIfBlank()
    {
        $product = new DefaultProduct();
        $product->setName(NULL);
        $this->assertEquals('Unkown Product', $product->getName(), 'Product doesnt return default name');
    }

    /**
     * Set the id...
     *
     * @return void
     * @author
     **/
    public function testIdCanBeSet()
    {
        $product = new DefaultProduct();
        $product->setId('fakeId');
        $this->assertEquals('fakeId', $product->getId() , 'Id was not set right...');
    }

     /**
     * Product Should throw exception if price is wrong
     *
     * @return void
     * @author
     **/
    public function testProductShouldThrowExceptionIfIdIsBlank()
    {
        $this->setExpectedException('RightLeaf\\Cart\\ProductException', 'Id must contain something');
        $product = new DefaultProduct();
        $product->setId(' ');
    }



    /**
     * Set our product up from the construct
     *
     * @return void
     * @author
     **/
    // public function testProductSetupFromConstruct()
    // {
    //     //$product = new DefaultProduct();
    // }


}