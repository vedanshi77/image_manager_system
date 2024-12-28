<?php
include("connection.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload</title>
    <link rel="stylesheet" href="image upload.css">
</head>

<body>
    <h1>
        How To Upload An Image In Php & My_Sql
    </h1>
    <div class="myform">
        <form method="post" enctype="multipart/form-data">
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-field">
                <label>Select An Image</label>
                <input type="file" name="profile" required>
            </div>
            <div class="submit-btn">
                <button type="submit" name="upload">Upload</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['upload'])) {
        $img_loc = $_FILES['profile']['tmp_name']; 
        $img_name = basename($_FILES['profile']['name']); 
        $uname = mysqli_real_escape_string($conn, $_POST['username']);

        // Validate file extension
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $valid_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($img_ext, $valid_extensions)) {
            echo "<script>alert('Invalid image extension. Only JPG, JPEG, PNG, and WEBP are allowed.');</script>";
            exit();
        }

        // Validate file size
        $img_size = $_FILES['profile']['size'] / (1024 * 1024);
        if ($img_size > 3) {
            echo "<script>alert('Image size is greater than 3MB');</script>";
            exit();
        }

        // Define destination path
        $upload_dir = "image upload/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $img_des = $upload_dir . $uname . "." . $img_ext;

        // Move file and insert into database
        if (move_uploaded_file($img_loc, $img_des)) {
            $query = "INSERT INTO `user_data`(`username`, `profile`) VALUES ('$uname','$img_des')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Upload successful');</script>";
            } else {
                echo "<script>alert('Database insertion failed');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    }
    ?>
</body>

</html>