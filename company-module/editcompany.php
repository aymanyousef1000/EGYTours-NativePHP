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

   $sql = "SELECT users.*,companydetails.company_description ,companydetails.address FROM `users` JOIN `companydetails` ON users.id = companydetails.user_id where users.id = $id";
   $op  = mysqli_query($con,$sql);
   $data = mysqli_fetch_assoc($op);

}





if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $name     = CleanInputs($_POST['name']);
    $email    = $_POST['email'];
    $city     = $_POST['city'];
    $phone    = $_POST['phone'];
    $companyDescription = $_POST['company_description'];
    $address = $_POST['address'];

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

    if(!validate($companyDescription,1)){
        $errors['description'] = "Field Required.";
     }elseif(!validate($companyDescription,2)){
        $errors['dicription'] = "Invalid String.";  
     }

     if(!validate($address,1)){
      $errors['address'] = "Field Required.";
     }//  }elseif(!validate($address,2)){
    //   $errors['address'] = "Invalid String.";  
    //  }

    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{

     $sql = " update users JOIN companydetails ON users.id = companydetails.user_id set name='$name' , email = '$email',city ='$city', phone=$phone ,company_description = '$companyDescription',address = '$address' where users.id = $id; ";

     $op = mysqli_query($con,$sql);

     if($op){
         $message =  'Update done';
         echo $message;
     }else{
         $message =  'Error in Update';
         echo $message;
       }
 
      $_SESSION['Message'] = $message; 

      header("Location: companyprofile.php");
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
  <form method="post" action="editcompany.php?id=<?php echo $data['id'];?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Edit name</label>
    <input type="text" name="name" value="<?php echo $data['name'];?>"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Task">
  
    <br>
    <label for="exampleInputEmail1">Edit mail</label>
    <input type="text" value="<?php echo $data['email'];?>" name="email"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="startdate">

    <br>
    <label for="exampleInputEmail1">Edit City</label>
    <input type="text" value="<?php echo $data['city'];?>" name="city"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    
    <br>
    <label for="exampleInputEmail1">Edit Phone Number</label>
    <input type="number" value="<?php echo $data['phone'];?>" name="phone"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    <br>
    <label for="exampleInputEmail1">Edit Company Description</label>
    <input type="text" value="<?php echo $data['company_description'];?>" name="company_description"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    <br>
    <label for="exampleInputEmail1">Edit Address</label>
    <input type="text" value="<?php echo $data['address'];?>" name="address"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="enddate">

    </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>



</body>
</html>