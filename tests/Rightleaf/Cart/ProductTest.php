<?php namespace Rightleaf\Cart\Tests;

use Rightleaf\Cart\Product;

class DefaultProduct extends Product
{

}

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

    public function testPriceCanBeOverridden()
    {
        $product = new DefaultProduct();
        $product->setPrice(99);
        $this->overridePrice(100);
        $this->assertEquals(100, $product->getPrice(), 'Price set does not match expected');
    }

    /**
     * Default Quantity should be 1
     *
     * @return void
     * @author
     **/
    public function testDefaultQuantity()
    {
        $product = new DefaultProduct();
        $this->assertSame(1, $product->getQuantity(), 'Did not default to 1');
    }

    /**
     * Can we override the quantity
     *
     * @return void
     * @author
     **/
    public function testQuantityCanBeSet()
    {
        $product = new DefaultProduct();
        $product->setQuantity(20);

        $this->assertEquals(20, $product->getQuantity());
    }

    /**
     * Can we confuse the quantity
     *
     * @return void
     * @author
     **/
    public function testQuantityHasToBeNumeric()
    {
        $this->setExpectedException('RightLeaf\\Cart\\ProductException', 'Quantity must be a positive integer > 0');
        $product = new DefaultProduct(-20, 'Test', 1,'foo');
    }

    /**
     * Can we confuse the quantity
     *
     * @return void
     * @author
     **/
    public function testQuantityHasToBePositive()
    {
        $this->setExpectedException('RightLeaf\\Cart\\ProductException', 'Quantity must be a positive integer > 0');
        $product = new DefaultProduct(-20, 'Test', 1,1);
        //$product->setQuantity(-20);
    }

    /**
     * Product Should throw exception if price is wrong
     *
     * @return void
     * @author
     **/
    public function testProductShouldThrowExceptionIfPriceIsNotPositive()
    {
        $this->setExpectedException('RightLeaf\\Cart\\ProductException', 'Price must be a positive integer');
        $product = new DefaultProduct(1, 'Unknown Product', -22,1);
    }

    /**
     * product should have an 'Unknown Product' Name
     *
     * @return void
     * @author
     **/
    public function testProductShouldReturnDefaultName()
    {
        $product = new DefaultProduct(1, 'Unkown Product', 0,1);
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
        $product = new DefaultProduct(1, 'Unknown Product', 1,1);
        $product->setName(NULL);
        $this->assertEquals('Unknown Product', $product->getName(), 'Product doesnt return default name');
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
     * Testing changing quantity and price on the fly
     *
     * @return void
     * @author
     **/
    public function testCanCalculateOnTheFly()
    {
        $product = new DefaultProduct(2);
        $product->setQuantity(10);
        $product->setPrice(10);
        $this->assertEquals(100, $product->getLineTotal());
    }



    /**
     * Set our product up from the construct
     *
     * @return void
     * @author
     **/
     public function testProductSetupFromConstruct()
     {
         $product = new DefaultProduct(1, 'Test', 2, 1);

         $output = array(
             'id' => $product->getId(),
             'name' => $product->getName(),
             'quantity' => $product->getQuantity(),
             'price' => $product->getPrice()
         );
         $this->assertEquals($output, array('id' => 1,
                                           'name' => 'Test',
                                           'quantity' => 1,
                                           'price' => 2));
     }


}