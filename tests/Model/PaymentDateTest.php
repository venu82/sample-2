<?php

use Model\PaymentDate;

class PaymentDateTest extends \PHPUnit_Framework_TestCase {

    protected $paymentDateObject;
    protected $paymentDates;
    protected $fileName;

    public function setUp() {
        $this->paymentDateObject = new PaymentDate();
        $this->paymentDates = $this->paymentDateObject->generatePaymentDates('2014-01-01', '2014-12-01');
        $this->fileName = __DIR__ .DIRECTORY_SEPARATOR. '..'.DIRECTORY_SEPARATOR . 'test.csv';
        parent::setUp();
    }

    public function testPaymentDateObject() {
        $this->assertInstanceOf('Model\PaymentDate', $this->paymentDateObject);
    }

    public function testCountPaymentDates() {

        $this->assertCount(1, $this->paymentDates);
        $this->assertCount(12, $this->paymentDates['2014']);
    }

    public function testPaymentDateForMay() {
        $salaryDate = $this->paymentDates['2014']['05']['salaryDate'];
        $bonusDate = $this->paymentDates['2014']['05']['bonusDate'];
        $this->assertEquals($salaryDate, '2014-05-30');
        $this->assertEquals($bonusDate, '2014-06-16');
    }

    public function testPaymentDateForMarch() {
        $salaryDate = $this->paymentDates['2014']['03']['salaryDate'];
        $bonusDate = $this->paymentDates['2014']['03']['bonusDate'];
        $this->assertEquals($salaryDate, '2014-03-31');
        $this->assertEquals($bonusDate, '2014-04-15');
    }

    public function testWriteToFile() {
        $this->paymentDateObject->writeToFile($this->paymentDates, $this->fileName);
        $this->assertFileExists($this->fileName);
    }

    public function testFileContents() {
        $compareFileContents = __DIR__ .DIRECTORY_SEPARATOR. '..'.DIRECTORY_SEPARATOR . 'sample.csv';
        $this->assertFileEquals($compareFileContents, $this->fileName);
    }
    
    public function tearDown(){
        unlink($this->fileName);
        parent::tearDown();
    }

}
