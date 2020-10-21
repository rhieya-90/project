<?php
include('../admin/config.php');

if (isset($_POST['action'])) {
    $sql = "SELECT * FROM products WHERE";
    if (isset($_POST['category'])) {
        $category_filter = implode(",", $_POST['category']);
        $sql .= "categories IN('" . $category_filter . "')";
    }
    if (isset($_POST['tag'])) {
        $tag_filter = implode(",", $_POST['tag']);
        $sql .= "tags IN('" . $tag_filter . "')";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output.='<ul class="aa-product-catg ">
               

                <li>
                    <figure>
                        <a class="aa-product-img" href="#"><img src="'. $row["image"].'"alt="polo shirt img"></a>
                        <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                            <h4 class="aa-product-title"><a href="#">'. $row["name"].'</a></h4>
                            <span class="aa-product-price"><?php echo $row["price"]; ?></span><span class="aa-product-price"><del>'.  $row["price"].'/del></span>
                            <p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
                        </figcaption>
                    </figure>
                    <div class="aa-product-hvr-content">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                    </div>
                    <!-- product badge -->
                    <!--<span class="aa-badge aa-sale" href="#">SALE!</span> -->
                </li>
            </ul>';
        }
    } else {
        $output='<h3>No Data</h3>';
    }
    echo $output;
}
