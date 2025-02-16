<?php

class CartItem
{
    public function __construct(
        private Product $product,
        private int $quantity,
    )
    {}

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function getTotalPrice(): float
    {
        return $this->quantity * $this->getProduct()->getPrice();
    }
}