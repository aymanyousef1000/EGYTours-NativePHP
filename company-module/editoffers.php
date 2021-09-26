<?php 
require  '../helpers/dbConnection.php';
require '../helpers/helpers.php';


if ($_SESSION['User']['roles_id'] == 2) {

$id = sanitize($_GET['id'],1);    // $_REQUEST

$errors = [];

if(!validate($id,6)){
 $errors['id'] = "InValid Id";      
}



if(count($errors) > 0){
    // 
    $_SESSION['Message'] = $errors['id'];
    
    //header("Location: index.php");

}else{

   $sql = "select * from offers where id = $id";
   $op  = mysqli_query($con,$sql);
   $data = mysqli_fetch_assoc($op);
    $offerid= $data['company_id'];
}





if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $description     = CleanInputs($_POST['description']);
    $price           = $_POST['price'];
    $city            = $_POST['destination'];

    # Validate Inputs ... 
    $errors = [];

    if(!validate($description,1)){
     $errors['description'] = "Field Required.";
    }elseif(!validate($description,2)){
        $errors['description'] = "Invalid String.";  
    }

    if(!validate($price,1)){
      $errors['price'] = "Field Required.";
    }elseif(!validate($price,6)){
         $errors['price'] = "Invalid String.";  
    }

    if(!validate($city,1)){
      $errors['city'] = "Field Required.";
    }elseif(!validate($city,2)){
         $errors['city'] = "Invalid String.";  
    }




    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{

     $sql = "update offers set offer_description='$description' , price = '$price',destination ='$city'  where id = $id ";

     $op = mysqli_query($con,$sql);

     if($op){
         $message =  'Update done';
         echo $message;
     }else{
         $message =  'Error in Update';
         echo $message;
       }
 
      $_SESSION['Message'] = $message; 

      header("Location: offers.php?id=$offerid");
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
  <title>Edit Offers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Edit Offer</h2>
  <form method="post" action="editoffers.php?id=<?php echo $data['id'];?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Edit Description</label>
    <input type="text" name="description" value="<?php echo $data['offer_description'];?>"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="description">
  
    <br>
    <label for="exampleInputEmail1">Edit Offer Price</label>
    <input type="number" value="<?php echo $data['price'];?>" name="price"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="price">

    <br>
    <label for="exampleInputEmail1">Edit destination</label>
    <input type="text" value="<?php echo $data['destination'];?>" name="destination"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="destination">

    </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>



</body>
</html>