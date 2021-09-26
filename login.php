<?php 
require  './helpers/dbConnection.php';
require  './helpers/helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $email    = CleanInputs($_POST['email']);
    $password = CleanInputs($_POST['password']);
   
    # Validate Inputs ... 
    $errors = [];


      if(!validate($email,1)){
        $errors['Email'] = "Field Required.";
       }elseif(!validate($email,3)){
           $errors['Email'] = "Invalid Email.";  
       }


       if(!validate($password,1)){
        $errors['password'] = "Field Required.";
       }elseif(!validate($password,5)){
           $errors['password'] = "Invalid Length.";  
       }


    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{
     
      $password = md5($password);

     $sql = "select * from users where email = '$email' and password = '$password'";

     $op = mysqli_query($con,$sql);

     if( mysqli_num_rows($op) == 1){
           # logic .... 
        $data = mysqli_fetch_assoc($op);
        $_SESSION['User'] = $data;  // roles included
        if ($data['roles_id']==1) {
          # code...
          header("Location: ./user-module/profile.php");
        }elseif ($data['roles_id']==2) {
          # code...
          header("Location: ./company-module/companyprofile.php");
        }
        
        

     }else{
         echo 'Error in Login Try Again';
       }






    }

}



?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Login</h2>
  <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype ="multipart/form-data">


  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">  Password</label>
    <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Login</button> <br><br><br>
  <p>Don't have an account ? <a href="signup.php"> SignUp </a></p>
</form>
</div>



</body>
</html>