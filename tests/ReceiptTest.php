<?php
namespace TDD\Test;
require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

// klass mis extendib TestCase klassi
class ReceiptTest extends TestCase {
	public function testTotal() {
		// Uue funktsiooni ja objekti loomine
		$Receipt = new Receipt();
		$this->assertEquals(
			// PHPUniti testimeetod, mis testib, kas oodatav väärtus on sama, mis assertEquals-is välja toodud
			15,
			$Receipt->total([0,2,5,8]),
			'When summing the total should equal 15'
		);
	}
}
