<?php

require  '../helpers/dbConnection.php';
require '../helpers/helpers.php';
$id = $_GET['id'];
if ($_SESSION['User']['roles_id'] == 2) {
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        # Logic ... 
        $price     = CleanInputs($_POST['price']);
        $offer_description = $_POST['offer_description'];
        $date  = $_POST['date'];
        $destination  = $_POST['destination'];
        

        # Validate Inputs ... 
        $errors = [];

        if(!validate($price,1)){
        $errors['price'] = "Field Required.";
        }elseif(!validate($price,6)){
            $errors['price'] = "Invalid price.";  
        }

        if(!validate($offer_description,1)){
            $errors['description'] = "Field Required.";
        }elseif(!validate($offer_description,2)){
            $errors['decription'] = "Invalid string.";  
        }

        if(!validate($destination,1)){
            $errors['destination'] = "destination Required.";
        }elseif(!validate($destination,2)){
            $errors['destination'] = "Invalid string.";  
        }
        //validating dat
        // $date = date_parse_from_format("d/m/Y", $date);
        // $date_arr  = explode('/', $date);
        // if (!($date['error_count'] == 0 && checkdate($date['month'], $date['day'], $date['year']))) {
        //     // inValid Date
        //     $errors['date'] = "Invalid date.";  
        // }
        


        if(count($errors) > 0){

            foreach($errors as $key => $value)
            {
                echo '* '.$key.' : '.$value.'<br>';
            }
        }else{

        $sql = "INSERT INTO `offers`( `price`, `offer_description`, `date`, `company_id`, `destination`) VALUES ($price,'$offer_description','$date',$id,'$destination');";

        $op = mysqli_query($con,$sql);

        if($op){
            echo 'offer Added Sucessfully';
            
        }else{
            echo 'faild,try again';
        }
        header("Location: offers.php?id=$id");
        }
        

    }

}else {
        # code...
    header('Location: ../error404.php'); 
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add offer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Add Offer</h2>
  <form method="post" action="addoffers.php?id=<?php echo $id; ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <input type="text" name="offer_description"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter description">

    <br>
    <label for="exampleInputEmail1">Price</label>
    <input type="number" name="price"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="price">

    <br>
    <label for="exampleInputEmail1">Date</label>
    <input type="date"  name="date"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="date">

    <br>
    <label for="exampleInputEmail1">Destination</label>
    <input type="text" name="destination"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter destination">

  </div>
  
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>



</body>
</html>