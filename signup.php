<?php 
require  './helpers/dbConnection.php';
require './helpers/helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    # Logic ... 
    $name     = CleanInputs($_POST['name']);
    $email    = CleanInputs($_POST['email']);
    $phone    = CleanInputs($_POST['phone']);
    $password = CleanInputs($_POST['password']);
    $role_id   = $_POST['role_id'];
    $government  = CleanInputs($_POST['government']);

   
    # Validate Inputs ... 
    $errors = [];

    if(!validate($name,1)){
     $errors['Name'] = "Field Required.";
    }elseif(!validate($name,2)){
        $errors['Name'] = "Invalid String.";  
    }

    if(!validate($email,1)){
        $errors['Email'] = "Field Required.";
    }elseif(!validate($email,3)){
           $errors['Email'] = "Invalid Email.";  
    }

    if(!validate($government,1)){
      $errors['government'] = "Field Required.";
    }elseif(!validate($government,2)){
         $errors['government'] = "Invalid String.";  
    }

    if(!validate($phone,1)){
      $errors['phone'] = "Field Required.";
    }// }elseif(!validate($phone,6)){
    //      $errors['phone'] = "Invalid phone number.";  
    // }


    if(!validate($password,1)){
      $errors['password'] = "Field Required.";
    }elseif(!validate($password,5,8)){
         $errors['password'] = "Invalid length insert 8 characters at least.";  
    }

    if(!validate($role_id,1)){
      $errors['role_id'] = "Field Required.";
    }elseif(!validate($role_id,6)){
         $errors['role_id'] = "Invalid input.";  
    }
    
    $sqll ="SELECT * FROM users WHERE email = '$email';";
    $opp = mysqli_query($con,$sqll);
    if (mysqli_num_rows($opp) >0) {
      # code...
      $errors['Email'] = "This mail is already registerd"; 
    }


    if(!validate($password,1)){
        $errors['password'] = "Field Required.";
    }elseif(!validate($password,5)){
           $errors['password'] = "Invalid Length.";  
    }

    
    if(!validate($role_id,1)){
        $errors['role'] = "Field Required.";
    }
      


    if(count($errors) > 0){

        foreach($errors as $key => $value)
        {
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{
     
        $password = md5($password);

        if($role_id == 1){
            $sql = "INSERT INTO `users`( `name`, `email`,`phone`, `password`, `city`, `roles_id`) VALUES ('$name','$email',$phone,'$password','$government',$role_id)";
                
            $op = mysqli_query($con,$sql);
            if($op){
                echo 'Registration done';
                header('Location: login.php');
            }else{
                echo 'try again';
            }
        }else{
            $_SESSION['company_data'] = array('name'=> $name,'mail'=> $email,'password'=> $password,'role'=> $role_id,'gov'=> $government); 
            header('Location: ./company-module/companySignUp.php');
        }
        

            
    }

}


# fetch role Data .... 
 $sql  = "select * from roles";
 $data = mysqli_query($con,$sql);


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
  <h2>Register</h2>
  <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
  </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="number" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your phone number">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password"   class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Account Type</label>
 <select name="role_id"   class="form-control" >
   
 <?php while($result = mysqli_fetch_assoc($data)){?>
    <option  value="<?php echo $result['id'];?>" ><?php echo $result['title'];?></option>
  <?php }?>
</select>
  </div>



<?php 
  $gov  = ['Cairo','Alexandria','Giza','Aswan','sohag','El Dakhlia','kafr elsheikh','new valley','port said','suez',"isma'lia",'Bani sweif','marsa matroh','Asyut','Beheira','Damietta','Gharbia','Faiyum',' Luxor','Minya','Menia','Monufia','North Sinai','Qalyubia','Qena','Red Sea',' South Sinai'];
  
?>

<div class="form-group">
    <label for="exampleInputPassword1">Government</label>
 <select name="government"   class="form-control" >
   
 <?php foreach($gov as $gov_data){?>
    <option  value="<?php echo $gov_data;?>" ><?php echo $gov_data;?></option>
  <?php }?>
</select>
  </div>



    <button type="submit" class="btn btn-primary">Save</button>

</form>
</div>



</body>
</html>