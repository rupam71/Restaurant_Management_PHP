<?php 
session_start();
$email="";
$password="";
$msg="";

$email=@$_POST['loginEmail']; 
$password=@$_POST['loginPassword']; 

$link = mysqli_connect("localhost","root","","restaurantdb");

if($link === false) {
  die ("ERROR: Could Not Connect");
}

if(!empty($email)){
  $sql = "SELECT customerId, customerName, customerEmail, password, phoneNo, customerAddress, customerType FROM customer WHERE customerEmail='$email'";
  $result = $link->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($row["password"]==$password){
        $_SESSION["customerId"]=$row["customerId"]; 
        $_SESSION["customerName"]=$row["customerName"]; 
        $_SESSION["customerEmail"]=$row["customerEmail"]; 
        $_SESSION["customerAddress"]=$row["customerAddress"]; 
        $_SESSION["phoneNo"]=$row["phoneNo"];
        $_SESSION["customerType"]=$row["customerType"];
        $_SESSION["order"] = array();

        if($_SESSION["customerType"] == "customer"){
          header("Location: profile.php");
          exit();
        } else {
          header("Location: admin.php");
          exit();
        }
        echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
      } else { $msg="Password Not Matched"; }
    } //end of while
  } else { $msg="Email Not Matched"; }
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

  <title>Login | All Grills Restaurant</title>

</head>
<body>
  <header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light c_nav" style="background-color: #191919 !important;">
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
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><span class="fa fa-home fa-lg"></span> Home</a>
            </li>
          </ul>
          <!-- social icons -->
          <div class="s_icons">
            <ul class="list-unstyled c_ul">
             <li class="list-inline-item"><a href="https://twitter.com/home"><i class="fab fa-twitter"></i></a></li>
             <li class="list-inline-item"><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
             <li class="list-inline-item"><a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
           </ul>
         </div>
       </div>
     </div>
   </nav>       
 </header>
 <!-- contact form start -->
 <section class="contact">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md text-center">
        <a href="index.php"><img class="loginImage img-fluid" src="images/login.jpg" alt="" style="margin-top: 0;"></a>
      </div>
      <!-- form top -->
      <div class="offset-lg-1 col-lg-5">
        <div class="text-center pt-0">
          <h1 class="title_g">Login Here</h1>
          <img class="title_decor_g"  src="images/headingDecor.png" alt="heading">
          
          <!-- form start -->
          <form action="login.php" method="POST">
            <div class="text-left">
              <div class="form-group ">
                <label class="loginTextColor">Email</label>
                <input type="email" name="loginEmail" class="form-control" placeholder="Your E-mail*" required>
              </div>
              <div class="form-group ">
                <label class="loginTextColor">Password</label>
                <input type="Password" name="loginPassword" class="form-control" placeholder="Password*" required>
              </div>
            </div>
            <p class="my-5" style="color: red;"><?php echo $msg; ?></p>
            <button type="submit" class="btn btn-menu" style="margin-top: 10px;"><i class="fas fa-sign-in-alt"></i> Login</button>
          </form>
          <br>
          <a href="signup.php" class="btn btn-menu">Create New Account</a>
        </div>
      </div>
    </div>
  </div>
  <!-- contact form end -->
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