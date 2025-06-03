<?php

namespace Acme;

interface DiscountStrategy
{
    public function applyDiscount(array $items): float;
}
