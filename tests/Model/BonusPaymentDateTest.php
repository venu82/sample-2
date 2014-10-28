<?php

use Model\BonusPaymentDate;

class BonusPaymentDateTest extends \PHPUnit_Framework_TestCase {

    protected $bonusPayment;

    public function setUp() {
        $this->bonusPayment = new BonusPaymentDate();
        parent::setUp();
    }

    public function testBonusPaymentDateObject() {
        $this->assertInstanceOf('Model\BonusPaymentDate', $this->bonusPayment);
    }
    public function testBonusPaymentDateForWeekday() {
        //2014-05-15 is weekday for the month 04,2014 => payment date should be 2014-05-15
        $date = $this->bonusPayment->getPaymentDate('2014', '4');
        $this->assertEquals($date, '2014-05-15');
    }

    public function testBonusPaymentDateForSunday() {
        //2014-06-15 is sunday for the month 05,2014 => payment date should be 2014-06-16
        $date = $this->bonusPayment->getPaymentDate('2014', '5');
        $this->assertEquals($date, '2014-06-16');
    }

    public function testBonusPaymentDateForSaturday() {
        //2014-11-15 is saturday for the month 10,2014 => payment date should be 2014-10-17
        $date = $this->bonusPayment->getPaymentDate('2014', '10');
        $this->assertEquals($date, '2014-11-17');
    }

}
