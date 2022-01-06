<!DOCTYPE HTML>

<html>

<head>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Even or Odd number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Test if the number is even or odd :</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">Enter the number, please</label>
                <input type="text" class="form-control" id="exampleInputNum" name="num">
            </div>

            <button type="submit" class="btn btn-primary">Show</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_POST) {
    $num = $_POST['num'];
}

if (isset($num)) {

    if ($num == 0) {
        echo   '<div class= "w-25 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Zero is not even or odd number <br>" . '</div>';
    } else {
        if ($num % 2 == 0) {
            echo   '<div class= "w-25 bg-info text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . $num . " is even number" . '</div>';
        } else {
            echo   '<div class= "w-25 bg-info text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . $num . " is odd number" . '</div>';
        }
    }
}

?>