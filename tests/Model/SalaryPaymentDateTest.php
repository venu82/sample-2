<?php

use Model\SalaryPaymentDate;

class SalaryPaymentDateTest extends \PHPUnit_Framework_TestCase {

    protected $salaryPayment;

    public function setUp() {
        $this->salaryPayment = new SalaryPaymentDate();
        parent::setUp();
    }

    public function testSalaryPaymentDateObject() {
        $this->assertInstanceOf('Model\SalaryPaymentDate', $this->salaryPayment);
    }
    public function testSalaryPaymentDateForWeekday() {
        //2014-03-31 is weekday for the month 03,2014 => payment date should be 2014-03-31
        $date = $this->salaryPayment->getPaymentDate('2014', '3');
        $this->assertEquals($date, '2014-03-31');
    }

     public function testSalaryPaymentDateForFeb() {
        //2014-02-28 is weekday for the month 02,2014 => payment date should be 2014-02-28
        $date = $this->salaryPayment->getPaymentDate('2014', '2');
        $this->assertEquals($date, '2014-02-28');
    }
    public function testSalaryPaymentDateForSunday() {
        //2014-08-31 is sunday for the month 08,2014 => payment date should be 2014-08-29
        $date = $this->salaryPayment->getPaymentDate('2014', '8');
        $this->assertEquals($date, '2014-08-29');
    }

    public function testSalaryPaymentDateForSaturday() {
        //2014-05-31 is saturday for the month 05,2014 => payment date should be 2014-05-30
        $date = $this->salaryPayment->getPaymentDate('2014', '05');
        $this->assertEquals($date, '2014-05-30');
    }

}
