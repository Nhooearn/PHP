<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('#updateForm').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'update_std.php',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        alert(data.message);
                        if (data.success) {
                            window.location.href = 'student.php'; // กลับไปยังหน้า student.php
                        }
                    }
                });
            });
        });
    </script>



    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1212312121.";
    $dbname = "students";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed " . mysqli_connect_error());
        }

        // ใช้ Prepared Statements เพื่อป้องกัน SQL Injection
        $sql = $conn->prepare("SELECT * FROM `std_info` WHERE `id`=?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <!-- ฟอร์มอัปเดต -->
            <form method="post" action="update_std.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                id: <input type="text" name="id" value="<?php echo $row['id']; ?>"></br>
                name:<input type="text" name="en_name" value="<?php echo $row['en_name']; ?>"></br>
                surname:<input type="text" name="en_surname" value="<?php echo $row['en_surname']; ?>"></br>
                ชื่อ:<input type="text" name="th_name" value="<?php echo $row['th_name']; ?>"></br>
                นามสกุล:<input type="text" name="th_surname" value="<?php echo $row['th_surname']; ?>"></br>
                Major:<input type="text" name="major_code" value="<?php echo $row['major_code']; ?>"></br>
                Email:<input type="text" name="email" value="<?php echo $row['email']; ?>"></br>
                <input type="submit" value="Update">
            </form>
    <?php
        } else {
            echo "No record found.";
        }

        mysqli_close($conn);
    } else {
        echo "Invalid ID.";
    }
    ?>


</body>

</html>