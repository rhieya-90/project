<?php
include('config.php');
$errors = array();
$message='';
if (isset($_POST['update'])) {
    $id=isset($_POST['id'])?$_POST['id']:'';
    $username=isset($_POST['username'])?$_POST['username']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';
    $category=isset($_POST['category'])?$_POST['category']:'';
    $dob=isset($_POST['dob'])?$_POST['dob']:'';
    $address=isset($_POST['address'])?$_POST['address']:'';

    
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

    if (sizeof($errors) == 0) {
        $sql = "UPDATE users SET username='$username',dob='$dob',category='$category',email='$email',address='$address'WHERE id='$id'";

        if ($conn->query($sql) === true) {

            header('Location:users.php');
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    

        $conn->close();
    }

?>



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


    

                <form action="" method="post" enctype="multipart/form-data">

                    <fieldset>
                        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                        <p>
                            <label>Id</label>
                            <input class="text-input small-input"  type="text" name="id" value="<?php echo $_GET['id'] ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>User Name</label>
                            <input class="text-input small-input"  type="text" id="small-input" name="username" value="<?php echo $_GET['username'] ?>"/>
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>DOB</label>
                            <input class="text-input small-input"  type="date" id="small-input" name="dob" value="<?php echo $_GET['dob'] ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Category</label>
                            <input class="text-input small-input"  type="text" id="small-input" name="category" value="<?php echo $_GET['category'] ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>

                        <!--<p>   //if want
                            <label>Password</label>
                            <input class="text-input medium-input datepicker"  type="password" id="medium-input" name="password" />
                            <span class="input-notification error png_bg">Error message</span> 
                        </p> 
                        <p>
                            <label>Re-Password</label>
                            <input class="text-input medium-input datepicker"  type="password" id="medium-input" name="repassword" />
                            <span class="input-notification error png_bg">Error message</span>
                        </p>-->
                        <p>
                            <label>Email</label>
                            <input class="text-input small-input"  type="text" id="small-input" name="email" value="<?php echo $_GET['email'] ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <label>Address</label>
                            <input class="text-input small-input"  type="text" id="small-input" name="address" value="<?php echo $_GET['address'] ?>" />
                            <!--<span class="input-notification success png_bg">Successful message</span>  Classes for input-notification: success, error, information, attention -->
                            <!--<br /><small>A small description of the field</small> -->
                        </p>
                        <p>
                            <input class="button" type="submit" value="Submit" name="submit" />
                        </p>

                    </fieldset>

                    <div class="clear"></div><!-- End .clear -->

                </form>
            