<?php
require  '../helpers/dbConnection.php';
require '../helpers/helpers.php';

$name     = $_SESSION['company_data']['name'];
$mail     = $_SESSION['company_data']['mail'];
$password = $_SESSION['company_data']['password'];
$role     = $_SESSION['company_data']['role'];
$gov      = $_SESSION['company_data']['gov'];

//print_r($_SESSION['company_data']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
    $address            = CleanInputs($_POST['address']);
    $companyDescription = CleanInputs($_POST['company_description']);

    //errors arr
    $errors = [];
    //valdating company data
    if(!validate($address,1,120)){
        
        $errors['address'] = "pls enter an address between 1 and 120 characters";
    }

    if(!validate($companyDescription,1,255)){
        $errors['description'] = 'pls enter a description between 1 and 255 characters' ;
    }

    if (count($errors) > 0) {
        # code...
        foreach ($errors as $key => $value) {
            # code...
            echo 'pls check '.$key.' : '.$value;
        }
    }else {

        $sql = "INSERT INTO `users`( `name`, `email`, `password`, `city`, `roles_id`) VALUES ('$name','$mail','$password','$gov',$role)";
        $op  = mysqli_query($con,$sql);
        if ($op) {
            # code...
            $user_id =  mysqli_insert_id($con);

            $sql ="INSERT INTO `companydetails`(`company_description`, `address`, `user_id`) VALUES ('$companyDescription','$address',$user_id)";
      
            $op = mysqli_query($con,$sql);
            if ($op) {
                # code...
                
                header('Location: ../login.php');
                echo 'regestration complete';
               
            }else {
                # code...
                echo ' try again ';
            }
        }
    }
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Continue to Register</h2>
  <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter your address">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Company Descriptiom</label>
    <input type="text" name="company_description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a description about your company">
  </div>



    <button type="submit" class="btn btn-primary">Save</button>

</form>
</div>



</body>
</html>