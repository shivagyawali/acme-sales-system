<?php

namespace Acme;

class DeliveryCostCalculator implements DeliveryStrategy
{
    public function calculateDelivery(array $items, float $subtotal): float
    {
        if ($subtotal < 50) return 4.95;
        if ($subtotal < 90) return 2.95;
        return 0.00;
    }
}
