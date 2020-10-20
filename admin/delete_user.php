<?php
include('config.php');
$id = $_GET['id'];
$query = "DELETE FROM users WHERE id='$id'";
$data = mysqli_query($conn, $query);
if ($data) {
?>
    <meta http-equiv="Refresh" content="0; URL=http://localhost/template/admin/users.php">
<?php
} else {
    echo "can't delete the data";
} ?>