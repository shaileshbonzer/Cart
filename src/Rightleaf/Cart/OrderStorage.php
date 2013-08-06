<?php namespace Rightleaf\Cart;
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class OrderStorageException extends \Exception {}

/**
* Source Class
*/
interface OrderStorage
{

    public function save();

    public function addProduct();
    public function getTotalItems();


}
