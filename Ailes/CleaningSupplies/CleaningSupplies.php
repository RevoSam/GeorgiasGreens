<?php 

  session_start();

  $file_open_aisles = '../../data/aisles.xml';
  $file_open_products = '../../data/product.xml';
  
  if (file_exists($file_open_aisles) && file_exists($file_open_products))
  {
    $aisles = simplexml_load_file($file_open_aisles);
    $products = simplexml_load_file($file_open_products);
    $aisle_found = $aisles->xpath('/aisles/aisle/al_id[.= 6]/parent::*');
    $products_found = $products->xpath('/products/product/pdt_al_id[.= 6]/parent::*');
  }
  else{
    exit('Failed to open ');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="..\..\styles.css" />
    <title>Georgia's Greens - Cleaning Supplies</title>
    <link rel="icon" href="../../assets/GGLogoPicture.png" />
  </head>
  <body>
    <div class="header"><a href="..\..\index.php"><img class = "header-image" src = "..\..\assets/GGLogo.png" width="350"></a>
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
            <a class="dropdown-menu" href="../Meat/Meat.php">Meat</a>
            <a class="dropdown-menu" href="../FruitsVegetables/FruitsVegetables.php">Fruits & Vegetables</a>
            <a class="dropdown-menu" href="../Bakery/Bakery.php">Bakery</a>
            <a class="dropdown-menu" href="../Pantry/Pantry.php">Pantry</a>
            <a class="dropdown-menu" href="../Dairy/Dairy.php">Dairy</a>
            <a class="dropdown-menu" href="../CleaningSupplies/CleaningSupplies.php">Cleaning Supplies</a>
          </div>
        </div>
        <?php 
        if (isset($_SESSION["id_user"])) {
          echo '<a class="nav" href="../../login.php?logout=true">Log out</a>';
        }
        else {
         echo '<a class="nav" href="../../login.php">Sign in</a>';
        }
      ?>
        <a class="nav" href="..\..\shoppingcart.php">Check out</a>
        <input type="text" placeholder="Search for a product..." />
      </div>
    </div>
    <div class="body">
      <div class="products_wrapper">
        <h2>Start Browsing</h2>
        <h1><?php echo $aisle_found[0]->al_name;?> Aisle</h1>
        <div class="products_block">
          <?php 
            echo "<ul>";
              foreach($products_found  as $item){
                echo "<li>";
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("../../Products/product.php?ID=". $id );
                echo "<a href = '{$url}'>";
                echo "<div class = 'product'>";
                $path = "../";
                $path .= $item->img_path;
                echo "<img src = '{$path}'>";
                echo "<h3>{$item->pdt_name}</h3>";
                echo "<h2>{$item->pdt_short_description} ({$item->pdt_package_type})</h2>";
                echo "<span><h2>$ {$item->pdt_price}</h2></span>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
              }
            echo "<li></li>";
            echo "</ul>";
          ?>
          
          <!-- <ul>
            <li>
              <a href="PaperTowel.php">
              <div class="product">
                <img src="..\..\assets/Cleaning Aisle Products/Paper Towel.png">
                <h3>Paper Towel</h3>
                <h4>Strong Paper Towel (2/pkg)</h4>
                <span>$3.49</span>
              </div>
            </a>
            </li>

            <li>
              <a href="TP.php">
              <div class="product">
                <img src="..\..\assets/Cleaning Aisle Products/Toilet Paper.png">
                <h3>Toilet Paper</h3>
                <h4>Soft Double Ply TP (242 Sheets)</h4>
                <span>$6.97</span>
              </div>
              </a>
            </li>

            <li>
              <a href="DishWashingLiquid.php">
              <div class="product">
                <img src="..\..\assets/Cleaning Aisle Products/Dishwashing.png">
                <h3>Dishwashing Liquid</h3>
                <h4>Ultra Dish Detergent (740 ml)</h4>
                <span>$3.99</span>
              </div></a>
            </li>

            <li>
              <a href="GarbageBags.php">
              <div class="product">
                <img src="..\..\assets/Cleaning Aisle Products/Garbage Bags.png">
                <h3>Garbage Bags</h3>
                <h4>Unscented Garbage Bags (50/Roll)</h4>
                <span>$5.99</span>
              </div></a>
            </li>

            <li> 
              <a href="Bleach.php">
              <div class="product">
                <img src="..\..\assets/Cleaning Aisle Products/Bleach.png">
                <h3>Bleach</h3>
                <h4>Original Liquid Bleach (1.27L)</h4>
                <span>$3.49</span>
              </div></a>
            </li>
            <li></li>
          </ul> -->
        </div>
      </div>
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
        <a href="#" style="padding: 5px;"><img src = "..\..\assets/FBLogo.png"></a>
        <a href="#" style="padding: 5px;"><img src = "..\..\assets/TwitterLogo.png"></a>
        <a href="#" style="padding: 5px;"><img src = "..\..\assets/InstaLogo.png"></a>
        <a href="https://youtu.be/dQw4w9WgXcQ" style="padding: 5px;" target="_blank"><img src = "..\..\assets/YTLogo.png"></a>
      </div>
  </div>
  <script src="../../scripts/script.js"></script>
  </body>
</html>
