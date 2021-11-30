<?php

namespace Tests;

use App\Item;
use App\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private ?Item $item;
    private ?Order $order;

    public function __construct()
    {
        parent::__construct();

        $data = ['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1];

        $this->item = new Item($data);

        // Order Instance
        $order = new Order();

        $order->setWeightCoefficient(11);
        $order->setDimensionCoefficient(11);

        $order->add(['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1]);
        $order->add(['type' => 'diamond', 'price' => 2000, 'weight' => 10, 'width' => 10, 'height' => 2, 'depth' => 2]);

        $order->setProductTypeFee('phone', 1000);

        $this->order = $order;
    }

    public function testGetShippingFeeTotal()
    {
        $expected = 1440;

        $this->assertEquals($expected, $this->order->getShippingFeeTotal());
    }

    public function testGetSubTotal()
    {
        $expected = 4440;

        $this->assertEquals($expected, $this->order->getSubTotal());
    }

    public function testGetItemShippingFee()
    {
        $order = new Order();

        $order->setWeightCoefficient(10);
        $order->setDimensionCoefficient(10);

        $item = $order->add(['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1]);

        $expected = 250;

        $this->assertEquals($expected, $order->getItemShippingFee($item));

        $order->setProductTypeFee('phone', 1000);

        $expected = 1000;

        $this->assertEquals($expected, $order->getItemShippingFee($item));
    }

    public function testGetFeeByDimension()
    {
        $order = new Order();
        $order->setDimensionCoefficient(11);

        $expected = 275;

        $this->assertEquals($expected, $order->getFeeByDimension($this->item));
    }

    public function testAdd()
    {
        $order = new Order();
        $data = ['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1];

        $this->assertInstanceOf(Item::class, $order->add($data));
    }

    public function testSetDimensionCoefficient()
    {
        $order = new Order();
        $order->setDimensionCoefficient(11);

        $expected = 11;

        $this->assertEquals($expected, $order->getDimensionCoefficient());
    }

    public function testGetFeeByWeight()
    {
        $order = new Order();
        $order->setWeightCoefficient(11);

        $expected = 22;

        $this->assertEquals($expected, $order->getFeeByWeight($this->item));
    }

    public function testSetWeightCoefficient()
    {
        $order = new Order();
        $order->setWeightCoefficient(11);

        $expected = 11;

        $this->assertEquals($expected, $order->getWeightCoefficient());
    }

    public function testGetItemPrice()
    {
        $order = new Order();
        $order->setDimensionCoefficient(10);
        $order->setWeightCoefficient(10);

        $data = ['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1];
        $item = $order->add($data);

        $expected = 1250;

        $this->assertEquals($expected, $order->getItemPrice($item));

        $order->setProductTypeFee('phone', 1000);

        $expected = 2000;

        $this->assertEquals($expected, $order->getItemPrice($item));
    }
}
