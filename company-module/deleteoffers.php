
<?php 
require '../helpers/dbConnection.php';


if ($_SESSION['User']['roles_id'] == 2) {
    if($_SERVER['REQUEST_METHOD'] == "GET"){
    // code ... 
    require '../helpers/helpers.php';

    $id = sanitize($_GET['id'],1);    // $_REQUEST
        //echo $id;
    $errors = [];

    if(!validate($id,6)){
    $errors['id'] = "InValid Id";
        
    }


    if(count($errors) == 1){
        // 
        echo  $errors['id'];
    }else{

        // delete op ;
        $sql = "delete from offers where id= $id";

        $op  = mysqli_query($con,$sql);
    
        

    
        $id = $_SESSION['companyID'] ;
        //$_SESSION['Message'] = $message;
        header("Location: offers.php?id=$id");
    }
    


    }

}else {
    # code...
    header('Location: ../error404.php'); 
}

?>