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

  <title>Order List | All Grills Restaurant</title>

</head>
<body >
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

<section class="contact">
  <div class="container">
    <div class="reservation_title text-center justify-content-center pt-0">
      <h1 class="title_g">All Order History</h1>
      <img class="img-fluid title_decor_g"  src="images/headingDecor.png" alt="heading">
    </div>
    <?php 
    $link = mysqli_connect("localhost","root","","restaurantdb");
    if($link === false) { die ("ERROR: Could Not Connect"); }
    $id=$_SESSION["customerId"];
    $sql = "SELECT a.cartId, a.totalAmount, a.deliveryTime, b.customerName FROM delivery a, customer b WHERE a.customerId= b.customerId ORDER BY `deliveryTime` DESC";
    $result = $link->query($sql);
    while($row = $result->fetch_assoc()) {
    echo '
    <div class="card my-5">
      <div class="card-body">
        <h5 class="card-title">Customer Name : ' . $row["customerName"] . '</h5>
        <h5 class="card-title">Total Amount : ' . $row["totalAmount"] . '</h5>
        <p class="card-text">Time : ' . $row["deliveryTime"] . '</p>
      </div>

      <div class="col-lg-12 col-md-12 table">
        <table class="table-responsive">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total Price</th>
            </tr>
          </thead>
          <tbody>';

           $aa = $row["cartId"] ;
           $sqlq = "SELECT price, quantity, foodName, totalPrice FROM cartmenu WHERE cartId=$aa";
           $resultq = $link->query($sqlq);
           while($rowq = $resultq->fetch_assoc()) {
           echo '
           <tr>
            <td>' . $rowq["foodName"] . '</td>
            <td>' . $rowq["price"] . '</td>
            <td>' . $rowq["quantity"] . '</td>
            <td>' . $rowq["totalPrice"] . '</td>
          </tr>

          ';}

        echo " </tbody>
      </table>
    </div>";
  }
  mysqli_close($link);
  ?>
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
            <p>Lambda's new and expanded Chelsea location represents a truly authentic Greek patisserie, featuring breakfasts of fresh croissants and steaming bowls of café. Lamda the best restaurant in town</p>
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