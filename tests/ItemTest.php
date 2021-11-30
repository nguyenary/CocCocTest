<?php

namespace Tests;

use App\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private ?Item $item;

    public function __construct()
    {
        parent::__construct();

        $data = ['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1];

        $this->item = new Item($data);
    }

    public function testGetPrice()
    {
        $expected = 1000;

        $this->assertEquals($expected, $this->item->getPrice());
    }

    public function testGetWeight()
    {
        $expected = 2;

        $this->assertEquals($expected, $this->item->getWeight());
    }

    public function testGetWidth()
    {
        $expected = 5;

        $this->assertEquals($expected, $this->item->getWidth());
    }

    public function testGetDepth()
    {
        $expected = 1;

        $this->assertEquals($expected, $this->item->getDepth());
    }

    public function testGetType()
    {
        $expected = 'phone';

        $this->assertEquals($expected, $this->item->getType());
    }

    public function testGetProductTypeFee()
    {
        $data = ['type' => 'phone', 'price' => 1000, 'weight' => 2, 'width' => 5, 'height' => 5, 'depth' => 1];

        $item = new Item($data);

        $expected = 0;

        $this->assertEquals($expected, $item->getProductTypeFee());

        $item->setProductTypeFee(1000);

        $expected = 1000;

        $this->assertEquals($expected, $item->getProductTypeFee());
    }

    public function testGetHeight()
    {
        $expected = 5;

        $this->assertEquals($expected, $this->item->getHeight());
    }

    public function testGetSize()
    {
        $expected = 25;

        $this->assertEquals($expected, $this->item->getSize());
    }
}
