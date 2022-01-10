<?php
$title='result';
include 'layouts/header.php';

$result = $_SESSION['sum'];
$phone = $_SESSION['phone'];
$message = '';

if ($result < 25) {
    $message.='<div class=" container bg-danger mt-5 p-4 border rounded">';
    $message .= '<h4 class="text-center">'.'We are Sorry We will call you later on this phone:'.'<span class="text-white">'.$phone.'</span>';
    $message.='</h4>'.'</div>';
} else {
    $message.='<div class=" container bg-success mt-5 p-4 border rounded">';
    $message .= '<h4 class="text-white text-center">'.'Thank you for your feedback.';
    $message.='</h4>'.'</div>';
}
?>


<?php
echo $message;
include 'layouts/footer.php'
?>