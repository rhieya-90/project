<?php
include('config.php');
$errors = array();
$tags = array();
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
    if (isset($_POST['check_list'])) {
        $tag=implode(",", $_POST['check_list']);
        echo $tag;
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
    if ($tags == '') {
        array_push($errors, array('input' => 'tags', 'msg' => 'tags empty'));
    }
    if ($description == '') {
        array_push($errors, array('input' => 'description', 'msg' => 'description empty'));
    }
    if ($color == '') {
        array_push($errors, array('input' => 'color', 'msg' => 'color empty'));
    }
    $sql = "SELECT name FROM products WHERE 
        `id`='" . $id . "'";
    $fire = mysqli_query($conn, $sql) or die("can not fire the query" . mysqli_query($conn, $sql));
    if (mysqli_num_rows($fire) > 0) {
        array_push($errors, array('query' => 'add', 'msg' => "id exists"));
    }
    if (sizeof($errors) == 0) {
        $sql = "INSERT INTO products(`id`, `name`, `price`, `image`, `long_description`, `category_id`, `color`, `tags`)VALUES
        ('" . $id . "', '" . $name . "', '" . $price . "', '" . $folder . "', '" . $description . "', '" . $category . "', '" . $color . "', '" . $tags . "')";

        if ($conn->query($sql) === true) {
            //echo "New record created successfully";
        } else {
            $errors[] = array('input' => 'form', 'msg' => $conn->error);
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
