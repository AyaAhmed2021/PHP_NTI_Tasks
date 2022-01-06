<?php

use MongoDB\BSON\Undefined;

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        "email" => ['ahmed@gmail.com', 'ahmed2@gmail.com']

    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        "email" => []

    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'email' => ['menna@gmail.com']
    ],

];
// print_r($users);
$header = '';

$row = '';

foreach ($users[0] as $property => $value) {
    $header .= '<th>' . $property . '</th>';
}

for ($i = 0; $i < count($users); $i++) {
    $col = '';
    foreach ($users[$i] as $property => $value) {
        // print_r($users[1]);
        //    print_r($property) ;
        // if (isset($property)) {
        if ($property == 'id') {
            $col .= '<td>' . $value . '</td>';
        }

        if (is_string($value)) {
            $col .= '<td>' . $value . '</td>';
        } else if (is_array($value) || is_object($value)) {
            // print_r($value);
            // break;
            //    echo count($value);
            // echo gettype($value);
            $colval = '';
            foreach ($value as $key => $val) {
                if ($val == 'm') {
                    $colval .= 'Male';
                } else if ($val == 'f') {
                    $colval .= 'Female';
                }
                else  {

                    $colval .= $val . ', <br>';
                } 
                // else {
                //     $colval .= '';
                // }
                // echo $key . '=>' . $val.'<br>';
                // echo gettype($val);
                // $colval .=$val;
                // echo $val; echo gettype($val);
            }
            $col .= '<td>' . $colval . '</td>';
            // } else {
            //     $col .= '<td>' . '' . '</td>';
            // }
        }
        // $col .= '<td>' . $id . '</td>';

        //  echo $header;
    }
    $row .= '<tr>' . $col . '</tr>';
}



$table = '<table class="table table-hover">' . $header . $row . '</table>';
?>


<!DOCTYPE HTML>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dynamic Table</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center text-primary m-5">Clients Data</h2>
        <?php print_r($table) ?>
    </div>
</body>

</html>