<!DOCTYPE HTML>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Positive and Negative number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Show Negative and Positive Number</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">Enter the number, please</label>
                <input type="text" class="form-control" id="exampleInputNum" name="num">
            </div>

            <div class="mb-3">
                <label for="exampleInputNum" class="form-label">Enter the root number</label>
                <input type="text" class="form-control" id="exampleInputNum" name="root">
            </div>

            <button type="submit" class="btn btn-primary">Result</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php

if ($_POST) {
    $num = $_POST['num'];
    $root = $_POST['root'];
}




function root()
{
    global $num, $root;
    if (isset($root)) {
        if ($root == 0) {
            echo   '<div class= "w-50 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "You can't get the root of zero for any number " . '</div>';
        } else {
            $result = pow($num, (1 / $root));

            return $result;
        }
    }
}

$root_num = root();

if (isset($root_num)) {
    echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "The root number is <br>" . $root_num . '</div>';
}




?>