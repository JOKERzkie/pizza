<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('Location: login.php');
    exit();
}

// Initialize $image to prevent undefined variable error
$image = '';

// Add product in database
if (isset($_POST['publish']) || isset($_POST['draft'])) {

    $id = unique_id();

    // Improved Product Name Validation
    $name = isset($_POST['name']) && strlen(trim($_POST['name'])) > 0
        ? filter_var($_POST['name'], FILTER_SANITIZE_STRING)
        : null;

    if (is_null($name)) {
        $warning_msg[] = 'Product name cannot be empty.';
    }

    $price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_STRING);

    // Status for "Publish" or "Draft"
    $status = isset($_POST['publish']) ? 'active' : 'deactive';

    // File Upload Handling
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);

        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../upload_files/' . $image;

        // File type validation
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);

        if (!in_array(strtolower($image_extension), $allowed_extensions)) {
            $warning_msg[] = 'Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.';
        } elseif ($image_size > 2000000) { // Limit size to 2MB
            $warning_msg[] = 'Image size is too large (max 2MB).';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }

    // Proceed only if product name is valid
    if (!is_null($name)) {
        try {
            // Check for duplicate images
            $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
            $select_image->execute([$image, $seller_id]);

            if ($select_image->rowCount() > 0 && $image != '') {
                $warning_msg[] = 'Please rename your image.';
            } else {
                // Insert product logic
                $insert_product = $conn->prepare("INSERT INTO `products` 
                                                (id, seller_id, name, price, image, stock, product_detail, status) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_product->execute([$id, $seller_id, $name, $price, $image, $stock, $description, $status]);

                if ($status === 'active') {
                    $success_msg[] = 'Product inserted successfully!';
                } else {
                    $success_msg[] = 'Product saved as draft successfully!';
                }
            }
        } catch (PDOException $e) {
            $warning_msg[] = 'Error inserting product: ' . $e->getMessage();
        }
    }
}
?>




    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add product</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">

</head>
<body>
    
    <div class='main-container'>
    <?php include '../components/admin_header.php'; ?>
    <section class="post-editor">
        <div class="heading">
            <h1>add product</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                    <p>product name <span>*</span> </p>
                    <input type="text" name="name" maxlength="100" placeholder="add product name" required class="box" autocomplete="off">
                    </div>

                <div class="input-field">
                    <p>product price <span>*</span> </p>
                    <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box">
                </div>

                <div class="input-field">
                    <p>product detail <span>*</span> </p>
                    <textarea name="description" required maxlength="1000" placeholder="add product detail" class="box"></textarea>
                </div>

                <div class="input-field">
                    <p>product stock <span>*</span> </p>
                    <input type="number" name="stock" maxlength="10" min="0" max="99999999" placeholder="add product stock" required class="box">
                </div>

                <div class="input-field">
                    <p>product image <span>*</span> </p>
                    <input type="file" name="image" accept="image/*" required class="box">
                </div>
                
                <div class="flex-btn">
                    <input type="submit" name="publish" value="add product" class="btn">
                    <input type="submit" name="draft" value="save as draft" class="btn">
                </div>


            </form>
        </div>
    </section>
    </div>
    
    
    


    <!-- sweetAlert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>