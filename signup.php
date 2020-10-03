<?php 
session_start();
$msg="";
$email=@$_POST['signUpEmail']; 
$password=@$_POST['signUpPassword']; 
$name=@$_POST['signUpName'];
$phoneNo=@$_POST['signUpNumber'];
$address=@$_POST['signUpAddress'];

$host='localhost';
$user='root';
$db='restaurantdb';

$link=mysqli_connect($host,$user,"",$db);

if(!empty($email)){
  $result=mysqli_query($link,"SELECT count(customerEmail) as total from customer WHERE customerEmail='$email'");
  $data=mysqli_fetch_assoc($result);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
    $msg= '<i style="color:red;">*Invalid Email Format <br> </i> ';
  }
  else if (!is_numeric($phoneNo)){ 
    $msg='<i style="color:red;">*Phone Number can not contain letters and symbols.<br> </i> ';
  }  
  else if($data['total'] == !0){
    $msg="Already Used This Email";
  }
  else{
    $sql ="INSERT INTO customer (customerName, customerEmail, password, phoneNo, customerAddress, customerType) 
    VALUES ('$name', '$email','$password','$phoneNo', '$address', 'customer')";
    $resultInsert = mysqli_query($link, $sql) or die(mysqli_error($link));
    header("location: login.php");

  }
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

  <title>Sign Up | All Grills Restaurant</title>

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

  <section class="contact">
    <!-- contact form start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md text-center">
          <img class="loginImage img-fluid" src="images/login.jpg" alt="">
        </div>

        <!-- form top -->
        <div class="offset-lg-1 col-lg-5">
          <div class="text-center pt-0">
            <h1 class="title_g">Sign Up Here</h1>
            <img class="title_decor_g"  src="images/headingDecor.png" alt="heading">
            
            <!-- form start -->
            <form action="signUp.php" method="POST">
              <div class="text-left">
                <div class="form-group ">
                  <label class="loginTextColor">Your Name</label>
                  <input type="text" name="signUpName" class="form-control" autocomplete="off" placeholder="Your Name Here*" required>
                </div>
                <div class="form-group ">
                  <label class="loginTextColor">Email</label>
                  <input type="email" name="signUpEmail" class="form-control" autocomplete="off" placeholder="eg. john.cena@gmail.com*" required>
                </div>
                <div class="form-group ">
                  <label class="loginTextColor">Password</label>
                  <input type="password" name="signUpPassword" class="form-control" autocomplete="off" placeholder="Password*" required>
                </div>
                <div class="form-group ">
                  <label class="loginTextColor">Phone No</label>
                  <input type="text" name="signUpNumber" class="form-control" autocomplete="off" placeholder="eg. 015......*" required>
                </div>
                <div class="form-group ">
                  <label class="loginTextColor">Address</label>
                  <input type="text" name="signUpAddress" class="form-control" autocomplete="off" placeholder="house,road,city*" required>
                </div>
              </div>
              <p class="my-5" style="color: red;"><?php echo $msg; ?></p>
              <button type="submit" class="btn btn-menu" style="margin-top: 10px;">Sign Up</button>
            </form>
            <br>
            <a href="login.php">Already have an account? Log In</a>
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