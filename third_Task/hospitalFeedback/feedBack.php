<?php
$title = 'FeedBack';
include 'layouts/header.php';
$feedBack = [
    (object)[
        'Questions' => '1- Are you satisfied with cleanliness service ?',
        'bad' => '',
        'good' => '',
        'verygood' => '',
        'Excellent' => ''
    ],
    (object)[
        'Questions' => '2- Are you satisfied with services prices ?',
        'bad' => '',
        'good' => '',
        'verygood' => '',
        'Excellent' => ''
    ],
    (object)[
        'Questions' => '3- Are you satisfied with services prices ?',
        'bad' => '',
        'good' => '',
        'verygood' => '',
        'Excellent' => ''
    ],
    (object)[
        'Questions' => '4- Are you satisfied with nursing service ?',
        'bad' => '',
        'good' => '',
        'verygood' => '',
        'Excellent' => ''
    ],
    (object)[
        'Questions' => '5- Are you satisfied with calm in the hospital ?',
        'bad' => '',
        'good' => '',
        'verygood' => '',
        'Excellent' => ''
    ]
];

$table = '<table class="table table-hover text-center">' . '<thead>';
foreach ($feedBack[0] as $key => $templete) {
    $table .= '<th>' . $key . '</th>';
}
$table .= '</thead>' . '<tbody>';
foreach ($feedBack as $index => $templete) {
    $table .= '<tr>';
    foreach ($templete as $key => $value) {
        if ($key == 'Questions') {
            $table .= '<td class="text-start">' . $value . '</td>';
        } else {
            $table .= '<td>' . '<input type="radio" name=';
            $table .= $index . ' ' . 'value=' . $key . '>' . '</td>';
        }
    }
    $table .= '</tr>';
}
$table .= '</tbody>' . '</table>';

if ($_POST) {
    print_r($_POST);
    $Q1 = $_POST[0];
    $Q2 = $_POST[1];
    $Q3 = $_POST[2];
    $Q4 = $_POST[3];
    $Q5 = $_POST[4];
    // print_r($Q);
    $Q = [$Q1, $Q2, $Q3, $Q4, $Q5];
}

$sum = 0;
function survey()
{
    global $Q, $sum;
    if (!empty($Q)) {
        foreach ($Q as $index => $value) {
            switch ($value) {
                case 'bad':
                    $sum += 0;
                    break;
                case 'good':
                    $sum += 3;
                    break;
                case 'verygood':
                    $sum += 5;
                    break;
                case 'Excellent':
                    $sum += 10;
                    break;
            }
        }
    }
    return $sum;
}

$total = survey();

if (!empty($_POST)) {
    // echo $total;
    $_SESSION['sum'] = $total;
    header('location:result.php');
}



?>


<div class="container mt-5">

    <form method="POST">
        <?php
        echo $table;
        ?>
        <button type="submit" class="btn btn-warning w-50" name="survey" style="margin-left: 25%;" value="true">Submit</button>
    </form>

</div>

<?php
include 'layouts/footer.php';
?>