<?php
namespace TDD\Test;
# require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';
require('vendor\autoload.php');

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

// klass mis extendib TestCase klassi
class ReceiptTest extends TestCase {

	public function setup(){
		// uus receipt objekti loomine
		$this->Receipt = new Receipt();
    }
    // eemaldab loodud objekti receipt pärast testimist
  public function teardown() {
        unset($this->Receipt);
    }

	// Receipt Total test couponita
	public function testTotal($items, $expected) {
		// array vajalik meetodi kasutamiseks ja testimiseks
		$coupon = null;
		// Receipt meetodi kasutamine koos eelneva array-ga
		$output = $this->Receipt->total($items, $coupon);
		$this->assertEquals(
			// Testib, kas oodatav väärtus on sama, mis assertEquals-is välja toodud
			$expected,
			$output,
			"When running should equal to {$expected}"
		);
	}
// data provider, mis annab total meetodile väärtused testimiseks
	public function provideTotal() {
			 // Esimene element on testTotal $itemi parameeter ja teine on $expectedi
			 return [
				 // Array-le lisatud key, mille abil saab testi filtreerida ja mis näitab, milliste väärtustega
				 // antud test feilis
					'ints total 16' => [[1, 2, 5, 8], 16],
					 [[-1, 2, 5, 8], 14],
					 [[1, 2, 8], 11],
			 ];
	 }

	// Receipt Total test couponiga
    public function testTotalAndCoupon(){
        // array ja väärtused
        $input = [0, 2, 5, 8];
        $coupon = 0.2;
        // Receipt meetodi total koos väärtustega
        $output = $this->Receipt->total($input, $coupon);
        // Testib, kas oodatav väärtus on sama, mis assertEquals-is välja toodud, PHPUnit testi meetod
        $this->assertEquals(
            12,
            $output,
            'When running should equal 12'
        );
    }

		// Receipt Total test exceptioniga
    public function testTotalException(){
        // array ja väärtused
        $input = [0, 2, 5, 8];
        $coupon = 1.2;
        // Eeldab, et meetod annaks vastuseks exceptioni "BadMethodCallException"
        $this->expectException('BadMethodCallException');
        // Kutsutakse meetod total
        $this->Receipt->total($input, $coupon);
    }


//Receipt tax meetodi testimine
		public function testTax() {
        // muutujad ja nende väärtused
        $inputAmount = 10;
        $taxInput = 0.1;
        $output = $this->Receipt->tax($inputAmount, $taxInput);
        $this->assertEquals(
					// phpunit testimeetod, mis eeldab tulemust 1, tegelik tulemus on output ja
            1,
            $output,
            'Tax calculation should be equal to 1'
        );
}

// Receipt postTaxTotal meetodi testimine
		public function testPostTaxTotal() {
				$items = [1, 2, 5, 8];
        $tax = 0.2;
        $coupon = null;
				// Loome Receipti-le uue Mock Receipt objekti
				$Receipt = $this->getMockBuilder('TDD\Receipt')
						->setMethods(['total', 'tax'])
						->getMock();
				// Oodatud(expects) argumentidega stubi mock, mis eeldab, et meetodid kutsutakse välja korra.(once)
		    $Receipt->expects($this->once())
		            ->method('total')
		            ->with($items, $coupon)
						->will($this->returnValue(10.00));
				// Oodatud(expects) argumentidega stubi mock, mis eeldab, et meetodid kutsutakse välja korra.(once)
				$Receipt->expects($this->once())
	             ->method('tax')
	             ->with(10.00, $tax)
						->will($this->returnValue(1));
				// postTaxTotali muutujate panemine muutujasse, 16 ja 0.2, mis kontrollib aga $results muutujatega 11 ja 0.1.
				$result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.2, null);
				$this->assertEquals(
						11.00,
						$result
				);
}

}
