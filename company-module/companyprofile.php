
<?php  
    
        require '../helpers/dbConnection.php';
        require '../helpers/checkLogin.php';
        
        if ($_SESSION['User']['roles_id'] == 2) {
        $email = $_SESSION['User']['email'];
        $password = $_SESSION['User']['password'];
        
        //echo $email." : ".$password;
        $user_id =$_SESSION['User']['id'];

        $sql = "SELECT users.*,companydetails.company_description ,companydetails.address FROM `users` JOIN `companydetails` ON users.id = companydetails.user_id WHERE `email` = '$email' AND `password` = '$password';";
    

        $op  =  mysqli_query($con,$sql);
        }else {
            # code...
            header('Location: ../error404.php'); 
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
           
            margin-left:10%;
            margin-right: 10%;
            margin-bottom: 1rem;
            width:80%;
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
            <a href="../logout.php"> Logout </a>
        </div>

        
<?php 
#--- reading records
        $data = mysqli_fetch_assoc($op);
?>

        <h3>Company Informations</h3>
        <div> 
            <img class="default" style="height:150px; width: 150px;" src="../uploads/<?php echo $data['profilepicture'];?>"/>
            <a href="changCompanyProfile.php?id=<?php echo $user_id; ?>"> change profile picture </a>
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
                <th >Company Description</th>
                <th >Address</th>
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
               <td><?php echo $data['company_description'];?></td>
               <td><?php echo $data['address'];?></td>
               

                <td>
                    <!-- <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a> -->
                    <a  href='editcompany.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>
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
        <h3 style="margin-left:5%; margin-bottom:2rem;">Company offers & bookings</h3>
        <a href='offers.php?id=<?php echo $data['id'];?>' type="button" class="add btn btn-info">Our Offers</a> 
        <a href='companyBookings.php?id=<?php echo $data['id'];?>' type="button" class="add btn btn-success"> Bookings </a>
    <div>
</body>

</html>