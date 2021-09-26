<?php 

require '../helpers/dbConnection.php';

if ($_SESSION['User']['roles_id'] == 2) {
    $id = $_GET['id'];

    $sql = "select * from images where offers_id=$id; ";
    $op  =  mysqli_query($con,$sql);
}else {
    # code...
    
    header('Location: ../error404.php'); 
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>remove offer photos</title>

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
        a{
            margin-right: 4rem;
        }
        img{
            height: 100px;
            width:100px;
        }

    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1> Offer Photos </h1>   
            
            <br>
           
        </div>

        


   
        
        <table class='table table-hover table-responsive table-bordered'>
            <br>
            <!-- creating our table heading -->
            <tr>
           
                <th>image</th>
                
                <th class="action">Delete</th>


            </tr>
            


            
            <?php 
                #--- reading records
                 while($data = mysqli_fetch_assoc($op)){
            ?>
            <tr>
               <td><img src="../uploads/<?php echo $data['image'];?>" alt=""> </td>
               
               

                <td>

                    <a href='deleteofferphoto.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
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
        <!-- <a href='insert.php' type="button" class="add btn btn-success">Add Task</a> -->
    <div>
</body>

</html>