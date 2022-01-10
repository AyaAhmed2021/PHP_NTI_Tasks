<?php
include 'layouts/header.php';

$cities = ['Cairo', 'Alex','Giza','Others'];
if($_POST){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $product = $_POST['product'];  
}
// print_r($_SESSION['cities']);
$products = ['Procuct Name'=>'','Price'=>'','Quantities'=>''];
switch ($city){
    case 'Cairo':
        $delivery_fees = 0;
        break;
    case 'Giza':
        $delivery_fees = 30;
        break;
    case 'Alex':
        $delivery_fees = 50;
        break;
    default:
        $delivery_fees=100;
}
$form = '<form method="POST" class="w-50" style="margin-left:20%;">';
$table ='<table class="table table-danger text-center w-50">'.'<thead>';
foreach($products as $key => $value){
    $table.='<th>'.$key.'</th>';
}
$table.='</thead>'.'<tbody>';

for($row =0; $row < $product; $row++){
    $table.='<tr>';
    for($i =0; $i<count($products); $i++){
        $table.='<td>'.'<input type="text" name='.$i.'>'.'</td>';
    }
    $table.='</tr>';
}
$table.='</tbody>'.'</table>';
$form.=$table.'<button type="submit" class="btn btn-danger w-100" name="reciept">Reciept</button>';
$form.='</form>'
 
?>

<div class="container mt-5">
    <form method="POST" class="form-control" style="background-color: #742a31; margin-left:20%; width:55%;">
    <div class="row g-3 align-items-center">
        <div class="col-2">
            <label for="username" class="col-form-label text-white">Client Name</label>
        </div>
        <div class="col-auto">
            <input type="text" id="username" class="form-control" name="name" value="<?php if (isset($_POST['name'])) {
                                                                                            echo $_POST['name'];
                                                                                        } ?>">
        </div>
    </div>
    <div class="row g-3 align-items-center mt-3">
        <div class="col-2">
            <label for="city" class="col-form-label text-white">Select your City</label>
        </div>
        <div class="col-2">
            <select id="city" class="form-control" name="city">
                <option value="Cairo">Cairo</option>
                <option value="Giza">Ciza</option>
                <option value="Alex">Alex</option>
                <option value="Others">Others</option>
            </select>
        </div>
    </div>
    <div class="row g-3 align-items-center mt-3">
        <div class="col-2">
            <label for="number" class="col-form-label text-white">number of products</label>
        </div>
        <div class="col-auto">
            <input type="text" id="number" class="form-control" name="product" value="<?php if (isset($_POST['product'])) {
                                                                                            echo $_POST['product'];} ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-success w-100 fs-5" name="EnterProducts">Enter Products</button>

    </form>
    <?php
    if(isset($_POST['EnterProducts'])){
        echo $form;
    }
    ?>
</div>


<?php
include 'layouts/footer.php';
?>