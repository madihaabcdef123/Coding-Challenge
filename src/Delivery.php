<!-- This class calculates delivery costs based on the total amount. -->

namespace Acme;

class Delivery {
    public static function calculate($total) {
        if ($total < 50) {
            return 4.95;
        } elseif ($total < 90) {
            return 2.95;
        }
        return 0.00;
    }
}