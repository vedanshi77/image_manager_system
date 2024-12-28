<?php 
include("connection.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Display</title>
    <link rel="stylesheet" href="image display.css">
</head>

<body>
    <h1>Fetching Data From MySQL Database Using PHP</h1>
    <div class="data">
        <table>
            <thead>
                <th>Serial No</th>
                <th>Name</th>
                <th>Profile</th>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM `user_data`";
                $result = mysqli_query($conn, $query);

                $serial_no = 1; // Initialize serial number
                while ($row_fetch = mysqli_fetch_assoc($result)) {
                    $profile_path = $row_fetch['profile'];
                    echo "<tr>
                        <td>{$serial_no}</td>
                        <td>{$row_fetch['username']}</td>
                        <td>";
                    if (file_exists($profile_path)) {
                        echo "<img src='$profile_path' width='150px' height='150px'>";
                    } else {
                        echo "Image not found";
                    }
                    echo "</td>
                    </tr>";
                    $serial_no++; // Increment serial number
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>