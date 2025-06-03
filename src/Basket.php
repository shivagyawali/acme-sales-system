<?php

namespace Acme;

use Exception;

class Basket
{
    /** @var BasketItem[] */
    private array $items = [];

    public function __construct(
        private Catalog $catalog,
        private DeliveryStrategy $delivery,
        private array $discounts = []
    ) {}

    public function add(string $productCode): void
    {
        $product = $this->catalog->getProduct($productCode);
        if (!$product) {
            throw new Exception("Invalid product code: $productCode");
        }

        foreach ($this->items as $item) {
            if ($item->product->code === $productCode) {
                $item->quantity++;
                return;
            }
        }

        // If not found, add new BasketItem
        $this->items[] = new BasketItem($product, 1);
    }

    public function total(): float
    {
        $subtotal = 0.0;
        foreach ($this->items as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $discountTotal = 0.0;
        foreach ($this->discounts as $strategy) {
            $discountTotal += $strategy->applyDiscount($this->items);
        }

        $totalBeforeDelivery = $subtotal - $discountTotal;

        $deliveryCost = $this->delivery->calculateDelivery($this->items, $totalBeforeDelivery);

        $total = $totalBeforeDelivery + $deliveryCost;

        // Optionally truncate instead of round
        return $this->truncateTo2Decimals($total);
    }

    private function truncateTo2Decimals(float $number): float
    {
        return floor($number * 100) / 100;
    }
}
