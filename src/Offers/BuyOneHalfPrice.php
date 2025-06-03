<?php

namespace Acme\Offers;

use Acme\DiscountStrategy;
use Acme\BasketItem;

class BuyOneHalfPrice implements DiscountStrategy
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function applyDiscount(array $items): float
    {
        $discount = 0.0;
        foreach ($items as $item) {
            if ($item->product->code === $this->productCode) {
                $halfPriceCount = intdiv($item->quantity, 2);
                $discount += $halfPriceCount * ($item->product->price / 2);
            }
        }
        return $discount;
    }
}
