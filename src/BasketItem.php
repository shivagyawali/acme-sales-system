<?php

namespace Acme;

use Acme\Models\Product;

class BasketItem
{
    public function __construct(
        public Product $product,
        public int $quantity = 1
    ) {}
}
