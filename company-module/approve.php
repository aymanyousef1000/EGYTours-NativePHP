<?php
require '../helpers/dbConnection.php';

$id = $_GET['id'];
$companyId = $_SESSION['company_id'];
$sql = "select * from bookings where id=$id";
$op = mysqli_query($con,$sql);
$data = mysqli_fetch_assoc($op);
if ($op) {
    # code...
    if ($data['is_accepted'] == 0) {
        # code...

        $sql= 'UPDATE `bookings` SET `is_accepted`= 1 WHERE `id`='.$id;
        
        header('Location: companyBookings.php?id='.$companyId);
    }else {
        # code...
        $sql= 'UPDATE `bookings` SET `is_accepted`= 0 WHERE `id`='.$id;
        header('Location: companyBookings.php?id='.$companyId);
    }
    $op = mysqli_query($con,$sql);
}else {
    # code...
    echo 'error in query';
}



?>