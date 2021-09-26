<?php
require '../helpers/dbConnection.php';
if ($_SESSION['User']['roles_id'] == 2) {
    $id  = $_GET['id'];
    $sql = 'select * from images where id ='.$id;

    $op   = mysqli_query($con,$sql);
    $data = mysqli_fetch_assoc($op);
    $offer_id = $data['offers_id'];

    if ($op) {
        # code...
        $sql = "delete from images where id= $id";
        $op  = mysqli_query($con, $sql);
        unlink('../uploads/'.$data['image']);
    }
    header('Location: removeOfferPhoto.php?id='.$offer_id);

}else {
    # code...
    
    header('Location: ../error404.php'); 
}


?>