<?php
namespace Model;

class SalaryPaymentDate extends AbstractPaymentDate {

    public function getPaymentDate($year, $month) {
        $date = $year . '-' . $month . '-01';
        $lastDateInMonth = date("Y-m-t", strtotime($date));

        $lastWorkingDay = strtotime($lastDateInMonth);
        $lastWorkingDayNo = date('N', $lastWorkingDay);

        if ($lastWorkingDayNo == "6") {
            return date('Y-m-d', strtotime('-1 day', strtotime($lastDateInMonth)));
        }
        if ($lastWorkingDayNo == "7") {
            return date('Y-m-d', strtotime('-2 day', strtotime($lastDateInMonth)));
        }
        return date('Y-m-d', $lastWorkingDay);
    }

}
