<?php
namespace TDD;
class Receipt {
	public function total($items = array(), $coupon = null) {
			 $sum = array_sum($items);
			 if (!is_null($coupon)) {
					 return $sum - ($sum * $coupon);
			 }
			 return $sum;
	}

	public function tax($amount, $tax) {
			 return($amount * $tax);
	 }

  public function postTaxTotal($items, $tax, $coupon) {
        // Arvutab summa
      	$subtotal = $this->total($items, $coupon);
        // Returnib lõppsumma, ehk summa + tax
        return $subtotal + $this->tax($subtotal, $tax);
    }
}
