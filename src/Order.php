<?php

namespace App;

class Order
{
    private array $items = [];
    private int $weight_coefficient;
    private int $dimension_coefficient;

    public function add(array $data): Item
    {
        $item = new Item($data);

        $this->items[] = $item;

        return $item;
    }

    public function setWeightCoefficient(int $weight_coefficient): void
    {
        $this->weight_coefficient = $weight_coefficient;
    }

    public function setDimensionCoefficient(int $dimension_coefficient): void
    {
        $this->dimension_coefficient = $dimension_coefficient;
    }

    public function getWeightCoefficient(): int
    {
        return $this->weight_coefficient;
    }

    public function getDimensionCoefficient(): int
    {
        return $this->dimension_coefficient;
    }

    public function getSubTotal(): int
    {
        return array_sum(array_map(fn (Item $item) => $this->getItemPrice($item), $this->items));
    }

    public function getShippingFeeTotal(): int
    {
        return array_sum(array_map(fn (Item $item) => $this->getItemShippingFee($item), $this->items));
    }

    public function setProductTypeFee(string $type, int $fee): void
    {
        array_walk($this->items, function (Item $item) use ($type, $fee) {
            if ($item->getType() === $type) {
                $item->setProductTypeFee($fee);
            }
        });
    }

    public function getItemPrice(Item $item): int
    {
        return $item->getPrice() + $this->getItemShippingFee($item);
    }

    public function getFeeByWeight(Item $item): int
    {
        return $item->getWeight() * $this->getWeightCoefficient();
    }

    public function getFeeByDimension(Item $item): int
    {
        return $item->getSize() * $this->getDimensionCoefficient();
    }

    public function getItemShippingFee(Item $item): int
    {
        return max($this->getFeeByWeight($item), $this->getFeeByDimension($item), $item->getProductTypeFee());
    }
}
