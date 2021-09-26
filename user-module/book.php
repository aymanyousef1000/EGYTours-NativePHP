<?php 
require  '../helpers/dbConnection.php';
require '../helpers/helpers.php';
if ($_SESSION['User']['roles_id'] == 1) {
    $id = sanitize($_GET['id'],1);    // $_REQUEST



    $sql = "SELECT offers.* , users.name , users.city ,users.phone, images.image FROM offers join users on users.id = offers.company_id JOIN images on images.offers_id = offers.id WHERE offers.id=$id;";
    $op  = mysqli_query($con,$sql);
}else {
  # code...
  header('Location: ../error404.php'); 

}   

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Offer Perview</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    .carousel-inner{
       height: 350px;
    }

    .item, img{
      height : 350px;
    }

  </style>
</head>
<body>

<div class="container">
  <br><br>
  <h2>Offer Perview</h2>
 <br>

  <!-- carsouel code -->
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
<?php
  $i= 0;
  while ($data = mysqli_fetch_assoc($op)) {
   
    if ($i == 0) {
      
    
 ?>
    
    <div class="carousel-item active">
      <img class="d-block w-100" src="../uploads/<?php echo $data['image'];?>" alt="">
    </div>
    
<?php $i++; }else { ?>

  <div class="carousel-item">
      <img class="d-block w-100" src="../uploads/<?php echo $data['image'];?>" alt="">
    </div>
<?php } } ?>  
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<?php

$sql = "SELECT offers.* , users.name , users.city FROM offers join users on users.id = offers.company_id  WHERE offers.id=$id;";
$op2 = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op2);
?>

<br>
  <div class="form-group">
      
    <br><br>
    <h4>Offer Description</h4>
    <p> <?php echo $data['offer_description'];?> </p>

    <br>
    <h4>Price</h4>
    <p> <?php echo $data['price'];?></p>

    <br>
    <h4>Date</h4>
    <p> <?php echo $data['date'];?> </p>

    <br>
    <h4>Company</h4>
    <p> <?php echo $data['name'];?> </p>
    


    <br>
    <h4>From</h4>
    <p> <?php echo $data['city'];?> </p>

    <br>
    <h4>To</h4>
    <p> <?php echo $data['destination'];?> </p>
    <br>
    </div>
  
  <a href="placeorder.php?id=<?php echo $id; ?>" type="submit" class="btn btn-success"> Book </a> 

</div>
<br><br>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>