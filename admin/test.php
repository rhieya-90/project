<?php
include('config.php');
$errors = array();
$message = '';
if (isset($_POST['submit'])) {
  echo "hi";
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
  

    if ($id == '') {
        array_push($errors, array('input' => 'id', 'msg' => 'id empty'));
    }
    if ($name == '') {
        array_push($errors, array('input' => 'name', 'msg' => 'name empty'));
    }
    $sql = "SELECT id FROM categories WHERE 
        `id`='" . $id . "'";
    $fire = mysqli_query($conn, $sql) or die("can not fire the query" . mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire) > 0) {
        array_push($errors, array('query' => 'add', 'msg' => "id exists"));
    }
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO categories(`id`, `name`)VALUES
        ('" . $id . "', '" . $name . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}?>


            <div class="tab-content" id="tab2">
            <?php if (sizeof($errors)>0) : ?>
            <ul>
                <?php foreach ($errors as $key => $error) : ?>
                    <li><?php echo $error['msg'];?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

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
                            <input class="button" type="submit" value="Submit" />
                        </p>

                    </fieldset>

                    <div class="clear"></div><!-- End .clear -->

                </form>

            </div> <!-- End #tab2 -->

       