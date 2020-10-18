<?php
include('config.php');
$limit = 2;
if (isset($_GET["page"])) {
  $page  = $_GET["page"];
} else {
  $page = 1;
};
$start_from = ($page - 1) * $limit;
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id ASC LIMIT $start_from, $limit");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <li>
      <figure class="table table-bordered table-striped">
        <a class="aa-product-img" href="#"><img src="<?php echo $row["image"]; ?>" alt="polo shirt img"></a>
        <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
        <figcaption>
          <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
          <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
          <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
        </figcaption>
      </figure>
      <div class="aa-product-hvr-content">
        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
      </div>
    <?php
  };
    ?>

    <?php

    $result_db = mysqli_query($conn, "SELECT COUNT(id) FROM products");
    $row_db = mysqli_fetch_row($result_db);
    $total_records = $row_db[0];
    $total_pages = ceil($total_records / $limit);
    /* echo  $total_pages; */
    ?>
    <!-- product badge -->
    <span class="aa-badge aa-sale" href="#">SALE!</span>
    </li>
    <div class="aa-product-catg-pagination">
      <nav>
        <ul class="pagination">
          <li>
            <a href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <?php
          $pagLink = "<ul class='pagination'>";
          for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<li class='page-item'><a class='page-link' href='addproducts.php?page=" . $i . "'>" . $i . "</a></li>";
          }
          echo $pagLink . "</ul>"; ?>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
          </li>
        </ul>
      </nav>
    </div>

    
</body>

</html>