<?php

namespace Acme;

use Acme\Models\Product;

class Catalog
{
    /** @var Product[] */
    private array $products = [];

    public function __construct(array $products)
    {
        foreach ($products as $product) {
            $this->products[$product->code] = $product;
        }
    }

    public function getProduct(string $code): ?Product
    {
        return $this->products[$code] ?? null;
    }
}
