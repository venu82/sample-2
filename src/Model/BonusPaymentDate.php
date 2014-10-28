<?php
namespace Model;

class BonusPaymentDate extends AbstractPaymentDate {

    public function getPaymentDate($year, $month) {
        $date = $year . '-' . $month . '-15';
        $date = strtotime('+1 month', strtotime($date));
        $bonusDateInMonth = date("Y-m-d", $date);
        

        $bonusWorkingDay = strtotime($bonusDateInMonth);
       
        $bonusWorkingDayNo = date('N', $bonusWorkingDay);
        

        
        if ($bonusWorkingDayNo == "6") {
            return date('Y-m-d', strtotime('+2 day', strtotime($bonusDateInMonth)));
        }
        if ($bonusWorkingDayNo == "7") {
             
            return date('Y-m-d', strtotime('+1 day', strtotime($bonusDateInMonth)));
        }
       
        return date('Y-m-d', $bonusWorkingDay);
    }

}
