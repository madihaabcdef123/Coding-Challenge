<!-- This class manages the basket, adding products and calculating the total. -->

namespace Acme;

class Basket {
    private $products = [];
    private $catalogue = [];
    private $offers = [];

    public function __construct($catalogue, $offers = []) {
        $this->catalogue = $catalogue;
        $this->offers = $offers;
    }

    public function add($productCode) {
        if (isset($this->catalogue[$productCode])) {
            $this->products[] = $this->catalogue[$productCode];
        }
    }

    public function total() {
        $total = 0;
        $redWidgetCount = 0;

        foreach ($this->products as $product) {
            $total += $product->price;
            if ($product->code === 'R01') {
                $redWidgetCount++;
            }
        }

        // Apply offers
        if ($redWidgetCount > 1) {
            $total -= ($redWidgetCount - 1) * ($this->catalogue['R01']->price / 2);
        }

        // Add delivery cost
        $total += Delivery::calculate($total);

        return round($total, 2);
    }
}