<?php

use App\Order;

require_once (__DIR__ . '/vendor/autoload.php');

$order = new Order();

$order->setWeightCoefficient(10);
$order->setDimensionCoefficient(10);

$order->add(['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1]);
$order->add(['type' => 'diamond', 'price' => 2000, 'weight' => 10, 'width' => 10, 'height' => 2, 'depth' => 2]);

$order->setProductTypeFee('phone', 1000);

var_dump('Fee: ' . $order->getShippingFeeTotal(), 'Total: ' . $order->getSubTotal());
