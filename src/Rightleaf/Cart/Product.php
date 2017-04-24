<?php namespace Rightleaf\Cart;

class ProductException extends \Exception {}

abstract Class Product {

    protected $id = NULL;
    protected $price = 0;
    protected $originalPrice = 0;
    protected $name = 'Unkown Product';
    protected $quantity = 0;
    protected $type = 'Unkown Type';

    /**
     * Product constructor.
     * @param int $quantity
     * @param string $name
     * @param int $price
     * @param int $id
     * @param string $type
     */
    public function __construct($quantity = 1, $name = 'Foo', $price = 1, $id = 1, $type = 'Foo')
    {
        $this->setId($id);
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setType($type);
    }


    /**
     * return current price
     *
     * @return void
     * @author
     **/
    public function getPrice()
    {
        return preg_replace("/[^0-9.-]/", "", $this->price);
    }

    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    /**
     * Get the product's name
     *
     * @return void
     * @author
     **/
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the product's Id
     *
     * @return void
     * @author
     **/
    public function getId()
    {
        return $this->id;
    }

    /**
     * get the products quantity
     *
     * @return void
     * @author
     **/
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the product's type
     *
     * @return void
     * @author
     **/
    public function getType()
    {
        return $this->type;
    }

    /**
     * Return the value of this * qty
     *
     * @return void
     * @author
     **/
    public function getLineTotal()
    {
        return $this->getQuantity() * $this->getPrice();
    }

    /**
     * Set the quantity
     *
     * @param $quantity
     * @return void
     * @author
     * @throws ProductException
     */
    public function setQuantity($quantity)
    {
        if(!is_int($quantity) || $quantity < 0)
        {
            throw new ProductException('Quantity must be a positive integer > 0');
        }

        $this->quantity = $quantity;
    }

    /**
     * Set the ID
     *
     * @param $id
     * @return $this
     * @author
     * @throws ProductException
     */
    public function setId ($id)
    {
        if(strlen(trim($id)) <= 0)
        {
            throw new ProductException("Id must contain something");
        }

        $this->id = $id;
        return $this;
    }

    /**
     * Set the price of the product
     *
     * @param $price
     * @return $this
     * @author
     * @throws ProductException
     */
    public function setPrice($price)
    {

        $price = preg_replace("/[^0-9.-]/", "", $price);
        if(!is_numeric($price) || $price < 0)
        {
            throw new ProductException("Price must be a positive integer");
        }

        if($this->originalPrice === 0)
        {
            $this->originalPrice = $price;
        }

        $this->price = $price;
        return $this;
    }

    /**
     * Set the name
     *
     * @param $name
     * @return $this
     * @author
     */
    public function setName($name)
    {
        if(strlen($name) > 0)
        {
            $this->name = $name;
        }
        return $this;

    }

    /**
     * Set the type
     *
     * @param $type
     * @return $this
     * @author
     */
    public function setType($type)
    {
        if(strlen($type) > 0)
        {
            $this->type = $type;
        }
        return $this;

    }
}