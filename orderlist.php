<?php 
session_start();

if($_SESSION["customerType"] != 'customer'){
  header("Location: index.php");
  exit();
}

$link = mysqli_connect("localhost","root","","restaurantdb");
if($link === false) { die ("ERROR: Could Not Connect");}

$quantity = @$_POST['quantity'];

if (isset($_GET['order'])) {
  $delId = $_GET['order']; 

  $sql = "SELECT price, foodName FROM food WHERE foodId='$delId'";
  $result = $link->query($sql);

  while($row = $result->fetch_assoc()) {
    $p = $row["price"];
    $f = $row["foodName"];
  }

  if($quantity>=1){
    $totalPrice = $quantity * $p;
    $newCart=array($_SESSION["customerId"],$delId,$p,$quantity,$totalPrice,$f);
    array_push($_SESSION["order"],$newCart);
  }
}

if(isset($_GET['complete'])){
  if(!empty($_SESSION['order'])){
    $id = time();
    $amount=0;
    for ($x=0; $x < sizeOf($_SESSION['order']); $x++){
      $amount += $_SESSION['order'][$x][4];
      $sql ="INSERT INTO cartmenu (cartId, customerId, foodId, price, quantity, totalPrice, foodName) VALUES ('$id', '".$_SESSION["order"][$x][0]."','".$_SESSION["order"][$x][1]."','".$_SESSION["order"][$x][2]."', '".$_SESSION["order"][$x][3]."', '".$_SESSION["order"][$x][4]."', '".$_SESSION["order"][$x][5]."')";
      $resultInsert = mysqli_query($link, $sql) or die(mysqli_error($link));
    }

    $ti=(date("d-m-y, H:i:s",time()+3600*4));

    $sql ="INSERT INTO delivery (customerId, cartId, customerAddress, totalAmount, deliveryTime) VALUES ('".$_SESSION["customerId"]."','$id','".$_SESSION["customerAddress"]."', '$amount','$ti')";
    $resultInsert = mysqli_query($link, $sql) or die(mysqli_error($link));
    $_SESSION["order"] = array();
  }
}

if(isset($_GET['clear'])){
  $_SESSION["order"] = array();
}

mysqli_close($link);

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- font links -->
  <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

  <!-- CSS Links -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/media.css">

  <title>Order List | All Grills Restaurant</title>

</head>
<body>

  <header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light c_nav" style="background-color: #191919 !important">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img id="logo" src="images/logo.png" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_custom" aria-controls="nav_custom" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse menu" id="nav_custom">
          <!-- Menu -->
          <ul class="navbar-nav ml-auto">
            <?php
            if($_SESSION["customerType"]==''){
              echo '<li class="nav-item">
              <a class="nav-link" href="signup.php">SignUp</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
              </li>';
            } else if($_SESSION["customerType"]=='customer') {
              echo '<li class="nav-item">
              <a class="nav-link " href="reservation.php"><span class="fa fa-ticket">Reservation</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="orderlist.php"><i class="fas fa-utensils"></i> Create Order</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="contact.php"><i class="fa fa-envelope"></i> Contact</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> ' . $_SESSION["customerName"] . '</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="editProfile.php"><i class="fas fa-edit"></i>Edit Profile</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="profile.php?bel=log"><i class="fas fa-sign-out-alt"></i>Logout</a>
              </li>';
            } else {
              echo '<li class="nav-item">
              <a class="nav-link" href="food.php"><span class="fa fa-cutlery"> Menu</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="userinfo.php"><i class="fas fa-address-book"></i> User List</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="viewreservation.php"><i class="fa fa-ticket"></i> Reservations</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="vieworderlist.php"><i class="fas fa-list"></i> Orders</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="viewcontact.php"><i class="fa fa-envelope"></i>Messages</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="admin.php"><i class="fas fa-user-circle"></i> ' . $_SESSION["customerName"] . '</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="admin.php?bel=log"><i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>';
            }
            ?>
          </ul>
        </div>  <!-- collapse -->
      </div>  <!-- container -->
    </nav>  
  </header> 
  <!-- contact form start -->
  <section class="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <div class="row">
            <?php 
            $link = mysqli_connect("localhost","root","","restaurantdb");
            if($link === false) {
              die ("ERROR: Could Not Connect");
            }
            $sql = "SELECT * FROM food ";
            $result = $link->query($sql);
            while($row = $result->fetch_assoc()) {
              echo '
              <div class="col-lg-10 col-md-12">
              <div class="card">
              <div class="card-body">
              <h5 class="card-title">' . $row["foodName"] . '</h5>
              <p class="card-text">' . $row["description"] . '</p>
              </div>
              <ul class="list-group list-group-flush">
              <li class="list-group-item">' . $row["category"] . '</li>
              <li class="list-group-item">' . $row["price"] . '</li>
              </ul>
              <div class="card-body">
              '.($_SESSION["customerType"]=="admin" ? 
                '<a href="orderlist.php?del= ' . $row["foodId"] . '" class="btn btn-primary">Delete</a>' 
                : '<form method="POST" action="orderlist.php?order='. $row["foodId"].'" >
                <div class="input-group mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Quantity" name="quantity" aria-describedby="basic-addon2">
                <button type="submit" class="btn btn-primary">Order</button>
                </div>
                </form>' ).' 
              </div>
              </div>  
              </div>';
            }
            mysqli_close($link);
            ?>
          </div>  
        </div>

        <div class="col-lg-4 col-md-12">
          <div>
            <h1>Cart List</h1>
            <table class="r_table table-responsive">
              <thead>
                <tr>
                  <th scope="col">Food Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $amount=0;
                for ($x=0; $x < sizeOf($_SESSION['order']); $x++){
                  echo " <tr>
                  <th class='text-center'>" . $_SESSION['order'][$x][5] . "</th>   
                  <td class='text-center'>" . $_SESSION['order'][$x][2] . "</td>
                  <td class='text-center' >" . $_SESSION['order'][$x][3] . "</td>
                  <td class='text-center' >" . $_SESSION['order'][$x][4] . "</td>
                  </tr>
                  ";
                  $amount += $_SESSION['order'][$x][4];
                }
                ?> 
              </tbody>
            </table>

            <h3>Total Amount: <?php echo $amount;?></h2>
              <a href="orderlist.php?complete" class="btn btn-primary m-2">Complete Order</a>
              <a href="orderlist.php?clear" class="btn btn-danger m-2">Clear cart</a>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- contact form end -->
    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <!-- single item -->
          <div class="offset-lg-0 col-lg-4 offset-md-1 col-md-10 col-sm-12">
            <div class="single_item text-center">
              <div class="f_title">
                <h3>About Us</h3>
                <img class="img-fluid" src="images/footerDecor.png" alt="">
              </div>
              <div class="f_content">
                <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food. <br>Delicious cakes, muffins, and gourmet coffees make us hard to resist! Stop in today and check us out! Perfect materials and freshly baked food.town</p>
              </div>
            </div>
          </div>
          <!-- single item -->
          <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
            <div class="single_item text-center">
              <div class="f_title">
                <h3>Opening Hours</h3>
                <img class="img-fluid" src="images/footerDecor.png" alt="">
              </div>
              <div class="f_content">
                <p>Mon-Thu: 7:00am-8:00pm
                  <br>
                Fri-Sun: 7:00am-10:00pm</p>
                <ul class="list-inline">
                  <li class="list-inline-item c_li"><i class="fab fa-cc-visa"></i></li>
                  <li class="list-inline-item c_li"><i class="fab fa-cc-mastercard"></i></li>
                  <li class="list-inline-item c_li"><i class="fab fa-cc-amex"></i></li>
                  <li class="list-inline-item c_li"><i class="fab fa-cc-paypal"></i></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- single item -->
          <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
            <div class="single_item text-center">
              <div class="f_title">
                <h3>Our Locations</h3>
                <img class="img-fluid" src="images/footerDecor.png" alt="">
              </div>
              <div class="f_content">
                <p>19th Paradise Street Sitia
                  <br>
                128 Meserole Avenue</p>
                <ul class="list-inline">
                  <li class="list-inline-item c_li"><a href="https://twitter.com/home"><i class="fab fa-twitter"></i></a></li>
                  <li class="list-inline-item c_li"><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                  <li class="list-inline-item c_li"><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                  <li class="list-inline-item c_li"><a href="https://www.pinterest.com/"><i class="fab fa-pinterest-p"></i></a></li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </footer>
    <!-- footer end -->

    <!-- JS links -->
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/4814a3fc5b.js" crossorigin="anonymous"></script>
  </body>
  </html>