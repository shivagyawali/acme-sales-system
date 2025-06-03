# Acme Widget Sales System

This project is a proof of concept sales system for Acme Widget Co.  
It implements a basket with products, delivery cost calculation, and discount offers.

---

## Features

- Product catalog management
- Basket with add and total functionality
- Delivery cost rules based on order value
- Special offer: Buy one red widget, get the second half price
- Unit tests using PHPUnit

---

## Requirements

- PHP 8.1 or higher
- Composer
- (Optional) Docker and Docker Compose for containerized environment

---

## Installation

Clone the repository:

```bash
git clone https://github.com/yourusername/acme-widget-sales.git
cd acme-widget-sales

```
## Install PHP dependencies with Composer

```bash
composer install

```
## Running Tests Locally
```bash
./vendor/bin/phpunit

```
## Running Tests with Docker
```bash
docker-compose up --build

```
## Project Structure
acme-widget-sales/
├── src/                  # Source code
│   ├── Catalog.php
│   ├── Basket.php
│   ├── DeliveryCostCalculator.php
│   └── Offers/
│       └── BuyOneHalfPrice.php
├── tests/                # PHPUnit tests
│   └── BasketTest.php
├── composer.json
├── composer.lock
├── phpunit.xml           # PHPUnit configuration
├── Dockerfile
├── docker-compose.yml
└── README.md



