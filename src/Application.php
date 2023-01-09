<?php

namespace App;

use App\Cart\Item;
use App\Cart\ShoppingCart;
use App\Customer\Customer;
use App\Order\Order;
use App\Invoice\TextInvoice;
use App\Invoice\PDFInvoice;
use App\Payments\CashOnDelivery;
use App\Payments\CreditCardPayment;
use App\Payments\PaypalPayment;

class Application
{
	public static function run()
	{
		$cart = new ShoppingCart();
		$pencil= new Item('School','Mongol Pencil', 10000);
		
		$cart->addItem($pencil, 1);


		$customer = new Customer('Migs', '420 Raul St.', 'miguelito@gmail.com');

		$order = new Order($customer, $cart);

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$textInvoice = new TextInvoice($order);
		$order->setInvoiceGenerator($textInvoice);
		$order->generate();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$pdfInvoice = new PDFInvoice($order);
		$order->setInvoiceGenerator($pdfInvoice);
		$order->generate();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$creditCard = new CreditCardPayment('Migs', '2456-2578-9865-1463', '500', '11/27');
		$order->setPaymentMethod($creditCard);
		$order->pay();

		echo "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		$cod = new CashOnDeliveryStrategy($customer);
		$order->setPaymentMethod($cod);
		$order->pay();

	}
}