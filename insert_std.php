<?php
$id = $_POST["id"];
$en_name = $_POST["en_name"];
$en_surname = $_POST["en_surname"];
$th_name = $_POST["th_name"];
$th_surname = $_POST["th_surname"];
$major_code = $_POST["major_code"];
$email = $_POST["email"];
//echo $id; echo $en_name; echo $en_surname; echo $th_name; echo $th_surname;
//echo $major_code; echo $email;
$servername = "localhost";
$username = "root";
$password = "1212312121.";
$dbname = "students";
// create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed " . mysqli_connect_error());
  // ...
} else {
  $check_sql = "SELECT * FROM `std_info` WHERE `id` = '$id'";
  $check_result = mysqli_query($conn, $check_sql);
  if (mysqli_num_rows($check_result) > 0) {
    echo "<script>
            alert('ID already exists!');
            window.location.href = 'student.php';
            </script>";
  }
}

$sql = "INSERT INTO `std_info` (`id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email`) VALUES ('$id', '$en_name', '$en_surname', '$th_name', '$th_surname', '$major_code', '$email')";
//echo $sql."<br>";
$result = mysqli_query($conn, $sql);
if ($result) {
  echo "<script>
            alert('New record successfully!');
            window.location.href = 'student.php';
          </script>";
} else {
  echo "<script>
            alert('Error: " . mysqli_error($conn) . "');
            window.location.href = 'student.php';
          </script>";
}
mysqli_close($conn);
