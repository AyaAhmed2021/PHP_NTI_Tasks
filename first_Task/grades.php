<!DOCTYPE HTML>

<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Even or Odd number</title>
</head>

<body>
    <div class="container">

        <h2 class="text-center m-auto mt-5 mb-3 text-success">Calculate Grades</h2>
        <hr class="mb-5 w-25 text-center m-auto border-bottom border-success">
        <form class="text-center w-25 m-auto" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" name="Physics" placeholder="Physics">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="Chemistry" placeholder="Chemistry">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="Biology" placeholder="Biology">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="Mathematics" placeholder="Mathematics">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="Computer" placeholder="Computer">
            </div>

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php
if ($_POST) {
    $Physics = $_POST['Physics'];
    $Chemistry = $_POST['Chemistry'];
    $Biology = $_POST['Biology'];
    $Mathematics = $_POST['Mathematics'];
    $Computer = $_POST['Computer'];
}

define('max_grad', 100);


if (isset($Physics) && isset($Chemistry) && isset($Biology) && isset($Mathematics) && isset($Computer)) {

    $sum = 0;

    if ($Physics > max_grad or $Chemistry > max_grad or $Biology > max_grad or $Mathematics > max_grad or $Computer > max_grad) {
        echo   '<div class= "w-50 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "CAUTION : YOU CAN'T GET MARK GREATER THAN 100 <br>" . '</div>';
    } else {
        $sum += $Physics + $Chemistry + $Biology + $Mathematics + $Computer;

        $precent = ($sum / 500) * 100;

        if ($precent >= 90) {
            echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade A <br>" . "Congratulations" . '</div>';
        } else if ($precent >= 80) {
            echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade B <br>" . "Congratulations" . '</div>';
        } else if ($precent >= 70) {
            echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade C <br>" . "Congratulations" . '</div>';
        } else if ($precent >= 60) {
            echo   '<div class= "w-25 bg-success text-white text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade D <br>" . "Congratulations" . '</div>';
        } else if ($precent >= 40) {
            echo   '<div class= "w-25 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade E <br>" . "OPSSS, you're in danger" . '</div>';
        } else {
            echo   '<div class= "w-25 bg-danger text-center m-auto mt-3 p-3 fw-bold border border-rounded" >' . "Grade F <br>" . "YOU FAIL" . '</div>';
        }
    }
}

?>