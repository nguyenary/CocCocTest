<?php

namespace App;

use Exception;

class Item
{
    private string $type;
    private int $price;
    private int $weight;
    private int $width;
    private int $height;
    private int $depth;
    private int $product_type_fee = 0;

    public function __construct(array $data)
    {
        if (!$data) {
            throw new Exception('Data must not be null');
        }

        $this->type = $data['type'];
        $this->price = $data['price'];
        $this->weight = $data['weight'];
        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->depth = $data['depth'];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function getSize(): int
    {
        return $this->width * $this->height * $this->depth;
    }

    public function setProductTypeFee(int $product_type_fee): void
    {
        $this->product_type_fee = $product_type_fee;
    }

    public function getProductTypeFee(): int
    {
        return $this->product_type_fee;
    }
}
