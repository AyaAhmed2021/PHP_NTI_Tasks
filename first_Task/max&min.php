<!DOCTYPE HTML>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Max and Min number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Get maximum and minimum number</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <label for="exampleInputNum1" class="form-label">first number</label>
                <input type="text" class="form-control" id="exampleInputNum1" name="num1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPNum2" class="form-label">second number</label>
                <input type="text" class="form-control" id="exampleInputNum2" name="num2">
            </div>
            <div class="mb-3">
                <label for="exampleInputNum3" class="form-label">third number</label>
                <input type="text" class="form-control" id="exampleInputNum3" name="num3">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_POST) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $num3 = $_POST['num3'];
}

// $max_num = max($num1, $num2, $num3);

// $min_num = min($num1, $num2, $num3);

// echo   '<div class= "w-50 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >'. "the maximum number is "." ".$max_num." "."and the minimum number is"." ".$min_num .'</div>';

if (isset($num1) && isset($num2) && isset($num3)) {
     global $max_num;

    if ($num1 > $num2 && $num1 > $num3) {
        $max_num = $num1;
    } else if ($num2 > $num1 && $num2 > $num3) {
        $max_num = $num2;
    } else {
        $max_num = $num3;
    }
}

if (isset($num1) && isset($num2) && isset($num3)) {
   global $min_num;

    if ($num1 < $num2 && $num1 < $num3) {
        $min_num = $num1;
    } else if ($num2 < $num1 && $num2 < $num3) {
        $min_num = $num2;
    } else {
        $min_num = $num3;
    }
}

if (isset($max_num) and isset($min_num)) {
    echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "the maximum number is " . " " . $max_num . " " . "and the minimum number is" . " " . $min_num . '</div>';
}

?>