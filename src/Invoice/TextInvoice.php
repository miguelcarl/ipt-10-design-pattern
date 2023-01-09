<?php

namespace App\Invoice;

use App\Invoice\InvoiceStrategy;
use App\Order\Order;

class TextInvoice implements InvoiceStrategy
{
	public function generate(Order $order)
	{
		echo "Text Invoice\n";
		echo "Customer: {$order->getName()} <{$order->getEmail()}>\n";
		echo "-----------------Order Items------------------\n";
		foreach ($order->getItems() as $itemData)
		{
			$item = $itemData['item'];
			$quantity = $itemData['quantity'];

			echo $item->getName() . "\t" . $quantity . "\t" . $item->getPrice() . "\t=\t" . ($quantity * $item->getPrice()) . "\n";
		}
		echo "\t\tTotal\t=\t" . $order->getTotal() . "\n";
	}
}