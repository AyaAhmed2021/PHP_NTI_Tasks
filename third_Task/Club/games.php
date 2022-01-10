<?php
$title='games';
include 'layouts/header.php';
$games = ['football', 'swimming','volleyball','others'];
$family_number = $_SESSION['family_number'];

$form = '<form class="border border-success" method="POST">';

for($i=1; $i <= $family_number; $i++){
    $form.='<div class="pb-2 px-2">'.'<label for="member" class="text-success fs-5 fw-bold">Member'.$i.'</label>'.'<br>';
    $form .='<input type="text" placeholder="enter the member name" name="memberName" class="form-control" style="display:inline-block;" value='.$_POST['memberName'].'>'.'<br>';
    foreach($games as $index => $game){
        $form .= '<input type="checkbox" id='.'game'.$index.' name="check_list[]" value='.$game.'>';
        $form .='<label for='.'game'.$index.'>'. $game.'</label>'.'<br>';
    }
    $form .='</div>';
}
$form .= '<button type="submit" class="btn btn-success w-100 text-white" name="check"> Check Price </button>';
$form .= '</form>';


if($_POST){
    // print_r($_POST);
    foreach($_POST['check_list'] as $selected) {
        print_r($_POST);
        echo "<p>".$selected ."</p>";
        }
    // $_SESSION['football']=$_POST['football'];
    // $_SESSION['swimming']=$_POST['swimming'];
    // $_SESSION['vollyball']=$_POST['vollyball'];
    // $_SESSION['others']=$_POST['others'];

}
?>

<div class="container">
    <?=$form;?>
</div>
<?php 
include 'layouts/footer.php';
?>