<?php

use PHPUnit\Framework\TestCase;
use Acme\{Catalog, Basket, DeliveryCostCalculator};
use Acme\Models\Product;
use Acme\Offers\BuyOneHalfPrice;

class BasketTest extends TestCase
{
    private Basket $basket;

    protected function setUp(): void
    {
        $catalog = new Catalog([
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95),
        ]);

        $this->basket = new Basket(
            $catalog,
            new DeliveryCostCalculator(),
            [new BuyOneHalfPrice('R01')]
        );
    }

    private function total(array $products): float
    {
        foreach ($products as $code) {
            $this->basket->add($code);
        }
        return $this->basket->total();
    }

    public function testBasketTotals(): void
    {
        $this->assertEquals(37.85, $this->total(['B01', 'G01']), '', 0.01);
        $this->setUp();
        $this->assertEqualsWithDelta(54.37, $this->total(['R01', 'R01']), 0.01);
        $this->setUp();
        $this->assertEquals(60.85, $this->total(['R01', 'G01']), '', 0.01);
        $this->setUp();
        $this->assertEquals(98.27, $this->total(['B01', 'B01', 'R01', 'R01', 'R01']), '', 0.01);
    }
}
