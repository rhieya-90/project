<?php
include('config.php');
$errors = array();
$message = '';
if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $filename = isset($_FILES['file']) ? $_FILES['file']['name'] : '';
    $file_temp_name = isset($_FILES['file']) ? $_FILES['file']['tmp_name'] : '';
    $folder = "images/" . $filename;
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $tags = isset($_POST['check_list']) ? $_POST['check_list'] : '';
    if (isset($_POST['check_list'])) {
        $tag_ = $_POST['check_list'];
        $tag = implode(",", $tag_);
    }

    if ($id == '') {
        array_push($errors, array('input' => 'id', 'msg' => 'id empty'));
    }
    if ($name == '') {
        array_push($errors, array('input' => 'name', 'msg' => 'name empty'));
    }
    if ($price == '') {
        array_push($errors, array('input' => 'price', 'msg' => 'price empty'));
    }
    if ($filename == '') {
        array_push($errors, array('input' => 'file', 'msg' => 'file empty'));
    }
    if ($category == '') {
        array_push($errors, array('input' => 'category', 'msg' => 'category empty'));
    }
    if ($description == '') {
        array_push($errors, array('input' => 'description', 'msg' => 'description empty'));
    }
    if ($color == '') {
        array_push($errors, array('input' => 'color', 'msg' => 'color empty'));
    }
    $sql = "SELECT id FROM products WHERE 
        `id`='" . $id . "'";
    $fire = mysqli_query($conn, $sql) or die("can not fire the query" . mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire) > 0) {
        array_push($errors, array('query' => 'add', 'msg' => "id exists"));
    }
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO products(`id`, `name`, `price`, `image`, `long_description`, `category_id`, `color`, `tags`)VALUES
        ('" . $id . "', '" . $name . "', '" . $price . "', '" . $folder . "', '" . $description . "', '" . $category . "', '" . $color . "', '" . $tag . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<div id="main-content">
    <!-- Main Content Section with everything -->

    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div>
                Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
            </div>
        </div>
    </noscript>

    <!-- Page Head -->
    <h2>Welcome John</h2>
    <p id="page-intro">What would you like to do?</p>

    <div>
        <?php if (sizeof($errors) > 0) : ?>
            <ul>
                <?php foreach ($errors as $key => $error) : ?>
                    <li><?php echo $error['msg']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>


    <div class="clear"></div> <!-- End .clear -->

    <div class="content-box">
        <!-- Start Content Box -->

        <div class="content-box-header">

            <h3>Products box</h3>

            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
                <li><a href="#tab2">Add</a></li>
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">

            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->

                <div class="notification attention png_bg">
                    <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div>
                        This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                    </div>
                </div>

                <table>

                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" /></th>
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>PRICE</th>
                            <th>DESCRIPTION</th>
                            <th>CATEGORY_ID</th>
                            <th>COLOR</th>
                            <th>TAGS</th>
                        </tr>

                    </thead>

                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="bulk-actions align-left">
                                    <select name="dropdown">
                                        <option value="option1">Choose an action...</option>
                                        <option value="option2">Edit</option>
                                        <option value="option3">Delete</option>
                                    </select>
                                    <a class="button" href="#">Apply to selected</a>
                                </div>

                                <div class="pagination">
                                    <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                    <a href="#" class="number" title="1">1</a>
                                    <a href="#" class="number" title="2">2</a>
                                    <a href="#" class="number current" title="3">3</a>
                                    <a href="#" class="number" title="4">4</a>
                                    <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                </div> <!-- End .pagination -->
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        $sql = "SELECT * FROM products";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><a href="#" title="title"><?php echo $row['name']; ?></a></td>
                                    <td><?php echo $row['image']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['long_description']; ?></td>
                                    <td><?php echo $row['category_id']; ?></td>
                                    <td><?php echo $row['color']; ?></td>
                                    <td><?php echo $row['tags']; ?></td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="edit_product.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>&image=<?php echo $row['image']; ?>&price=<?php echo $row['price']; ?>&description=<?php echo $row['long_description']; ?>&category=<?php echo $row['category_id']; ?>&color=<?php echo $row['color']; ?>&tags=<?php echo $row['tags']; ?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                        <a href="delete_product.php?id=<?php echo $row['id']; ?> " title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>
                                        <a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>

                </table>

            </div> <!-- End #tab1 -->

            <div class="tab-content" id="tab2">

                <form action="" method="post" enctype="multipart/form-data">

                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>Id</label>
                            <input class="text-input small-input" type="text" name="id" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Name</label>
                            <input class="text-input small-input" type="text" id="small-input" name="name" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Color</label>
                            <input class="text-input small-input" type="text" id="small-input" name="color" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>

                        <p>
                            <label>Price</label>
                            <input class="text-input medium-input datepicker" type="text" id="medium-input" name="price" />
                            <!--<span class="input-notification error png_bg">Error message</span> -->
                        </p>
                        <p>
                            <label for="file">Images</label>
                            <input type="file" name="file" id="file">
                            <!--<input type="submit" name="file to upload" id="fileToUpload"> -->
                        </p>
                        <label>Category</label>
                        <select name="category" class="small-input">
                            <?php
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        </p>
                        <p>
                            <label>Tags</label>
                            <?php
                            $sql = "SELECT * FROM tags";
                            $result = $conn->query($sql);
                            ?>

                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) { ?>
                                    <input type="checkbox" name="check_list[]" value="<?php echo $row['name']; ?>" /> <?php echo $row['name']; ?>
                            <?php
                                }
                            }
                            $conn->close(); ?>
                            <!--<p>
                            
                            <label>Large form input</label>
                            <input class="text-input large-input" type="text" id="large-input" name="large-input" />
                        </p>n -->

                            <!--<p>
                            <label>Radio buttons</label>
                            <input type="radio" name="radio1" /> This is a radio button<br />
                            <input type="radio" name="radio2" /> This is another radio button
                        </p> -->



                            <p>
                                <label>Description</label>
                                <textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"></textarea>
                            </p>

                            <p>
                                <input class="button" type="submit" value="Submit" name="submit" />
                            </p>

                    </fieldset>

                    <div class="clear"></div><!-- End .clear -->

                </form>

            </div> <!-- End #tab2 -->

        </div> <!-- End .content-box-content -->

    </div> <!-- End .content-box -->


    <div class="clear"></div>


    <!-- Start Notifications -->
    <!--
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div> -->
    <!-- End Notifications -->

    <?php include('footer.php'); ?>