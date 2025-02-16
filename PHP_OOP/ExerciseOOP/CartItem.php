<?php

namespace ExerciseOOP;

class CartItem
{
    public function __construct(
        private Item $item,
        private int  $quantity,
    )
    {
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->quantity * $this->getItem()->getPrice();
    }
}