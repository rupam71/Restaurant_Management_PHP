<?php
session_start();

if($_SESSION["customerType"] != 'admin'){
  header("Location: index.php");
  exit();
}
if(isset($_GET['bel'])){
  $_SESSION["customerId"] = '';
  $_SESSION["customerName"] = '';
  $_SESSION["customerEmail"] = '';
  $_SESSION["customerAddress"] = '';
  $_SESSION["phoneNo"] = '';
  $_SESSION["customerType"] = '';
  header("Location: index.php");
  exit();
}
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

  <title>Admin | All Grills Restaurant</title>

</head>
<body>
  <!-- header starts -->
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
              <a class="nav-link" href="reservation.php">Reservation</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="orderlist.php">Create Order</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="profile.php">' . $_SESSION["customerName"] . '</a>
              </li>';
              echo '<li class="nav-item">
              <a class="nav-link" href="profile.php?bel=log">Logout</a>
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

  <!-- user info start -->
  <section class="contact">
    <div class="container">
      <div class="offset-lg-3 col-lg-6 text-center text-center pt-0">
        <h1 class="title_g">Admin Page</h1>
        <img class="title_decor_g" src="images/headingDecor.png" alt="heading">
      </div>
      <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center">
          <a href="userInfo.php"><button type="submit" class="btn btn-menu mb-4">See User Details</button></a> 
        </div>
      </div>
      <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center">
          <a href="food.php"><button type="submit" class="btn btn-menu">Manage Item</button></a> 
        </div>
      </div>
      <br>
      <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center">
          <a href="viewcontact.php"><button type="submit" class="btn btn-menu">View Messages</button></a> 
        </div>
      </div>
      <br>
      <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center">
          <a href="vieworderlist.php"><button type="submit" class="btn btn-menu">View Orders</button></a> 
        </div>
      </div>
      <br>
      <div class="row">
        <div class="offset-lg-3 col-lg-6 text-center">
          <a href="viewreservation.php"><button type="submit" class="btn btn-menu">View Reservations</button></a> 
        </div>
      </div>

    </div>
  </section>

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
                <li class="list-inline-item c_li"><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="list-inline-item c_li"><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li class="list-inline-item c_li"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li class="list-inline-item c_li"><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
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