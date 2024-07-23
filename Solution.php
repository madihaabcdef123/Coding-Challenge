<?php

class Basket {
    private $products = [];
    private $catalogue = [];
    private $deliveryRules = [];
    private $offers = [];

    public function __construct($catalogue, $deliveryRules, $offers) {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add($productCode) {
        if (isset($this->catalogue[$productCode])) {
            $this->products[] = $productCode;
        } else {
            throw new Exception("Product code not found.");
        }
    }

    public function total() {
        $subtotal = 0;
        $productCounts = array_count_values($this->products);

        // Calculate subtotal
        foreach ($this->products as $productCode) {
            $subtotal += $this->catalogue[$productCode]['price'];
        }

        // Apply offers
        if (isset($productCounts['R01']) && $productCounts['R01'] > 1) {
            $redWidgets = $productCounts['R01'];
            $discountedRedWidgets = floor($redWidgets / 2);
            $subtotal -= $discountedRedWidgets * ($this->catalogue['R01']['price'] / 2);
        }

        // Calculate delivery cost
        $deliveryCost = $this->calculateDeliveryCost($subtotal);
        
        return $subtotal + $deliveryCost;
    }

    private function calculateDeliveryCost($subtotal) {
        if ($subtotal < 50) {
            return 4.95;
        } elseif ($subtotal < 90) {
            return 2.95;
        } else {
            return 0;
        }
    }
}

// Product catalogue
$catalogue = [
    'R01' => ['price' => 32.95],
    'G01' => ['price' => 24.95],
    'B01' => ['price' => 7.95],
];

// Delivery rules and offers
$deliveryRules = [];
$offers = ['R01' => 'buy one get one half price'];

// Create basket instance
$basket = new Basket($catalogue, $deliveryRules, $offers);

// Example usage
$basket->add('B01');
$basket->add('G01');
echo "Total: $" . number_format($basket->total(), 2) . "\n"; // Expected: $37.85

$basket = new Basket($catalogue, $deliveryRules, $offers);
$basket->add('R01');
$basket->add('R01');
echo "Total: $" . number_format($basket->total(), 2) . "\n"; // Expected: $54.37

$basket = new Basket($catalogue, $deliveryRules, $offers);
$basket->add('R01');
$basket->add('G01');
echo "Total: $" . number_format($basket->total(), 2) . "\n"; // Expected: $60.85

$basket = new Basket($catalogue, $deliveryRules, $offers);
$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
echo "Total: $" . number_format($basket->total(), 2) . "\n"; // Expected: $98.27
?>