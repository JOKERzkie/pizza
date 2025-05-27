<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: login.php');
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    // update name
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE `sellers` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $seller_id]);
        $success_msg[] = 'Username updated successfully';
    }

    // update email
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? AND id != ?");
        $select_email->execute([$email, $seller_id]);

        if ($select_email->rowCount() > 0) {
            $warning_msg[] = 'Email already exists';
        } else {
            $update_email = $conn->prepare("UPDATE `sellers` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $seller_id]);
            $success_msg[] = 'Email updated successfully';
        }
    }

    // update image
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id() . '.' . $ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/' . $rename;

        if ($image_size > 2000000) {
            $warning_msg[] = 'Image size is too large';
        } else {
            $update_image = $conn->prepare("UPDATE `sellers` SET `image` = ? WHERE id = ?");
            $update_image->execute([$rename, $seller_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = 'Image uploaded successfully';
        }
    }

    // update password without requiring old password
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if (!empty($new_pass) && !empty($cpass)) {
        if ($new_pass != $cpass) {
            $warning_msg[] = 'Passwords do not match';
        } else {
            $update_pass = $conn->prepare("UPDATE `sellers` SET password = ? WHERE id = ?");
            $update_pass->execute([$cpass, $seller_id]);
            $success_msg[] = 'Password updated successfully';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="form-container">
            <div class="heading">
                <h1>Update Profile</h1>
                <img src="../image/separator-img.png">
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                </div>
                <h3>update profile</h3>
                <div class="flex">
                    <div class="col">
                        <div class="input-field">
                            <p>Your Name <span>*</span></p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="btn">
                        </div>
                        <div class="input-field">
                            <p>Your Email <span>*</span></p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="btn">
                        </div>
                        <div class="input-field">
                            <p>Update Profile Picture <span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="btn">
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="input-field">
                            <p>New Password <span>*</span></p>
                            <input type="password" name="new_pass" placeholder="Enter your new password" class="btn">
                        </div>
                        <div class="input-field">
                            <p>Confirm Password <span>*</span></p>
                            <input type="password" name="cpass" placeholder="Confirm your password" class="btn">
                        </div>
                    </div>
                </div>
                
                <input type="submit" name="submit" value="Update Profile" class="btn">
            </form>
        </section>
    </div>

    <!-- SweetAlert CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom JS -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
