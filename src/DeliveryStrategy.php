<?php

namespace Acme;

interface DeliveryStrategy
{
    public function calculateDelivery(array $items, float $subtotal): float;
}
