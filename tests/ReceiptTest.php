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
	}
	public function testTotal() {
		// array vajalik meetodi kasutamiseks ja testimiseks
		$input = [0, 2, 5, 8];
		// Receipt meetodi kasutamine koos eelneva array-ga
		$output = $this->Receipt->total($input);
		$this->assertEquals(
			// Testib, kas oodatav väärtus on sama, mis assertEquals-is välja toodud
			15,
			$output,
			'When summing the total should equal 15'
		);
	}
}
