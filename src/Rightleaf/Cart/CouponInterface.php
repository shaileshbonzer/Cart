<?php namespace Rightleaf\Cart;
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class CouponInterfaceException extends \Exception
{

}

/**
* Source Class
*/
interface CouponInterface
{
	function applyCoupon(Order $order);
}
