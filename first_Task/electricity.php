<!DOCTYPE HTML>

<html>

<head>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Even or Odd number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Calculate Electricity Consumsion</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">Enter your consumsion</label>
                <input type="text" class="form-control" id="exampleInputNum" name="consumsion">
            </div>

            <button type="submit" class="btn btn-primary">Get the total</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_POST) {
    $consumsion = $_POST['consumsion'];
}

if (isset($consumsion)) {
    if ($consumsion <= 50) {
        $sum = 50 * 0.5;
    } else if ($consumsion > 50 && $consumsion <= 150) {
        $sum = 50 * 0.75;
    } else if ($consumsion > 150 && $consumsion <= 250) {
        $sum = 50 * 1.2;
    } else {
        $sum = 50 * 1.5;
    }

    $total_cost = (($sum * 20) / 100) + $sum;
}


if (isset($total_cost)) {
    echo   '<div class= "w-25 bg-info text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "The total cost you must pay is <br>" . $total_cost . '</div>';
}



?>