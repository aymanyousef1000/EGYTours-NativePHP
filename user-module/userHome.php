
<?php   
    require '../helpers/dbConnection.php';

        $user_id = $_SESSION['User']['id'];

        if (isset($_SESSION['place_order'])) {
            # code...
            echo $_SESSION['place_order'];
        }
        
        unset($_SESSION['place_order']);
        # code...
        if ($_SERVER['REQUEST_METHOD']  == "POST") {
            $search = $_POST['search'];
            # code...
            if(!empty($search)){
                $sql = "SELECT offers.* , users.name , users.city , images.image FROM offers join users on users.id = offers.company_id left JOIN images on images.offers_id = offers.id WHERE destination like '%$search%' or city like '%$search%' GROUP BY offers.id order by offers.id asc;";
            }else{
                $sql = "SELECT  offers.* , users.name , users.city , images.image FROM offers join users on users.id = offers.company_id left JOIN images on images.offers_id = offers.id GROUP BY offers.id ORDER BY
            offers.id ASC";
            }
        }else {
            # code...
            $sql = "SELECT  offers.* , users.name , users.city , images.image FROM offers join users on users.id = offers.company_id left JOIN images on images.offers_id = offers.id GROUP BY offers.id ORDER BY
            offers.id ASC";


        }
        
        
      

    

    $op  =  mysqli_query($con,$sql);
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="EGYTours is a website which links customers with companies" />
        <meta name="author" content="ayman yousef" />
        <title>EGYTours</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
        <style>
            form{
                margin : 40px;
            }

            .search-btn{
                margin-top : 15px;
            }
            
            img.default 
            {
                background-image:url('../images/default.png');
                height: 150px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">EGYTours</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php?id=<?php echo $user_id;?>"> Profile </a></li>
                        
                    </ul>
                    
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <img src="../images/header.jpg">
            <div class="container px-4 px-lg-5 my-5">
                
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Discover New Trips All Around EGYPT</h1>
                    
                </div>
            </div>
        </header>
        <!-- search -->
        
        <form method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  enctype ="multipart/form-data">

  

                <div class="form-group">
                    <label for="exampleInputEmail1">Search</label>
                    <input type="text" name="search"  class="form-control" id="exampleInputName" aria-describedby="" placeholder="search with destination or your city">
                </div>

  
                <button type="submit" class="search-btn btn btn-primary">Search</button>
        </form>
        <!-- Section-->
        
        <section class="py-5">
        
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php 
#--- reading records
                    
                 while($data = mysqli_fetch_assoc($op)){
                    if((time()-(60*60*24)) < strtotime($data['date'])) {
                        
        ?>  <div class="col mb-5">

                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top default" src="../uploads/<?php echo $data['image']; ?>" alt="" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $data['name']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $data['price']." L.E";  ?><br>
                                    <?php echo 'To : '.$data['destination'];  ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href='book.php?id=<?php echo $data['id'];?>'>View Offer</a></div>
                            </div>
                        </div>
                        
                    </div>   <?php } } ?>           </div>
            </div>
            
        </section>
        
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Ayman Yousef 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
