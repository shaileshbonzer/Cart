<?php namespace Rightleaf\Cart;

class ProductException extends \Exception {}

abstract Class Product {

    protected $id = NULL;
    protected $price = 0;
    protected $name = 'Unkown Product';
    protected $quantity = 0;


    /**
     * Load up with how many
     *
     * @return void
     * @author
     **/
    public function __construct($quantity = 1)
    {
        $this->setQuantity($quantity);
    }


    /**
     * return current price
     *
     * @return void
     * @author
     **/
    public function getPrice()
    {
        return number_format($this->price);
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
     * @return void
     * @author
     **/
    public function setQuantity($quantity)
    {
        if(!is_numeric($quantity) || $quantity < 1)
        {
            throw new ProductException('Quantity must be a positive intiger > 0');
        }

        $this->quantity = $quantity;
    }

    /**
     * Set the ID
     *
     * @return void
     * @author
     **/
    public function setId ($id)
    {
        if(strlen(trim($id)) <= 0)
        {
            throw new ProductException("Id must contain something");
        }

        $this->id = $id;
    }

    /**
     * Set the price of the product
     *
     * @return void
     * @author
     **/
    public function setPrice($price)
    {
        if(!is_int($price) || $price < 0)
        {
            throw new ProductException("Price must be a positive intiger");
        }

        $this->price = $price;
    }

    /**
     * Set the name
     *
     * @return void
     * @author
     **/
    public function setName($name)
    {
        if(strlen($name) > 0)
        {
            $this->name = $name;
        }

    }



}