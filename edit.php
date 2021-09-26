<?php 
require  './helpers/dbConnection.php';
require './helpers/helpers.php';




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

   $sql = "select * from users where id = $id";
   $op  = mysqli_query($con,$sql);
   $data = mysqli_fetch_assoc($op);

}





if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $name     = CleanInputs($_POST['name']);
    $email= $_POST['email'];
    $city  = $_POST['city'];
    $phone  = $_POST['phone'];

    # Validate Inputs ... 
    $errors = [];

    if(!validate($name,1)){
     $errors['name'] = "Field Required.";
    }elseif(!validate($name,2)){
        $errors['name'] = "Invalid String.";  
    }

    if(!validate($email,1)){
      $errors['email'] = "Field Required.";
    }elseif(!validate($email,3)){
         $errors['email'] = "Invalid String.";  
    }

    if(!validate($city,1)){
      $errors['city'] = "Field Required.";
    }elseif(!validate($city,2)){
         $errors['city'] = "Invalid String.";  
    }

    if(!validate($phone,1)){
      $errors['phone'] = "Field Required.";
    }elseif(!validate($phone,6)){
         $errors['phone'] = "Invalid String.";  
    }

    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{

        $sql = "update users set name='$name' , email = '$email', city ='$city', phone = $phone  where id = $id ";

        $op = mysqli_query($con,$sql);

        if($op){
         $message =  'Update done';
         echo $message;
        }else{
         $message =  'Error in Update';
         echo $message;
        }
 
        $_SESSION['Message'] = $message; 

        header("Location: profile.php?id=".$id);
    }  

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Update</h2>
  <form method="post" action="edit.php?id=<?php echo $data['id'];?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Edit name</label>
    <input type="text" name="name" value="<?php echo $data['name'];?>"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Task">
  
    <br>
    <label for="exampleInputEmail1">Edit mail</label>
    <input type="email" value="<?php echo $data['email'];?>" name="email"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="startdate">

    <br>
    <label for="exampleInputEmail1">Edit City</label>
    <input type="text" value="<?php echo $data['city'];?>" name="city"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    <br>
    <label for="exampleInputEmail1">Edit Phone</label>
    <input type="number" value="<?php echo $data['phone'];?>" name="phone"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>



</body>
</html>