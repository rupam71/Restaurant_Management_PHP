<?php session_start(); 

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

  <title>All Grills Restaurant</title>
</head>
<body>
  <!-- header starts -->
  <header>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light c_nav">
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
              <a class="nav-link" href="#"><span class="fa fa-home fa-lg"></span> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about"><span class="fa fa-info fa-lg"></span> About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#ingredients"><span class="fas fa-hand-lizard"></span> Ingredients</a>
            </li>
            <li>
              <a class="nav-link" href="#f_menu"><span class="fa fa-cutlery"></span> Menu</a>
            </li>
            <?php  
            if(@$_SESSION["customerType"]==''){
              echo '<li class="nav-item">
              <a class="nav-link" href="./login.php"><span class="fa fa-ticket"></span> Reservation</a>
              </li>';
            }
            else if(@$_SESSION["customerType"]=='customer'){
              echo '<li class="nav-item">
              <a class="nav-link" href="./reservation.php"><span class="fa fa-ticket"></span> Reservation</a>
              </li>';
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="contact.php"><i class="fa fa-envelope"></i> Messages</a>
            </li>
            
            
            <!-- login system -->
            <?php  
            if(@$_SESSION["customerType"]==''){ ?>
              <div class="login_system">
                <a href="login.php"><button type="button" class="btn btn-login"><i class="fas fa-sign-in-alt"></i>Login</button></a>
                <a href="signup.php"><button type="button" class="btn btn-signup"><i class="fas fa-user-plus"></i> Sign Up</button></a>
              </div>
            <?php }
            else if(@$_SESSION["customerType"]=='customer'){
              echo '<li class="nav-item">
              <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> '.$_SESSION["customerName"].'</a>
              </li>';
            }
            else if(@$_SESSION["customerType"]=='admin'){
              echo '<li class="nav-item">
              <a class="nav-link" href="admin.php"><i class="fas fa-user-circle"></i> ' . $_SESSION["customerName"] . '</a>
              </li>';
            }?>
          </ul>
        </div>
      </div>
    </nav>

  </header>
  <!-- header ends -->
  <!-- slider start -->
  <section class="slider">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg c_pad m_top">
          <!-- carousel start -->
          <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- indicator -->
            <ol id="no_display" class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <!-- inner -->
            <div class="carousel-inner">
              <!-- single item -->
              <div class="carousel-item active">
                <img src="images/slider1.jpg" class="d-block w-100 img-fluid" alt="Lambda">
                <div class="carousel-caption c_caption">
                  <h1 id="no_display">the right ingredients <br> for the right food</h1>
                  <img id="no_display" class="img-fluid" src="images/sliderDecor.png" alt="#"> <br>
                  <?php  
                  if(@$_SESSION["customerType"]==''){ ?>
                    <a href="login.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="login.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='customer'){?>
                    <a href="reservation.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="orderlist.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='admin'){ ?>
                    <a href="viewreservation.php"><button type="button" class="btn btn-book">Reservations</button></a>
                    <a href="food.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } ?>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/slider2.jpg" class="d-block w-100 img-fluid" alt="Lambda">
                <div class="carousel-caption c_caption">
                  <h1 id="no_display">The perfect balance <br> of flavours</h1>
                  <img id="no_display" class="img-fluid" src="images/sliderDecor.png" alt="#">
                  <br>
                  <?php  
                  if(@$_SESSION["customerType"]==''){ ?>
                    <a href="login.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="login.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='customer'){?>
                    <a href="reservation.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="orderlist.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='admin'){ ?>
                    <a href="viewreservation.php"><button type="button" class="btn btn-book">Reservations</button></a>
                    <a href="food.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } ?>
                </div>
              </div>
              <div class="carousel-item">
                <img src="images/slider3.jpg" class="d-block w-100 img-fluid" alt="Lambda">
                <div class="carousel-caption c_caption">
                  <h1 id="no_display">We don’t make it <br> ‘til you order it</h1>
                  <img id="no_display" class="img-fluid" src="images/sliderDecor.png" alt="#"> <br>
                  <?php  
                  if(@$_SESSION["customerType"]==''){ ?>
                    <a href="login.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="login.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='customer'){?>
                    <a href="reservation.php"><button type="button" class="btn btn-book">BOOK A TABLE</button></a>
                    <a href="orderlist.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } 
                  else if(@$_SESSION["customerType"]=='admin'){ ?>
                    <a href="viewreservation.php"><button type="button" class="btn btn-book">Reservations</button></a>
                    <a href="food.php"><button type="button" class="btn btn-menu">SEE THE MENU</button></a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <a id="no_display" class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a id="no_display" class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- slider end -->
  <!-- about start -->
  <section class="about" id="about">
    <div class="container">
      <div class="row">
        <div class="offset-lg-1 col-lg-4">
          <!-- about contents -->
          <div class="about_contents text-center">
            <h1 class="title_g">Just the right food</h1>
            <img class="img-fluid title_decor_g"  src="images/headingDecor.png" alt="food">
            <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food, delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out!</p>
            <img class="img-fluid chef_img" src="images/chef.png" alt="chef">
          </div>
        </div>
        <!-- about image -->
        <div class="offset-lg-1 col-lg-6 text-center">
          <img class="img-fluid about_img" src="images/aboutDish.png" alt="food">
        </div>
      </div>
    </div>
  </section>
  <!-- about end -->
  <!-- ingredients start -->
  <section class="ingredients" id="ingredients">
    <div class="container">
      <div class="row">
        <div class="offset-lg-6 offset-md-1 col-lg-6 col-md-10">
          <div class="ing_contents text-center">
            <h1 class="title_w">Fine ingredients</h1>
            <img class="img-fluid title_decor_w"  src="images/textDecorW.png" alt="heading">
            <p>If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food, delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out!</p>
            <!-- ingredients image -->
            <ul class="list-inline">
              <li class="list-inline-item"><img class="img-fluid" src="images/in1.png" alt=""></li>
              <li class="list-inline-item"><img class="img-fluid" src="images/in2.png" alt=""></li>
              <li class="list-inline-item"><img class="img-fluid" src="images/in3.png" alt=""></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ingredients end -->
  <!-- menu starts -->
  <section class="f_menu" id="f_menu">
    <div class="container">
      <!-- 1st row -->
      <div class="row">
        <!-- single menu -->
        <div class="offset-lg-1 col-lg-4">
          <div class="single_menu">
            <!-- title -->
            <div class="title text-center">
              <h1 class="title_g">Appetisers</h1>
              <img class="img-fluid title_decor_g" src="images/headingDecor.png" alt="">
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Chipotle</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Pepperoni Pizza</h5>
              <h5 class="price">500</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Rotisserie Chicken</h5>
              <h5 class="price">350</h5>
              <hr>
            </div>
          </div>
        </div>
        <!-- single menu -->
        <div class="offset-lg-2 col-lg-4 mb-0 h-25">
          <div class="single_menu">
            <!-- title -->
            <div class="title text-center">
              <h1 class="title_g">Starters</h1>
              <img class="img-fluid title_decor_g" src="images/headingDecor.png" alt="">
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Firehouse Subs</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Noodles World Kitchen</h5>
              <h5 class="price">300</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Roast Beef Sandwich</h5>
              <h5 class="price">350</h5>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <!-- 2nd row -->
      <div class="row">
        <!-- single menu -->
        <div class="offset-lg-1 col-lg-4 mt-4">
          <div class="single_menu">
            <!-- title -->
            <div class="title text-center">
              <h1 class="title_g">Fries</h1>
              <img class="img-fluid title_decor_g" src="images/headingDecor.png" alt="">
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Waffle Fries</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">McDonald's: Fries</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Whataburger</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
          </div>
        </div>
        <!-- single menu -->
        <div class="offset-lg-2 col-lg-4 mt-4">
          <div class="single_menu">
            <!-- title -->
            <div class="title text-center">
              <h1 class="title_g">Main Dishes</h1>
              <img class="img-fluid title_decor_g" src="images/headingDecor.png" alt="">
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Footlong Turkey Sub</h5>
              <h5 class="price">250</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Cheeseburger</h5>
              <h5 class="price">300</h5>
              <hr>
            </div>
            <!-- single item -->
            <div class="item">
              <h5 class="name">Mac and Cheese</h5>
              <h5 class="price">350</h5>
              <hr>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg justify-content-center text-center">
        <?php  
        if(@$_SESSION["customerType"]==''){ ?>
          <a href="login.php"><button type="button" class="btn btn-book">Order Now</button></a>
          <a href="login.php"><button type="button" class="btn btn-menu">See The Menu</button></a>
        <?php } 
        else if(@$_SESSION["customerType"]=='customer'){?>
          <a href="orderlist.php"><button type="button" class="btn btn-book">Order Now</button></a>
          <a href="orderlist.php"><button type="button" class="btn btn-menu">See The Menu</button></a>
        <?php } 
        else if(@$_SESSION["customerType"]=='admin'){ ?>
          <a href="vieworderlist.php"><button type="button" class="btn btn-book">Order List</button></a>
          <a href="food.php"><button type="button" class="btn btn-menu">See The Menu</button></a> 
        <?php } ?>
      </div> 
    </div>
  </section>
  <!-- menu end -->

  <!-- contact form start -->
  <section class="contact" id="contact">
    <div class="container">
      <div class="row">
        <!-- image1 -->
        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
          <img class="img-fluid contact_img" src="images/contact1.jpg" alt="">
        </div>
        <!-- image2  -->
        <div class="col-lg-3 col-md-6 col-sm-6 text-center">
          <img class="img-fluid contact_img" src="images/contact2.jpg" alt="">
        </div>
        <!-- form top -->
        <div class="offset-lg-1 col-lg-5">
          <div class="about_contents text-center pt-4">
            <h1 class="title_g">Just the right food</h1>
            <img class="img-fluid title_decor_g"  src="images/headingDecor.png" alt="heading">
            <p class="c_txt">If you’ve been to one of our restaurants, you’ve seen – and tasted – what keeps our customers coming back for more. Perfect materials and freshly baked food. <br><br>Delicious Lambda cakes,  muffins, and gourmet coffees make us hard to resist! Stop in today and check us out! Perfect materials and freshly baked food.</p>
            <?php  
            if(@$_SESSION["customerType"]==''){ ?>
              <a href="login.php"><button type="button" class="btn btn-menu">Make Reservation</button></a>
            <?php } 
            else if(@$_SESSION["customerType"]=='customer'){?>
              <a href="reservation.php"><button type="button" class="btn btn-menu">Make Reservation</button></a>
            <?php } 
            else if(@$_SESSION["customerType"]=='admin'){ ?>
              <a href="viewreservation.php"><button type="button" class="btn btn-menu">See the Reservations</button></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- contact form end -->
  <!-- footer -->
  <footer>
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