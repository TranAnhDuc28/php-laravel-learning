<?php

namespace ExerciseOOP;

require_once 'CartItem.php';

class Cart
{

    private array $cartItems = [];

    /**
     * Add product to cart
     *
     * @param Item $item
     * @param int $quantity
     * @return void
     */
    public function addProduct(Item $item, int $quantity = 1): void
    {
        $itemId = $item->getId();
        // isset() trong PHP được sử dụng để kiểm tra xem một biến có được khai báo và có giá trị khác NULL hay không.

        // kiểm tra bên trong Cart đã có sản phẩm đó chưa sử dụng isset()
        if (isset($this->cartItems[$itemId])) {
            // lấy ra sản phẩm đó
            $currentQuantity = $this->cartItems[$itemId]->getQuantity();

            $this->cartItems[$itemId]->setQuantity($currentQuantity + $quantity);
        } else {
            $this->cartItems[$itemId] = new CartItem($item, $quantity);
        }
    }

    /**
     * remove product in cart
     *
     * @param int $itemId
     * @return void
     */
    public function removeProduct(int $itemId): void
    {
        if (isset($this->cartItems[$itemId])) {
            unset($this->cartItems[$itemId]);
        }
    }

    /**
     * total price for cart
     *
     * @return float
     */
    public function getToTalCart(): float
    {
        $total = 0;

        foreach ($this->cartItems as $cartItem) {
            $total += $cartItem->getTotalPrice();
        }

        return $total;
    }

    /**
     * display list cart
     *
     * @return void
     */
    public function displayCart(): void
    {
        foreach ($this->cartItems as $cartItem) {
            $item = $cartItem->getItem();

            echo $item->getName()
                . " - Số lượng: " . $cartItem->getQuantity()
                . " - Giá: " . $cartItem->getTotalPrice() . " VND" . PHP_EOL;
        }

        echo "Tổng tiền: " . $this->getToTalCart() . " VND" . PHP_EOL;
    }
}
