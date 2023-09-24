<?php
$servername = "localhost";
$username = "root";
$password = "1212312121.";
$dbname = "students";

if(isset($_POST['id'])) {
    $id = $_POST["id"];
    $en_name = $_POST["en_name"];
    $en_surname = $_POST["en_surname"];
    $th_name = $_POST["th_name"];
    $th_surname = $_POST["th_surname"];
    $major_code = $_POST["major_code"];
    $email = $_POST["email"];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "UPDATE `std_info` SET `en_name`='$en_name', `en_surname`='$en_surname', `th_name`='$th_name', `th_surname`='$th_surname', `major_code`='$major_code', `email`='$email' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "<script>
                alert('Record updated successfully!');
                window.location.href = 'student.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
                window.location.href = 'student.php';
              </script>";
    }
    

    mysqli_close($conn);
} else {
    echo "Invalid data.";
}
