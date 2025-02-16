<?php

require_once 'CartItem.php';

class Cart
{

    private array $cartItems = [];

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param int $quantity
     * @return void
     */
    public function addProduct(Product $product, int $quantity = 1): void
    {
        $productId = $product->getId();
        // isset() trong PHP được sử dụng để kiểm tra xem một biến có được khai báo và có giá trị khác NULL hay không.

        // kiểm tra bên trong Cart đã có sản phẩm đó chưa sử dụng isset()
        if (isset($this->cartItems[$productId])) {
            // lấy ra sản phẩm đó
            $currentQuantity = $this->cartItems[$productId]->getQuantity();

            $this->cartItems[$productId]->setQuantity($currentQuantity + $quantity);
        } else {
            $this->cartItems[$productId] = new CartItem($product, $quantity);
        }
    }

    /**
     * remove product in cart
     *
     * @param int $productId
     * @return void
     */
    public function removeProduct(int $productId): void
    {
        if (isset($this->cartItems[$productId])) {
            unset($this->cartItems[$productId]);
        }
    }

    /**
     * total price for cart
     *
     * @return float
     */
    public function getToTalCart(): float {
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
    public function displayCart(): void {
        foreach ($this->cartItems as $cartItem) {
            $product = $cartItem->getProduct();

            echo $product->getName()
                . " - Số lượng: " . $cartItem->getQuantity()
                . " - Giá: " . $cartItem->getTotalPrice() . " VND" . PHP_EOL;
        }

        echo "Tổng tiền: " . $this->getToTalCart() . " VND" . PHP_EOL;
    }
}
