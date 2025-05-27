<?php
    include '../components/connect.php';

    if (isset($_POST['submit'])) {

        // Ensure unique ID is generated
        $id = uniqid();

        // Sanitize input fields
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
        $cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);

        // Image Upload
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = uniqid() . '.' . $ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/' . $rename;

        // Check if email exists
        $select_seller = $conn->prepare("SELECT * FROM sellers WHERE email = ?");
        $select_seller->execute([$email]);

        if ($select_seller->rowCount() > 0) {
            $warning_msg[] = 'Email already exists!';
        } else {
            if ($pass !== $cpass) {
                $warning_msg[] = 'Passwords do not match!';
            } else {
                // Hash the password before storing it
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                // Ensure the upload directory exists
                if (!file_exists('../uploaded_files/')) {
                    mkdir('../uploaded_files/', 0777, true);
                }

                // Insert seller into database
                $insert_seller = $conn->prepare("INSERT INTO sellers (name, email, password, image) VALUES (?, ?, ?, ?)");
                $insert_seller->execute([$name, $email, $hashed_pass, $rename]);

                // Move uploaded file
                move_uploaded_file($image_tmp_name, $image_folder);

                $success_msg[] = 'New seller registered! Please login now.';
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    </head>
<body>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>your name <span>*</span></p>
                        <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">
                    </div>

                    <div class="input-field">
                        <p>your email <span>*</span></p>
                        <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
                    </div>
                </div>

                <div class="col">
                    <div class="input-field">
                        <p>your password <span>*</span></p>
                        <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">
                    </div>
                    
                    <div class="input-field">
                        <p>confirm password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="enter your password" maxlength="50" required class="box">
                    </div>
                </div>

                <div class="input-field">
                <p>your profile <span>*</span></p>
                <input type="file" name="image" accept="image/*" required class="box">
            </div>
            <p class="link">already have an account? <a href="login.php">login now</a></p>
            <input type="submit" name="submit" value="register now" class="btn">
            </div>
        </form>
    </div> 


<!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="../js/script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>