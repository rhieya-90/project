<?php
include('config.php');
$id = $_GET['id'];
$query = "DELETE FROM products WHERE id='$id'";
$data = mysqli_query($conn, $query);
if ($data) {
?>
    <meta http-equiv="Refresh" content="0; URL=http://localhost/template/admin/products.php">
<?php
} else {
    echo "can't delete the data";
} ?>