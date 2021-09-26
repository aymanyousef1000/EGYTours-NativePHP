
<?php   

    require '../helpers/dbConnection.php';
    require '../helpers/checkLogin.php';
    if ($_SESSION['User']['roles_id'] == 1) {
        # code...
   
    
    
    $email = $_SESSION['User']['email'];
    $password = $_SESSION['User']['password'];
   
    $user_id =$_SESSION['User']['id'];
    $sql = "SELECT `id`, `name`, `email`, `password`, `city`,`profilepicture`,`phone`, `roles_id` FROM `users` WHERE `email` = '$email' AND `password` = '$password';";
 

    $op  =  mysqli_query($con,$sql);
    }else {
        header('Location: ../error404.php');   // ../company-module/companyprofile
    }

?>

<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }

        .action{
            width:10%;
        }

        
        img{
            border-radius: 50%;
        }
        

        .add{
            position: absolute;
            right: 6%;
            width:15%;
        }
        a{
            margin-right: 4rem;
        }

        img.default 
        {
            background-image:url('default.png');
            height: 150px;
            width: 100%;
        }

    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1> My Profile </h1>   
            
            <br>
            <a href="userHome.php"> Home </a>
            <a href="myorders.php?id=<?php echo $user_id; ?>"> My Trips </a>
            <a href="../logout.php"> Logout </a>
        </div>

        
<?php 
#--- reading records
        $data = mysqli_fetch_assoc($op);
?>

        <h3>Personal Informations</h3>
        <div> 
            <img class="default" style="height:150px; width: 150px;" src="<?php echo '../uploads/'.$data['profilepicture']?>"/> 
            <a href="changProfilePic.php?id=<?php echo $user_id; ?>"> change profile picture </a>
        </div>
        
        <table class='table table-hover table-responsive table-bordered'>
            <br>
            <!-- creating our table heading -->
            <tr>
                <!-- <th class="number">#</th>
                <th class="id">ID</th> -->
                <th>name</th>
                <th >email</th>
                <th >city</th>
                <th >phone</th>
                <th >Account Type</th>
                <th class="action">Edit</th>


            </tr>
            


            <tr>
               
               <td><?php echo $data['name'];?></td>
               <td><?php echo $data['email'];?></td>
               <td><?php echo $data['city'];?></td>
               <td><?php echo $data['phone'];?></td>
               <td><?php if ($data['roles_id']==1) {
                   # code...
                   echo 'user';
               }elseif($data['roles_id']==2) {
                   echo 'company';
               }?></td>
               

                <td>
                    <!-- <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a> -->
                    <a href='../edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
                    <a href='../modifypassword.php?id=<?php echo $data['id'];?>' class='btn btn-warning m-r-1em'>Change password</a>
                </td>

            </tr>


            <!-- end table -->
        </table>
        

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->
    <div>
        <!-- <a href='insert.php' type="button" class="add btn btn-success">Add Task</a> -->
    <div>
</body>

</html>