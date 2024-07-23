<!-- This file contains unit tests for the Basket class. -->

namespace Acme;

use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase {
    public function testBasketTotal() {
        $catalogue = [
            'R01' => new Product('R01', 32.95),
            'G01' => new Product('G01', 24.95),
            'B01' => new Product('B01', 7.95),
        ];

        $basket = new Basket($catalogue);

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket = new Basket($catalogue);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket = new Basket($catalogue);
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket = new Basket($catalogue);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}