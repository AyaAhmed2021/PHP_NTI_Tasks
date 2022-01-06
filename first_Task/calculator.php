<!DOCTYPE HTML>

<html>

<head>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Even or Odd number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Simple calculator</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">number1</label>
                <input type="text" class="form-control" id="exampleInputNum" name="num1">
            </div>
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">number2</label>
                <input type="text" class="form-control" id="exampleInputNum" name="num2">
            </div>

            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">operator</label>
                <input type="text" class="form-control" id="exampleInputNum" name="operator">
            </div>

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_POST) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];
}


if (isset($num1) && isset($num2) && isset($operator)) {

    switch ($operator) {
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
            if ($num2 == 0) {
                echo   '<div class= "w-50 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Divide by 0 is not Valid <br>" . '</div>';
            } else {
                $result = $num1 / $num2;
            }
            break;
    }
}

if(isset($result)){
    echo   '<div class= "w-25 bg-info text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . $result . '</div>';
}

?>