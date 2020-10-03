<?php 
session_start();

if($_SESSION["customerType"] != 'admin'){
header("Location: index.php");
exit();
}

$host='localhost';
$user='root';
$db='restaurantdb';

$id=0;
$msg="";
$foodName=""; 
$category="";
$price="";
$description="";

$mysqli=new mysqli($host,$user,"",$db) or die(mysqli_error($mysqli));

if(isset($_POST['add'])){
  $foodName=@$_POST['foodName']; 
  $category=@$_POST['category']; 
  $price=@$_POST['price'];
  $description=@$_POST['description'];

  $result=mysqli_query($mysqli,"SELECT count(foodName) as total from food WHERE foodName='$foodName'");
  $data=mysqli_fetch_assoc($result);

  if($data['total'] == !0){
    $msg='<i style="color:red;">*This Item Already Exists.<br> </i> ';
  }
  else if (!is_numeric($price)){ 
    $msg='<i style="color:red;">*Price can not contain letters and symbols.<br> </i> ';
  }
  else{
    $sql ="INSERT INTO food (foodName, category, price, description) 
    VALUES ('$foodName', '$category','$price','$description')";
    $resultInsert = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

  }
}

if(isset($_GET["delete"])){
  $id=$_GET['delete'];

  $mysqli->query("DELETE  FROM food WHERE foodId=$id") or die($mysqli->error);
  header("location: food.php");

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

  <title>Food | All Grills Restaurant</title>

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
<!--addFood starts-->
<div id="addFoodModal" class="list modal fade" role="dialog">
  <div class="modal-dialog modal-lg" role="content">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title_g">Food Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php 
        $mysqli=new mysqli($host,$user,"",$db) or die(mysqli_error($mysqli));
        $result= $mysqli->query("Select * From food") or die($mysqli->error); 
        ?>
        <form action="food.php" method="POST">
          <div class="text-left">
            <div class="form-group ">
              <label class="loginTextColor">Food Name</label>
              <input type="text" name="foodName" class="form-control" autocomplete="off" placeholder="Item Name Here*" required>
            </div>
            <div class="form-group ">
              <label class="loginTextColor">Category</label>
              <div class="input-group mb-3">
                <select class="custom-select" name="category">
                  <option value="Appetisers">Appetisers</option>
                  <option value="Starters">Starters</option>
                  <option value="Salads">Salads</option>
                  <option value="Main_dishes">Main Dishes</option> 
                  <option value="Drinks">Drinks</option>
                </select>
              </div>
            </div>
            <div class="form-group ">
              <label class="loginTextColor">Price</label>
              <input type="text" name="price" class="form-control" autocomplete="off" placeholder="250*" required>
            </div>
            <div class="form-group ">
              <label class="loginTextColor">Description</label>
              <input type="text" name="description" class="form-control" autocomplete="off" placeholder="Write something about the food*" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2 col-sm-12"></div>
            <div class="col-md-10 col-sm-12">
              <button type="button" class="btn btn-secondary btn-sm ml-auto" data-dismiss="modal">Cancel</button>                      
              <button type="submit" onclick="added()" class="btn btn-submit" name="add">Add</button> 
            </div>       
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- addFood ends -->
<!-- user info start -->
<div class="container">
  <div class="offset-lg-3 col-lg-6 text-center mt-4">
    <h1 class="title_g">Food Items</h1>
    <img class="title_decor_g img-fluid" src="images/headingDecor.png" alt="heading">
  </div>

  <div class="row justify-content-center">
    <div class=" col-lg-4 text-center">
      <a data-toggle="modal" data-target="#addFoodModal">
        <button type="submit" class="btn btn-menu"><i class="fas fa-plus"></i> Add a New Item </button></a>
      </div>

    </div>
    <div class="row justify-content-center">
      <?php echo $msg; ?>
    </div>

    <div class="row">
      <div class="col-md">
        <div class="table-responsive r_table">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <th>Food ID</th>
              <th>Food Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Description</th>
              <th></th>
            </thead>
            <tbody>

              <?php 
              while ($row = mysqli_fetch_assoc($result)){
              $foodId = $row['foodId'];
              $foodName = $row['foodName'];
              $category = $row['category']; 
              $price = $row['price'];
              $description = $row['description'];  
              ?>
              <tr>
                <td><?php echo $foodId; ?></td>
                <td><?php echo $foodName; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $price." Tk"; ?></td>
                <td><?php echo $description; ?></td>

                <td><a href="food.php?delete=<?php echo $foodId;?>" onclick="removed()" class="btn btn-danger"  data-toggle="tooltip" data-html="true"  title="Delete" data-placement="bottom" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              </tr>
              <?php  }  ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
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