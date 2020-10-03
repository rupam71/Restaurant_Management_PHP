<?php 
session_start();

if($_SESSION["customerType"] != 'customer'){
header("Location: index.php");
exit();
}

$userId = $_SESSION["customerId"]; 
$customerName=$_SESSION["customerName"];
$customerEmail=$_SESSION["customerEmail"]; 
$customerAddress=$_SESSION["customerAddress"]; 
$customerPhone=$_SESSION["phoneNo"];

$host='localhost';
$user='root';
$db='restaurantdb';
$e_id=0;
$link=mysqli_connect($host,$user,"",$db);


if (isset($_POST['save'])){
  $c_name = $_POST['e_customerName'];
  $c_password = $_POST['e_password'];
  $c_phoneNo = $_POST['e_phoneNo'];
  $c_address = $_POST['e_customerAddress'];

  $query = "UPDATE customer SET customerName = '$c_name', password = '$c_password', phoneNo = '$c_phoneNo', customerAddress = '$c_address' WHERE customerId = $userID";
  $run = mysqli_query($link, $query);

  if(!run){
    die("Failed");
  }else{
  header("Location: editProfile.php");
  }
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

  <title>Lambda Restaurant</title>

</head>
<body >
	<header>
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
          }else if($_SESSION["customerType"]=='customer') {
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
          } 
          else {
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
<!-- form start -->
<section class="contact">
  <div class="container">
    <div class="row">
      <div class=" col-lg col-sm-12 text-center reservation_title">
        <!-- title -->
        <h1 class="title_g">Edit Your Profile</h1>
        <img class="img-fluid title_decor_g"  src="images/headingDecor.png" alt="heading">
      </div>
    </div>
    <?php  
      $query = "SELECT * FROM customer";
      $result = mysqli_query($link, $query);
    ?>
    <?php
    while ($row = mysqli_fetch_assoc($result)){
      $customerId = $row['customerId'];
      $password = $row['password'];

      if ($customerId==$userId) {
    ?>
      <div class="row justify-content-center loginTextColor">
        <h4>Email:</h4>
        <h4><?php echo $customerEmail; ?></h4>
      </div>
      <?php 
      $sql = "SELECT * FROM customer WHERE  customerId = $userId";
      $result = mysqli_query($link, $sql);
      $data = mysqli_fetch_array($result);
      ?>
    <div class="loginTextColor ">
      <form action="" method="POST">
        <div class="row">
          <div class="col-lg-8">
            <h5>User Name</h5>
            <div class="form-group">
              <input class="form-control" type="text" name="e_customerName" autocomplete="off" placeholder="" value="<?php echo $data['customerName']; ?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <h5>Password</h5>
              <div class="form-group">
                <input class="form-control" type="text" name="e_password" autocomplete="off" placeholder="" value="<?php echo $data['password']; ?>">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <h5>Phone No</h5>
              <div class="form-group">
                <input class="form-control" type="text" name="e_phoneNo" autocomplete="off" placeholder="" value="<?php echo $data['phoneNo']; ?>">
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
            <h5>Address</h5>
              <div class="form-group">
                <input class="form-control" type="text" name="e_customerAddress" autocomplete="off" placeholder="" value="<?php echo $data['customerAddress']; ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
         <input class=" btn btn-menu ml-auto" value="Save Changes" type="submit" name="save" onclick="saved();"> 
        </div>
      </form>    
    <?php  }   }?>

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
            <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food. <br><br>Delicious Lambda cakes, muffins, and gourmet coffees make us hard to resist! Stop in today and check us out! Perfect materials and freshly baked food.</p>
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