<!-- This class represents a product. -->

namespace Acme;

class Product {
    public $code;
    public $price;

    public function __construct($code, $price) {
        $this->code = $code;
        $this->price = $price;
    }
}