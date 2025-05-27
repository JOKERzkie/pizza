<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['submit'])) {

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
    
        // update name
        if (!empty($name)) {
            $update_user = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
            $update_user->execute([$user, $user_id]);
            $success_msg[] = 'Username updated successfully';
        }
    
        // update email
        if (!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND id != ?");
            $select_email->execute([$email, $user_id]);
    
            if ($select_email->rowCount() > 0) {
                $warning_msg[] = 'Email already exists';
            } else {
                $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
                $update_email->execute([$email, $user_id]);
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
            $image_folder = 'uploaded_files/' . $rename;
    
            if ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large';
            } else {
                $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
                $update_image->execute([$rename, $user_id]);
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
                $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
                $update_pass->execute([$cpass, $user_id]);
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
    <title>login page</title>
    <link rel="stylesheet" type="text/css" href="css/user_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>login</h1>
            <p>so mao diay ni atong about us huh...aron dli ta mawala huhuhu</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>login</span>
        </div>
    </div>

    <section class="form-container">
            <div class="heading">
                <h1>Update Profile</h1>
                <img src="image/separator-img.png">
            </div>

            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
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

<?php include 'components/footer.php'; ?>
<!-- sweetAlert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js link -->
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>