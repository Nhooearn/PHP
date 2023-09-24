<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "1212312121.";
$dbname = "students";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed " . mysqli_connect_error());
}

$sql = "SELECT * FROM `std_info`";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>id</th><th>name</th><th>surname</th><th>ชื่อ</th><th>นามสกุล</th><th>Major</th><th>email</th><th>ลบ/แก้ไข</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["en_name"] . "</td>";
        echo "<td>" . $row["en_surname"] . "</td>";
        echo "<td>" . $row["th_name"] . "</td>";
        echo "<td>" . $row["th_surname"] . "</td>";
        echo "<td>" . $row["major_code"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td><button class='deleteBtn' data-id='" . $row["id"] . "'>Delete</button>";
        echo " <a href='update_std_form.php?id=" . $row["id"] . "'>Update</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

echo "<a href='insert_std_form.html'>Insert new record</a>";

mysqli_close($conn);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.deleteBtn').click(function() {
            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                url: 'delete_std.php',
                data: {
                    id: id
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>