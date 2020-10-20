<?php
include('config.php');
$errors = array();
   $message='';
if (isset($_POST['submit'])) {
    $id=isset($_POST['id'])?$_POST['id']:'';
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';
    $category=isset($_POST['category'])?$_POST['category']:'';
    $dob=isset($_POST['dob'])?$_POST['dob']:'';
    $address=isset($_POST['address'])?$_POST['address']:'';

    if ($password != $repassword) {
        array_push($errors, array('input'=>'password', 'msg'=>'password does not match'));
    }
    if ($id=='') {
        array_push($errors, array('input'=>'id', 'msg'=>'id empty'));
    }
    if ($username=='') {
        array_push($errors, array('input'=>'username', 'msg'=>'username empty'));
    }
    if ($dob=='') {
        array_push($errors, array('input'=>'dob', 'msg'=>'dob empty'));
    }
    if ($category=='') {
        array_push($errors, array('input'=>'category', 'msg'=>'category empty'));
    }
    if ($address=='') {
        array_push($errors, array('input'=>'address', 'msg'=>'address empty'));
    }
    if ($email=='') {
        array_push($errors, array('input'=>'email', 'msg'=>'email empty'));
    }
    $sql = "SELECT username FROM users WHERE 
        `username`='".$username."'";
    $fire =mysqli_query($conn, $sql) or die("can not fire the query".mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire)>0) {
        array_push($errors, array('query'=>'reg','msg'=>"username exists"));
    }

    
    $sql = "SELECT email FROM users WHERE 
         `email`='".$email."'";
    $fire =mysqli_query($conn, $sql) or die("can not fire the query".mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire)>0) {
        array_push($errors, array('query'=>'reg','msg'=>"email exists"));
    }
    $sql = "SELECT id FROM users WHERE 
         `id`='".$id."'";
    $fire =mysqli_query($conn, $sql) or die("can not fire the query".mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire)>0) {
        array_push($errors, array('query'=>'reg','msg'=>"id exists"));
    }
    if (sizeof($errors)==0) {
        $sql="INSERT INTO users(`id`, `username`, `password`, `email`, `category`, `dob`, `address`)VALUES
        ('".$id."', '".$username."', '".$password."', '".$email."', '".$category."', '".$dob."', '".$address."')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[]=array('input'=>'form','msg'=>$conn->error);
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
                            <th>USERNAME</th>
                            <th>CATEGORY</th>
                            <th>EMAIL</th>
                            <th>DOB</th>
                            <th>ADDRESS</th>
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
                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><input type="checkbox" /></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><a href="#" title="title"><?php echo $row['username']; ?></a></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="edit_user.php?id=<?php echo $row['id']; ?>&username=<?php echo $row['username']; ?>&category=<?php echo $row['category']; ?>&email=<?php echo $row['email']; ?>&dob=<?php echo $row['dob']; ?>&address=<?php echo $row['address']; ?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                        <a href="delete_user.php?id=<?php echo $row['id']; ?> " title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>
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
                            <label>User Name</label>
                            <input class="text-input small-input" type="text" id="small-input" name="username" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>DOB</label>
                            <input class="text-input small-input" type="date" id="small-input" name="dob" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Category</label>
                            <input class="text-input small-input" type="text" id="small-input" name="category" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>

                        <p>
                            <label>Password</label>
                            <input class="text-input medium-input datepicker" type="password" id="medium-input" name="password" />
                            <!--<span class="input-notification error png_bg">Error message</span> -->
                        </p>
                        <p>
                            <label>Re-Password</label>
                            <input class="text-input medium-input datepicker" type="password" id="medium-input" name="repassword" />
                            <!--<span class="input-notification error png_bg">Error message</span> -->
                        </p>
                        <p>
                            <label>Email</label>
                            <input class="text-input small-input" type="text" id="small-input" name="email" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Address</label>
                            <input class="text-input small-input" type="text" id="small-input" name="address" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
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