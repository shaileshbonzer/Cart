<?php namespace Rightleaf\Cart;

class ProductException extends \Exception {}

abstract Class Product {

    protected $id = NULL;
    protected $price = 0;
    protected $name = 'Unkown Product';


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