<?php
include 'autoloader_register.php';
$model = new Model\PaymentDate();
$result = $model->generatePaymentDates();
foreach ($result as $year => $month) {

    foreach ($month as $paymentmonth => $dates) {
        ?>
        <table border ="1">
            <tr>
                <td> <?php echo $paymentmonth.', '.$year ?> </td>
            </tr>
            <?php foreach ($dates as $paymenttype => $paymentdate) { ?>
                <tr>
                    <td> <?php echo $paymenttype . ":\t" . $paymentdate; ?></td>
                </tr>
                <?php
            } //end of foreach
            ?> <tr> </tr>
        <?php
        }   //end of foreach
    }   //end of foreach
    ?>
</table>  

