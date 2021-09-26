
<?php   
    require '../helpers/dbConnection.php';

 

    if ($_SESSION['User']['roles_id'] == 2) {
        $id = $_GET['id'];
        $_SESSION['company_id']=$id;

        # code...
        if ($_SERVER['REQUEST_METHOD']  == "POST") {
            $search = $_POST['search'];
            # code...
            if(!empty($search)){
                $sql = "SELECT bookings.*,offers.offer_description, offers.price , offers.date, offers.destination , users.name , users.city, users.phone FROM `bookings`JOIN offers ON bookings.offers_id = offers.id AND offers.company_id=$id JOIN users on bookings.user_id =users.id WHERE destination like '%$search%' or `name` like '%$search%';";
            }else{
                $sql = "SELECT bookings.*,offers.offer_description, offers.price , offers.date, offers.destination , users.name , users.city , users.phone FROM `bookings`JOIN offers ON bookings.offers_id = offers.id AND offers.company_id=$id JOIN users on bookings.user_id =users.id;";
            }
        }else {
            # code...
            $sql = "SELECT bookings.*,offers.offer_description, offers.price , offers.date, offers.destination , users.name , users.city, users.phone FROM `bookings`JOIN offers ON bookings.offers_id = offers.id AND offers.company_id=$id JOIN users on bookings.user_id =users.id;";

        }
  //  $sql = "SELECT bookings.*,offers.offer_description, offers.price , offers.date, offers.destination , users.name , users.city FROM `bookings`JOIN offers ON bookings.offers_id = offers.id JOIN users on bookings.user_id =users.id;";
    

    $op  =  mysqli_query($con,$sql);
    }else {
        # code...
        header('Location: ../error404.php'); 
    }

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

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
            <h1> Company Bookings </h1>   
            
            <br>

        </div>

        

        <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id; ?>"  enctype ="multipart/form-data">

  

                <div class="form-group">
                    <label for="exampleInputEmail1">Search</label>
                    <input type="text" name="search"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="search with destination or client name">
                </div>

  
                <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class='table table-hover table-responsive table-bordered'>
            <br>
            <!-- creating our table heading -->
            <tr>
                <!-- <th class="number">#</th>
                <th class="id">ID</th> -->
                <th>Client Name</th>
                <th >Client City</th>
                <th >Client Phone</th>
                <th >Offer Description</th>
                <th >Offer Price</th>
                <th >Trip Destination</th>
                <th >Date</th>
                <th>Status</th>
                <th class="action"></th>


            </tr>
            

<?php 
#--- reading records
        while($data = mysqli_fetch_assoc($op)){
?>
            <tr>
               
               <td><?php echo $data['name'];?></td>
               <td><?php echo $data['city'];?></td>
               <td><?php echo "0".$data['phone'];?></td>
               <td><?php echo $data['offer_description'];?></td>
               <td><?php echo $data['price'];?></td>
               <td><?php echo $data['destination'];?></td>
               <td><?php echo $data['date'];?></td>

               <td><?php if($data['is_accepted'] == 0){echo 'Approved';}else{echo 'pinded';}?></td>
                             

                <td>
                    <a href='approve.php?id=<?php echo $data['id'];?>' class='btn btn-success m-r-1em'> Change Status </a>                  
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

    <div>
</body>

</html>