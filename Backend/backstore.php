<?php 
    session_start();
    if (isset($_SESSION["admin"])){
        if ($_SESSION["admin"] == 0) {
            header("location: ../index.php");
        }
    }
    else {
        header("location: ../index.php");
    }
?>
<?php 
  $file_open_aisles = '../data/aisles.xml';//'../../data/aisles.xml'
  $file_open_products = '../data/product.xml';
  
  if (file_exists($file_open_aisles) && file_exists($file_open_products))
  {
    $aisles = simplexml_load_file($file_open_aisles);
    $products = simplexml_load_file($file_open_products);
    $aisle_found = $aisles->xpath('/aisles/aisle/al_id[.= 5]/parent::*');

    $fav_products_found = $products->xpath('/products/product/pdt_al_id[.= 1]/parent::*');
    $meat_products_found = $products->xpath('/products/product/pdt_al_id[.= 2]/parent::*');
    $bakery_products_found = $products->xpath('/products/product/pdt_al_id[.= 3]/parent::*');
    $pantry_products_found = $products->xpath('/products/product/pdt_al_id[.= 4]/parent::*');
    $dairy_products_found = $products->xpath('/products/product/pdt_al_id[.= 5]/parent::*');
    $cleaning_products_found = $products->xpath('/products/product/pdt_al_id[.= 6]/parent::*');
  }
  else{
    exit('Failed to open ');
  }


//Delete an item from the xml file
if(isset($_POST["delete"]))
{
    $xml = new DomDocument("1.0","UTF-8");
    $xml->load("../data/product.xml");
foreach($_POST as $key=>$value)
    {
        $product_to_delete_id = $value;
    }
    $xpath = new DOMXPATH($xml);

foreach($xpath->query("/products/product[pdt_id = '$product_to_delete_id']") as $node)
    {
        $node->parentNode->removeChild($node);
    }

    $xml->save("../data/product.xml");
    header("Location: backstore.php");
}

if(isset($_POST["edit"])){
    foreach($_POST as $key=>$value)
    {
        $product_to_edit_id = $value;
    }
    header("Location: product-edit.php?ID={$product_to_edit_id}");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backstore.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<form method = "POST">
    <header>
        <?php
            if (isset($_SESSION["firstname"])){
                $name = $_SESSION["firstname"];
                echo '<p class="user-display"> Welcome, '.$name.'! </p>';
            }
            else {
                echo "<p>Welcome User</p>";
            }
        ?>
    </header>
    <aside>
        <img src="../assets/GGLogoPicture.png" onclick="location.href='../index.php'">
        <a href="backstore.php"><span class="glyphicon glyphicon-tags"></span>&nbsp&nbspProducts</a>
        <a href="user-list.php"><span class="glyphicon glyphicon-user"></span>&nbsp&nbspUsers</a>
        <a href="order-list.php"><span class="glyphicon glyphicon-credit-card"></span>&nbsp&nbspOrders</a>
        <a href="../index.php"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspHome</a>
        <?php 
        if (isset($_SESSION["id_user"])) {
          echo '<a href="../login.php?logout=true"><span class="glyphicon glyphicon-remove"></span>&nbsp&nbspLog Out</a>';
        }
        else {
         echo '<a class="nav" href="login.php">Sign in</a>';
        }
      ?>
    </aside>
    <div class="additional-components">
        <button type="button" id = "button-header" onclick="location.href='product-edit.php'">Add product</button>
        <input type="text" placeholder="Search..">
        <label for="search-keyword"><span class="glyphicon glyphicon-search"></span>&nbsp Search by keyword: </label> 
    </div>
    <div class="margins">
        <div class="inventory-table">
            <div class="ailes">
                <p>Meat</p>
            </div>
            <?php 
              foreach($meat_products_found  as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>MEAT</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button name = edit class = \"edit-button\" value = {$item->pdt_id} onclick = location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete  class = \"delete-button\" value = \"{$item->pdt_id}\"><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
            <div class="ailes">
                <p>Fruits and Vegetables</p>
            </div>
            <?php 
              foreach($fav_products_found  as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>FRUITS AND VEGETABLE</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button name = edit class = \"edit-button\" value = {$item->pdt_id} onclick = location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete  class = \"delete-button\" value = \"{$item->pdt_id}\"><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
            <div class="ailes">
                <p>Bakery</p>
            </div>
            <?php 
              foreach($bakery_products_found as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>BAKERY</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button name = edit class = \"edit-button\" value = {$item->pdt_id} onclick = location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete  class = \"delete-button\" value = \"{$item->pdt_id}\"><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
            <div class="ailes">
                <p>Pantry</p>
            </div>
            <?php 
              foreach($pantry_products_found  as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>PANTRY</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button name = edit class = \"edit-button\" value = {$item->pdt_id} onclick = location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete  class = \"delete-button\" value = \"{$item->pdt_id}\"><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
            <div class="ailes">
                <p>Dairy</p>
            </div>
            <?php 
              foreach($dairy_products_found  as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>DAIRY</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button name = edit class = \"edit-button\" value = {$item->pdt_id} onclick = location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete  class = \"delete-button\" value = \"{$item->pdt_id}\"><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
            <div class="ailes">
                <p>Cleaning Supplies</p>
            </div>
            <?php 
              foreach($cleaning_products_found  as $item){
                $id = urlencode($item->pdt_id);
                $url = htmlspecialchars("product-edit.php?ID=". $id );
                echo "<div class = \"product\">";
                    echo "<div class = \"brand-container\">";
                        echo "<p> {$item->pdt_brand_name}";
                    echo "</div>";
                    echo "<div class=\"name-container\">";
                        echo "<p>{$item->pdt_name}</p>";
                    echo "</div>";
                    echo "<div class=\"department-container\">";
                        echo "<p>CLEANING SUPPLIES</p>";
                    echo "</div>";
                    echo "<div class=\"price-container\">";
                        echo "<p>{$item->pdt_price}$</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<p>{$item->pdt_inventory}</p>";
                    echo "</div>";
                    echo "<div class=\"origin-container\">";
                        echo "<p>{$item->pdt_origin}</p>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button value = {$item->pdt_id} name = edit class = \"edit-button\" onclick= location.href='{$url}'><p>EDIT</p></button>";
                    echo "</div>";
                    echo "<div class=\"small-container\">";
                        echo "<button type = submit name = delete class = \"delete-button\" value = {$item->pdt_id} ><p>DELETE</p></button>";
                    echo "</div>";
                echo "</div>";
              }
          ?>
        </div>
    </div>
    </div>
</form>
</body>
</html>