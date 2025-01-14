<?php 

namespace App\Helper;

Class Helper {
    public function toPercentage(int $count, int $total) {
        $percentage = ($count * 100) / $total;
        $percentage = (is_int($percentage)) ? $percentage : (float) number_format($percentage, 2, '.', '');

        return $percentage;
    }
}

?>