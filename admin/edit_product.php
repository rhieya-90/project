<?php
include('config.php');
$errors = array();
$message = '';
if (isset($_POST['update'])) {
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
    if (sizeof($errors) == 0) {
        $sql = "UPDATE products SET name='$name', color='$color', price='$price', image='$folder', long_description='$description', category_id='$category', tags='$tag'WHERE id='$id'";

        if ($conn->query($sql) === true) {

            header('Location:products.php');
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
                <li><a href="#tab2">Add</a></li>
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="tab-content" id="tab2">

            <form action="" method="post" enctype="multipart/form-data">

                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Id</label>
                        <input class="text-input small-input" value="<?php echo $_GET['id'] ?>" type="text" name="id" />
                        <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                        <!--<br /><small>A small description of the field</small> -->
                    </p>
                    <p>
                        <label>Name</label>
                        <input class="text-input small-input" value="<?php echo $_GET['name'] ?>" type="text" id="small-input" name="name" />
                        <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                        <!--<br /><small>A small description of the field</small> -->
                    </p>
                    <p>
                        <label>Color</label>
                        <input class="text-input small-input" value="<?php echo $_GET['color'] ?>" type="text" id="small-input" name="color" />
                        <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                        <!--<br /><small>A small description of the field</small> -->
                    </p>

                    <p>
                        <label>Price</label>
                        <input class="text-input medium-input datepicker" value="<?php echo $_GET['price'] ?>" type="text" id="medium-input" name="price" />
                        <!--<span class="input-notification error png_bg">Error message</span> -->
                    </p>
                    <p>
                        <label for="file">Images</label>
                        <input value="<?php echo $_GET['image'] ?>" type="file" name="file" id="file">
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
                            <input class="button" type="submit" value="Update" name="update" />
                        </p>

                </fieldset>

                <div class="clear"></div><!-- End .clear -->

            </form>

        </div> <!-- End #tab2 -->

    </div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->


<div class="clear"></div>

<?php include('footer.php'); ?>