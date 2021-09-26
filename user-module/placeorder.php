<?php 

require '../helpers/dbConnection.php';

if ($_SESSION['User']['roles_id'] == 1) {

$userId = $_SESSION['User']['id'];
$offerId = $_GET['id'];
// exit();
$sql = "INSERT INTO `bookings`( `is_accepted`, `offers_id`, `user_id`) VALUES (0, $offerId,$userId );";
$op  = mysqli_query($con,$sql);
echo mysqli_error($con);

if ($op) {
    # code...
    $_SESSION['place_order']= 'offer booked successfully';
    header('Location: userHome.php');
}
else {
    echo 'faild pls try again later';
}

}else {
    # code...
    header('Location: ../error404.php'); 

}



?>