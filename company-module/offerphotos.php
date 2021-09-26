<?php

require '../helpers/dbConnection.php';

if ($_SESSION['User']['roles_id'] == 2) {
$id = $_GET['id'];

$errorMessages=[];
# FILE INFO ... 
if (!empty($_FILES['offerphotos']['name'])) {
   # code...
   $tmp_path = $_FILES['offerphotos']['tmp_name'];
   $name     = $_FILES['offerphotos']['name'];
   $size     = $_FILES['offerphotos']['size'];
   $type     = $_FILES['offerphotos']['type'];

   $allowedExt = ['png','jpg','jpeg'];

   $extArray = explode('/',$type);

   if(in_array($extArray[1],$allowedExt)){
       
       // $finalName =   rand().time().$name;
       $finalName =   rand().time().'.'.$extArray[1];
   
   
       $desPath = '../uploads/'.$finalName;
       
       if(move_uploaded_file($tmp_path,$desPath)){
           $sql = "INSERT INTO `images`(`image`, `offers_id`) VALUES ('$finalName',$id);";
           $op = mysqli_query($con,$sql);
           if ($op) {
               # code...
               
               
               echo 'File Uploaded successfully you can add more photos';
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
  <h2>upload offer photos</h2>
  <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id ?>"  enctype ="multipart/form-data">

  

  <div class="form-group">
    <label for="exampleInputEmail1">photo</label>
    <input type="file" name="offerphotos"  class="form-control" id="exampleInputName" aria-describedby="" >
  </div>



    <button type="submit" class="btn btn-primary">Save</button>
    <br><br>
    <p> do you want to delete a current photo <a href="removeOfferPhoto.php?id=<?php echo $id; ?>">press here</a></p>

</form>
</div>



</body>
</html>