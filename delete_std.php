<?php
$servername = "localhost";
$username = "root";
$password = "1212312121.";
$dbname = "students";

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "DELETE FROM `std_info` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid ID.";
}
