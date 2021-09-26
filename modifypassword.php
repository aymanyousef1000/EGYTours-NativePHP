<?php 
require  './helpers/dbConnection.php';
require './helpers/helpers.php';


$id = sanitize($_GET['id'],1);
 

$errors = [];

if(!validate($id,6)){
 $errors['id'] = "InValid Id";      
}



if(count($errors) > 0){
    // 
    $_SESSION['Message'] = $errors['id'];
    
    //header("Location: index.php");

}else{

   $sql = "select users.password , users.roles_id from users where id =$id;";
   $op  = mysqli_query($con,$sql);
   $data = mysqli_fetch_assoc($op);
  // echo $data['password'];
   //echo '<br>'.$id;

}





if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $oldpassword = $data['password'];//done
    $password  = $_POST['oldpass'];//done
    $newPassword  = $_POST['newpass'];
    $confirmNewPassword  = $_POST['newpassconfirmation'];
    $hashedconfirmNewPassword =md5($confirmNewPassword);
    //echo '<br>'. $oldpassword .'<br>'. $password .'<br>'. $newPassword .'<br>'. $confirmNewPasswordm .'<br>'. $hashedconfirmNewPassword;

    # Validate Inputs ... 
    $errors = [];

    // if(!validate($password,1)){
    //  $errors['password'] = "Field Required.";
    // }

    if(!validate($newPassword,1)){
        $errors['newPassword'] = "Field Required.";
    }

    if(!validate($confirmNewPassword,1)){
        $errors['confirmNewPassword'] = "Field Required.";
    }




    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{

        if ($oldpassword == md5($password)) {
            # code...
            if ($newPassword == $confirmNewPassword) {
                # code...          
               $sql = "update users set `password` = '$hashedconfirmNewPassword' WHERE users.id = $id;";
               $op = mysqli_query($con,$sql);
            }else {
                # code...
                echo "confirmation password dosn't match new password";
            }
        }else {
            # code...
            echo "pls enter your current password correctly";
        }
        
     

     

     if($op){
         $message =  'Update done';
         if ($data['roles_id'] == 1) {
             # code...
             header("Location: ./user-module/profile.php?id=".$id);
         }else {
             # code...
             header("Location: ./company-module/companyprofile.php?id=".$id);
         }
         
         echo $message;
     }else{
         $message =  'Error in Update';
         echo $message;
       }
 
      $_SESSION['Message'] = $message; 

      
    }  

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>change password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Change Password</h2>
  <form method="post" action="modifypassword.php?id=<?php echo $id; ?>" enctype ="multipart/form-data" >

  

  <div class="form-group">
    <label for="exampleInputEmail1">Old Password</label>
    <input type="password" name="oldpass"   class="form-control" id="exampleInputName" aria-describedby="" placeholder="old password">
  
    <br>
    <label for="exampleInputEmail1">New Password</label>
    <input type="password" name="newpass"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="new password">

    <br>
    <label for="exampleInputEmail1">Re-Enter New Password</label>
    <input type="password" name="newpassconfirmation"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="confirm your new password">

    </div>
  
  <button type="submit" class="btn btn-primary">Change Password</button>
</form>
</div>



</body>
</html>