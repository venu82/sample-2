<?php

namespace Model;

/**
 * Description of PaymentDate
 *
 * @author Venu
 */
class PaymentDate {

    protected $bonusPaymentDate;
    protected $salaryPaymentDate;

    /**
     * 
     * @param \Model\PaymentDateInterface $salaryPaymentDate
     * @return \Model\PaymentDate
     */
    public function setSalaryPaymentDateObject(PaymentDateInterface $salaryPaymentDate) {
        $this->salaryPaymentDate = $salaryPaymentDate;
        return $this;
    }

    /**
     * 
     * @return \Model\SalaryPaymentDate
     */
    public function getSalaryPaymentDateObject() {
        if (!$this->salaryPaymentDate) {
            $this->salaryPaymentDate = new SalaryPaymentDate();
        }
        return $this->salaryPaymentDate;
    }

    public function setBonusPaymentDateObject(PaymentDateInterface $bonusPaymentDate) {
        $this->bonusPaymentDate = $bonusPaymentDate;
        return $this;
    }

    /**
     * 
     * @return \Model\BonusPaymentDate
     */
    public function getBonusPaymentDateObject() {
        if (!$this->bonusPaymentDate) {
            $this->bonusPaymentDate = new BonusPaymentDate();
        }
        return $this->bonusPaymentDate;
    }

    public function generatePaymentDates($startTime = 'now', $endTime = '+1 year') {
        $paymentDates = array();
        $bonusPaymentObject = $this->getBonusPaymentDateObject();
        $salaryPaymentObject = $this->getSalaryPaymentDateObject();
        $startDate = strtotime(date('Y-m-01', strtotime($startTime)));
        $endDate = strtotime('+1 month', strtotime($endTime));
        while ($startDate < $endDate) {
            $month = date('m', $startDate);
            $year = date('Y', $startDate);
            $salaryDate = $salaryPaymentObject->getPaymentDate($year, $month);
            $bonusDate = $bonusPaymentObject->getPaymentDate($year, $month);
            $paymentDates[$year][$month] = array(
                'salaryDate' => $salaryDate,
                'bonusDate' => $bonusDate
            );
            $startDate = strtotime('+1 month', $startDate);
        }
        return $paymentDates;
    }

    /**
     * 
     * @param type $array
     * @param type $fileName
     * @return type
     */
    public function writeToFile($array, $fileName = '') {
        $fp = fopen($fileName, "w");
        fputcsv($fp, array('Month & Year', 'Salary Payment Date', 'Bonus Payment Date'));
        foreach ($array as $yeararray) {
            foreach ($yeararray as $montharray) {
                $data = array();
                $salaryDate = strtotime($montharray['salaryDate']);
                $data[] = date('F, Y', $salaryDate);
                $data[] = date('d/m/Y', $salaryDate);
                $data[] = date('d/m/Y', strtotime($montharray['bonusDate']));
                fputcsv($fp, $data);
            }
        }
       
        fclose($fp);
        return true;
    }

}
