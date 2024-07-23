<!-- This file explains how to set up and run the project. -->

# Acme Widget Co Sales System

## Overview
This project implements a proof of concept for a sales system for Acme Widget Co, including product management, basket functionality, and delivery cost calculation.

## Setup
1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Run tests with `vendor/bin/phpunit tests`.

## Installation
1. Clone the repository from GitHub.
2. Ensure you have PHP installed on your machine.
3. Run the PHP script in your terminal or web server.

## Assumptions
- The product catalogue and offers are passed as arrays.
- The delivery cost rules are hardcoded as per the requirements

## Features
- Add products to the basket
- Calculate total cost with delivery charges
- Apply special offers (e.g., buy one red widget, get the second half price)


## Usage
- Create an instance of the `Basket` class with the product catalogue, delivery rules, and offers.
- Use the `add` method to add products by their code.
- Call the `total` method to get the total cost of the basket.


## Example
```php
$basket = new Basket($catalogue, $deliveryRules, $offers);
$basket->add('R01');
$basket->add('R01');
echo $basket->total(); 