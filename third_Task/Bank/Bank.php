<?php
include 'layouts/header.php';

if ($_POST) {
    $name = $_POST['userName'];
    $Loan = $_POST['Loan'];
    $year = $_POST['Year'];

    if (empty($name)) {
    }

    if (empty($Loan)) {
    }

    if (empty($year)) {
    }
}



// function net_interest($interest_percent, $Loan, $year){
//     global $Loan, $year;

//     return $interest;
// }

// function totalLoan(&$Loan){

//     return $total_loan;
// }
$user_Data = ['Net Interest' => '', 'Total Loan' => '', 'Monthly Payment' => ''];

function Bank_Payment($interest_percent)
{
    global $Loan, $year, $user_Data;

    $interest = (($Loan * $interest_percent) / 100) * $year;
    $total_loan = $Loan + $interest;
    $monthly_payment = $total_loan / (12 * $year);
    $user_Data['Net Interest'] = $interest;
    $user_Data['Total Loan'] = $total_loan;
    $user_Data['Monthly Payment'] = $monthly_payment;
    return $user_Data;
}

if ($year < 3) {
    Bank_Payment(10);
} else {
    Bank_Payment(15);
}
$table = '<table class=" table table-danger mt-3 text-center">' . '<thead>';
foreach ($user_Data as $key => $value) {
    $table .= '<th>' . $key . '</th>';
}
$table .= '</thead>' . '<tbody>' . '<tr>';
foreach ($user_Data as $key => $value) {
    $table .= '<td>' . $value . '</td>';
}
$table .= '</tr>' . '</tbody>' . '</table>';
?>

<div class="container mt-5">
    <h2 class="text-center mb-5 text-danger">Bank Payment Portal</h2>
    <form method="POST" class="w-50" style="margin-left: 20%;">
        <div class="mb-3">
            <label for="InputName" class="form-label">Enter your name</label>
            <input type="text" class="form-control" id="InputName" name="userName" value="<?php if (isset($_POST['userName'])) {
                                                                                                echo $_POST['userName'];
                                                                                            } ?>">
        </div>
        <div class="mb-3">
            <label for="InputLoan" class="form-label">Enter the loan you need</label>
            <input type="text" class="form-control" id="InputLoan" name="Loan" value="<?php if (isset($_POST['Loan'])) {
                                                                                            echo $_POST['Loan'];
                                                                                        } ?>">
        </div>
        <div class="mb-3">
            <label for="InputYear" class="form-label">Years of loan</label>
            <input type="text" class="form-control" id="InputYear" name="Year" value="<?php if (isset($_POST['Year'])) {
                                                                                            echo $_POST['Year'];
                                                                                        } ?>">
        </div>
        <button type="submit" class="btn btn-danger w-100" name='calculate'>Submit</button>
    </form>
    <?php

    if (isset($_POST['calculate'])) {
        echo $table;
        //  echo 'Hello';
        //  print_r($_SESSION) ;
    }
    ?>
</div>
<?php

include 'layouts/footer.php';

?>