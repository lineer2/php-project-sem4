<?php
session_start();
if(!isset($_GET['id']))
{
	header("location: store.php");
	exit();
}
else {
	//database connection
	require_once 'includes/dbManager.php';
	$dbManager = dbManager::getInstance();
	//get product details with category name
	$product = $dbManager->selectQuery("SELECT `tbl_product`.*,`tbl_category`.`cat_name`
						FROM `tbl_product`
						INNER JOIN `tbl_category`
						ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
						WHERE `pd_id`=".$_GET['id']);
	$product = $product[0];
}
?>
<?php
include 'includes/header.php';
include 'includes/nav.php';
?>
<div id="main">
    <header class="container">
      <ol class="breadcrumb">
        <li><a href="store.php">Store</a></li>
        <li><a href="store.php?category=<?php echo $product->cat_id ?>"><?php echo $product->cat_name ?></a></li>
        <li class="active"><?php echo $product->pd_name ?></li>
      </ol>
    </header>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="img/uploads/<?php echo $product->pd_image; ?>" class="img-responsive">
        </div>
        <div class="col-md-8">
          <h3><?php echo $product->pd_name ?></h3>
          <hr>
          <?php 
            // $fmt = new \NumberFormatter( "de_DE", \NumberFormatter::CURRENCY );
          ?>
          <h4><strong>Price: </strong><?php
          // echo $fmt->formatCurrency($product->pd_price, "EUR");
          echo sprintf('%01.2f', $product->pd_price); ?> &euro;</h4>
          <p><?php echo $product->pd_description ?  $product->pd_description : '<span>No description</span>'; ?></p>
          <p>Available Quantity: <span class="badge"><?php echo $product->pd_qty ?></span></p>
          <a href="cart.php?add=<?php echo $product->pd_id; ?>" class="btn">Add to Cart<br></a>
        </div>
      </div>
    </div>
</div>
<?php
include 'includes/footer.php';
?>