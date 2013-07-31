<?php
/*
 * This file is part of the Cart package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rightleaf\Cart;

/**
* Order class for creating generic orders
*/
class Order
{
	private $order;

	public function __construct(OrderSource $source)
	{
		$this->order = $source;
	}

	public function getOrderTotal();

	public function getQtyTotal();

}