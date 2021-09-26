
<?php   
    require '../helpers/dbConnection.php';
    //echo $_SESSION['Message'];

    
if ($_SESSION['User']['roles_id'] == 2) {
    $email = $_SESSION['User']['email'];
    $password = $_SESSION['User']['password'];
    //echo $email." : ".$password;
    $id = $_GET['id'];
    $_SESSION['companyID'] = $_GET['id'];
    

    $sql = "SELECT `offers`.*, users.name , users.city , users.profilepicture  FROM `offers` JOIN users ON `offers`.`company_id` = users.id and users.id = $id;";
    

    $op  =  mysqli_query($con,$sql);
}else {
    # code...
    header('Location: ../error404.php'); 
}    
    

?>
<!DOCTYPE html>
<html>

<head>
    <title>Offers</title>

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

        

        

        .add{
            position: absolute;
            right: 6%;
            width:15%;
        }

    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1> Offers </h1>   
            
            <br>

        </div>

        


        <h3>Company Offers</h3>
        <!-- <div> <img style="height:150px; width: 150px;" src="./uploads/<?php //echo $data['profilepicture'];?>"/> </div> -->
        
        <table class='table table-hover table-responsive table-bordered'>
            <br>
            <!-- creating our table heading -->
            <tr>
                <!-- <th class="number">#</th>
                <th class="id">ID</th> -->
                <th>Company</th>
                <th >Price</th>
                <th >from</th>
                <th >to</th>
                <th >Description</th>
                <th >Date</th>
                <th class="action">Book</th>


            </tr>
            

<?php 
#--- reading records
        
        while ($data = mysqli_fetch_assoc($op)) {
            # code...
            
        
?>
            <tr>
             
           
               <td><?php echo $data['name'];?></td>
               <td><?php echo $data['price'];?></td>
               <td><?php echo $data['city'];?></td>
               <td><?php echo $data['destination'];?></td>
               <td><?php echo $data['offer_description'];?></td>
               <td><?php echo $data['date'];?></td>
               
               

                <td>
                    <a href='deleteoffers.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a> 
                    <a href='editoffers.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                    <a href='offerphotos.php?id=<?php echo $data['id']; ?>' class='btn btn-info m-r-1em'>Add photos</a>
                    
                </td>

            </tr>
<?php } ?>

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
        <a href='addoffers.php?id=<?php echo $_GET['id']; ?>' type="button" class="add btn btn-success">Add Offer</a>
    <div>
</body>

</html>