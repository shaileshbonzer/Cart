<?php namespace Rightleaf\Cart\Tests;

use Rightleaf\Cart\Order;
use Rightleaf\Cart\Product;
use Rightleaf\Cart\ArrayStorage;

use \Mockery as m;


/**
* Storage Tests
*/
class ArrayStorageTest extends \PHPUnit_Framework_TestCase {

    /**
     * Make sure app returns a clean formatted array
     *
     * @return void
     * @author
     **/
    public function testShouldReturnBlankStructurdArrayOnSave()
    {
        $storage = new ArrayStorage();
        $this->assertEquals(
                ['products'=>[],
                 'shipping'=>[],
                 'billing'=>[]
                 ], $storage->save(), 'Array Storage Structure Messed Up');
    }


    /**
     * Make sure app returns a clean formatted array after loading some products
     *
     * @return void
     * @author
     **/
    public function testShouldReturnStructurdArrayOnSave()
    {
        $storage = new ArrayStorage();
        $product = m::mock("Rightleaf\\Cart\\Product");
        $hash = $storage->addProduct($product);

        $this->assertEquals(
                ['products'=>[$hash=>$product],
                 'shipping'=>[],
                 'billing'=>[]
                 ], $storage->save(), 'Array Storage Structure Messed Up');
    }

    /**
     * Add a product
     *
     * @return void
     * @author
     **/
    public function testShouldBeAbleToAddSingleProduct()
    {
        $storage = new ArrayStorage();

        $product = m::mock("Rightleaf\\Cart\\Product");
        $hash = $storage->addProduct($product);
        $this->assertSame(1, $storage->getTotalItems() , "Added product wasn't added");
        $this->assertNotNull($hash, 'Product hash not returned');
    }

    /**
     * Storage Should throw exception if you try to remove a product not in the array
     *
     * @return void
     * @author
     **/
    public function testShouldExpectExceptionWhenRemovingNonProduct()
    {
        $this->setExpectedException('RightLeaf\\Cart\\OrderStorageException', 'Cannot remove nonexistant product');
        $storage = new ArrayStorage();
        $storage->removeProduct('12345');
    }

    /**
     * Remove a product
     *
     * @return void
     * @author
     **/
    public function testShouldBeAbleToRemoveANewProduct()
    {
        $storage = new ArrayStorage();

        $product = m::mock("Rightleaf\\Cart\\Product");
        $hash = $storage->addProduct($product);
        $storage->removeProduct($hash);
        $this->assertSame(0, $storage->getTotalItems(), 'Product Wast removed');
    }

    /**
     * Return a bunch of products
     *
     * @return void
     * @author
     **/
    public function testShouldReturnAllProducts()
    {
        $storage = new ArrayStorage();
        $howMany = 1;

        $product  = m::mock("Rightleaf\\Cart\\Product");
        $storage->addProduct($product);

        $this->assertEquals($howMany, count($storage->getProducts()), 'Total added doesnt match total received');
    }


}