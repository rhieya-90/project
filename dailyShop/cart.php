<?php
session_start();
include('../admin/config.php');
$id = $_GET['id'];
$cart_total=0;
if (!empty($_GET["quantity"])) {
  $sql = "SELECT * FROM products";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($row['id']==$id){
       $cart_=array( $row['id']=>array('image' => $row['image'], 'name' => $row['name'], 'price' => $row['price']));
       $updateArray=array($row['id']=>array(
                                              'image'=>$cart_[$row['id']] ['image'],
                                              'quantity'=>$_GET['quantity'],
                                              'name'=>$cart_[$row['id']]['name'],
                                              'price'=>$cart_[$row['id']]['price']
                                          
       ));
    }
  }
}

if (!empty($_SESSION["cart_list"])) {
  $checkArray=array_keys($_SESSION["cart_list"]);
  
  if (in_array($cart_["$id"], $checkArray)) {
      foreach ($_SESSION["cart_list"] as $key => $value) {
          if ($cart_["$id"]==$key) {
                          $_SESSION["cart_list"][$key]["quantity"]=$_SESSION["cart_list"][$key]["quantity"]
                          +$_GET["quantity"];
          }
      }
  } else {
          $_SESSION["cart_list"]=array_merge($_SESSION["cart_list"], $updateArray);
  }
} else {
  $_SESSION["cart_list"]=$updateArray;
}
}


if (!empty($_GET['event']) && $event=="remove") {
  unset($_SESSION["cart_list"]);
}

?>

<?php include('header.php');?>

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
  <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Cart</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- / catg header banner section -->
<?php 
echo '<pre>';
print_r($updateArray);
echo '</pre>';  ?>
        
<!-- Cart view section -->
<section id="cart-view">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form action="" method="post">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($_SESSION["cart_list"] as $cart_items) {
                        ?>
                    <tr>
                      <td><a class="remove" href="cart.php?event=remove">
                          <fa class="fa fa-close"></fa>
                        </a></td>
                      <td><a href="#"><img src="<?php echo $cart_items['image'] ?>" alt="img"></a></td>
                      <td><a class="aa-cart-title" href="#"><?php echo $cart_items['name'] ?></a></td>
                      <td><?php echo '$'.$cart_items['price'] ?></td>
                      <td><input class="aa-cart-quantity" type="number" name="quantity" value="1"></td>
                      <td><?php  echo "$".$cart_items["price"]*$cart_items["quantity"].".00";
                      $cart_total += ($cart_items["price"]*$cart_items["quantity"]);
                      ?></td>
                    </tr>
                    <?php
                  }?>
                    <tr>
                      <td colspan="6" class="aa-cart-view-bottom">
                        <div class="aa-cart-coupon">
                          <input class="aa-coupon-code" type="text" placeholder="Coupon">
                          <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                        </div>
                        <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
            <!-- Cart Total view -->
            <div class="cart-view-total">
              <h4>Cart Totals</h4>
              <table class="aa-totals-table">
                <tbody>
                  <tr>
                    <th>Subtotal</th>
                    <td><?php echo "$". number_format($cart_total, 2); ?></td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td><?php echo "$". number_format($cart_total, 2); ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="checkout.php" class="aa-cart-view-btn">Proced to Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->


<?php include('footer.php'); ?>