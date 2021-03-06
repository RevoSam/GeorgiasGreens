<?php 
    session_start();
  if (isset($_POST["submit"])) {
    $name = $_POST["fullname"];
    $name_array = explode(" ", $name);
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $postalCode = $_POST["postal-code"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    
    $fulladdress = $address . ', ' . $city . ', ' . $postalCode;

    $xml = new DOMDocument("1.0","UTF-8");
    $xml->load("data/users.xml");
    $rootTag = $xml->getElementsByTagName("users")->item(0);

    $userTag = $xml->createElement("user");
    $IDTag = $xml->createElement("id_user", rand(2, 100));
    $IDAddTag = $xml->createElement("id_add_user", rand(2, 100));
    $firstNameTag = $xml -> createElement("firstname", $name_array[0]);
    $lastNameTag = $xml->createElement("lastname",$name_array[1]);
    $adminTag = $xml->createElement("admin", 0);
    $emailTag = $xml->createElement("email",$email);
    $passwordTag = $xml->createElement("password", $password);
    $pointsTag = $xml->createElement("points",0);
    $addressTag = $xml->createElement("address",$fulladdress);

    $userTag->appendChild($IDTag); 
    $userTag->appendChild($IDAddTag);
    $userTag->appendChild($firstNameTag);
    $userTag->appendChild($lastNameTag);
    $userTag->appendChild($adminTag);
    $userTag->appendChild($emailTag);
    $userTag->appendChild($passwordTag);
    $userTag->appendChild($pointsTag);
    $userTag->appendChild($addressTag);
    $rootTag->appendChild($userTag);
    $xml->save('data/users.xml');

    header("Location: index.php");
  }
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <title>Sign up</title>
  <link rel="icon" href="assets/GGLogoPicture.png" />
</head>

<body>
<div class="header"><a href="index.php"><img class = "header-image" src="assets/GGLogo.png" width="350"></a>
  <?php
        if (isset($_SESSION["firstname"])) {
          $name = $_SESSION["firstname"];
          echo '<div class="header-user-display">';
            echo "<h2>Welcome, {$name}!</h2>";
          echo "</div>";
        }
      ?>
  </div>
  <div class="blank"></div>
  <div class="row">
    <div class="col-4 menu">
      <div class="dropdown">
        <a id="firstLink" class="nav">Aisles</a>
        <div class="dropdown-content">
          <a class="dropdown-menu" href="Ailes/Meat/Meat.php">Meat</a>
          <a class="dropdown-menu" href="Ailes/FruitsVegetables/FruitsVegetables.php">Fruits & Vegetables</a>
          <a class="dropdown-menu" href="Ailes/Bakery/Bakery.php">Bakery</a>
          <a class="dropdown-menu" href="Ailes/Pantry/Pantry.php">Pantry</a>
          <a class="dropdown-menu" href="Ailes/Dairy/Dairy.php">Dairy</a>
          <a class="dropdown-menu" href="Ailes/CleaningSupplies/CleaningSupplies.php">Cleaning Supplies</a>
        </div>
      </div>
      <?php 
        if (isset($_SESSION["id_user"])) {
          echo '<a class="nav" href="login.php?logout=true">Log out</a>';
        }
        else {
         echo '<a class="nav" href="login.php">Sign in</a>';
        }
      ?>
      <a class="nav" href="shoppingcart.php">Check out</a>
      <input type="text" placeholder="Search for a product..." />
    </div>
  </div>
  <div class="signup-page">
    <div class="contact-details">
      <h1>Contact Details</h1>
      <hr>
      <form id="signup-form" action="" method="post">
        <div class="form-field">
          <h3><label for="name">Full Name:</label></h3>
          <input type="text" id="name" name="fullname" placeholder="" value="">
          <small class="form-error-message"></small>
        </div>
        <div class="form-field">
          <h3><label for="email">Enter your email:</label></h3>
          <input type="text" id="email" name="email" placeholder="example@gmail.com" value="">
          <small class="form-error-message"></small>
        </div>
        <div class="form-field">
          <h3><label for="confirm-email">Confirm your email:</label></h3>
          <input type="email" id="confirm-email" name="email-confirm" placeholder="" value="">
          <small class="form-error-message"></small>
        </div>
        <div class="form-field">
          <h3><label for="pass">Enter your password:</label></h3>
          <input type="password" id="pass" name="pass" value="">
          <small class="form-error-message"></small>
        </div>
        <div class="form-field">
          <h3><label for="confirm-pass">Confirm your password:</label></h3>
          <input type="password" id="confirm-pass" name="c_pass" value="">
          <small class="form-error-message"></small>
        </div>
    </div>
    <div class="address-details">
      <h1>Address</h1>
      <hr>
      <div class="form-field">
        <h3><label for="postal">Postal Code</label></h3>
        <input type="text" id="postal" name="postal-code" placeholder="" value="">
        <small class="form-error-message"></small>
      </div>
      <div class="form-field">
        <h3><label for="address">Address</label></h3>
        <input type="text" id="address" name="address" placeholder="" value="">
        <small class="form-error-message"></small>
      </div>
      <div class="form-field">
        <h3><label for="city">City</label></h3>
        <input type="text" id="city" name="city" placeholder="" value="">
        <small class="form-error-message"></small>
      </div>
    </div>
    <!-- <input class="Login-submit" type="submit" name="Reset" value="Reset"> -->
    <input class="Login-submit" type="submit" name="submit" value="Sign Up">
    </form>


  </div>
  <div class="footer">
    <div id="link-list-left">
      <p><strong>Useful Links</strong></p>
      <a href="#">Page 1</a></a><br>
      <a href="#">Page 2</a></a><br>
      <a href="#">Page 3</a></a><br>
      <a href="#">Page 4</a></a><br>
      <a href="#">Page 5</a></a><br>
      <a href="#">Page 6</a></a><br>
      <a href="#">Page 7</a></a><br>
      <a href="#">Page 8</a></a><br>
    </div>

    <div id="link-list-right">
      <p><strong>Useful Links</strong></p>
      <a href="#">Page X</a></a><br>
      <a href="#">Page 2</a></a><br>
      <a href="#">Page 3</a></a><br>
      <a href="#">Page 4</a></a><br>
      <a href="#">Page 5</a></a><br>
      <a href="#">Page 6</a></a><br>
      <a href="#">Page 7</a></a><br>
      <a href="#">Page 8</a></a><br>
    </div>

    <div id="contact-info">
      <p><strong>OUR SOCIALS</strong></p><br>
      <a href="#" style="padding: 5px;"><img src="assets/FBLogo.png"></a>
      <a href="#" style="padding: 5px;"><img src="assets/TwitterLogo.png"></a>
      <a href="#" style="padding: 5px;"><img src="assets/InstaLogo.png"></a>
      <a href="https://youtu.be/dQw4w9WgXcQ" style="padding: 5px;" target="_blank"><img src="assets/YTLogo.png"></a>
    </div>
  </div>
<script src="scripts/signup.js"></script> 
</body>

</html>
