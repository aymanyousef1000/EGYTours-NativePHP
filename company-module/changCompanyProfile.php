<?php
require '../helpers/dbConnection.php';
require '../helpers/helpers.php';
$id = $_GET['id'];
//echo $id;

if ($_SESSION['User']['roles_id'] == 2) {
 $errorMessages=[];
 # FILE INFO ... 
 if (!empty($_FILES['pp']['name'])) {
    # code...
    $pptmp_path = $_FILES['pp']['tmp_name'];
    $ppname     = $_FILES['pp']['name'];
    $ppsize     = $_FILES['pp']['size'];
    $pptype     = $_FILES['pp']['type'];

    $allowedExt = ['png','jpg','jpeg'];

    $extArray = explode('/',$pptype);

    if(in_array($extArray[1],$allowedExt)){
        
        // $finalName =   rand().time().$name;
        $finalName =   rand().time().'.'.$extArray[1];
    
    
        $desPath = '../uploads/'.$finalName;
        
        if(move_uploaded_file($pptmp_path,$desPath)){
            $sql = "UPDATE `users` SET `profilepicture`= '$finalName' WHERE id =$id;";
            $op = mysqli_query($con,$sql);
            if ($op) {
                # code...
                $sql = 'select `roles_id` from `users` where `id`=$id;';
                $op  = mysqli_query($con,$sql);
                header('Location: companyprofile.php?id='.$id);
                
                echo 'File Uploaded';
            }else {
                # code...
                echo 'somthing went wrong';
            }
            
        }else{
            echo 'Error In Uploading Try Again';
        }
    
            
    }else{
        $errorMessages['photo']= 'the extion is not valid';
        echo 'the extion is not valid';
    }
}else {
    # code...
    $errorMessages['photo']= 'pls upload your photo';
    echo 'pls upload your photo';
}



}else {
    # code...
    header('Location: ../error404.php'); 
}





?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Profile Picture</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>upload your new profile picture</h2>
  <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">photo</label>
    <input type="file" name="pp"  class="form-control" id="exampleInputName" aria-describedby="" >
  </div>



    <button type="submit" class="btn btn-primary">Save</button>

</form>
</div>



</body>
</html>