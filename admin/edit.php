<?php
include('config.php');

$errors = array();
$message = '';
if (isset($_POST['update'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';


    if ($id == '') {
        array_push($errors, array('input' => 'id', 'msg' => 'id empty'));
    }
    if ($name == '') {
        array_push($errors, array('input' => 'name', 'msg' => 'name empty'));
    }
    
    if (sizeof($errors) == 0) {
        $sql = "UPDATE categories SET name='$name'WHERE id='$id'";

        if ($conn->query($sql) === true) {

            header('Location:categories.php');
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
} ?>
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

            <h3>Categories box</h3>

            <ul class="content-box-tabs">
                <!-- href must be unique and match the id of target div -->
                <li><a href="#tab2">Add</a></li>
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">


            <div class="tab-content" id="tab2">

                <form action="#" method="post">

                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                        <p>
                            <label>Id</label>
                            <input class="text-input small-input" type="text" name="id" value="<?php echo $_GET['id'];  ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Name</label>
                            <input class="text-input small-input" type="text" id="small-input" name="name" value="<?php echo $_GET['name'];  ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
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