<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];
    } else {
        $seller_id = '';
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['update'])) {
        $product_id = $_POST['id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

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
        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_STRING); 

        // Updating the product details
        $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ?, stock = ?, status = ? WHERE id = ?");
$update_product->execute([$name, $price, $description, $stock, $status, $product_id]);


        $success_msg[] = 'Product updated successfully!';

        // File Upload Handling
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $image = filter_var($image, FILTER_SANITIZE_STRING);
            $old_image = $_POST['old_image'];
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = '../uploaded_files/' . $image;
        
            $select_image = $conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id = ?");
            $select_image->execute([$image, $seller_id]);
        
            if ($image_size > 2000000) {
                $warning_msg[] = 'Image size is too large.';
            } elseif ($select_image->rowCount() > 0) {
                $warning_msg[] = 'Please rename your image.';
            } else {
                $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $product_id]);
                move_uploaded_file($image_tmp_name, $image_folder);
        
                if ($old_image != $image && !empty($old_image)) {
                    unlink('../uploaded_files/' . $old_image);
                }
        
                $success_msg[] = 'Image updated!';
            }
        }
    }    

    // Delete image
    if (isset($_POST['delete_image'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
    
        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$product_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    
        if (!empty($fetch_delete_image['image'])) {
            unlink('../uploaded_files/' . $fetch_delete_image['image']);
        }
    
        $unset_image = $conn->prepare("UPDATE `products` SET image = '' WHERE product_id = ?");
        $unset_image->execute([$product_id]);
    
        $success_msg[] = 'Image deleted successfully.';
    }

    // Delete product
    if (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$product_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if (!empty($fetch_delete_image['image'])) {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$product_id]);
        $success_msg[] = 'Product deleted successfully!';
        header('location:view_product.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    
    <div class="main-container">
    <?php include '../components/admin_header.php'; ?>
    <section class="post-editor">
        <div class="heading">
            <h1>Edit Product</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $product_id = $_GET['id'];
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND seller_id = ?");
                $select_product->execute([$product_id, $seller_id]);
                if ($select_product->rowCount() > 0) {
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
                    <input type="hidden" name="id" value="<?= $fetch_product['id']; ?>">
                    <div class="input-field">
                        <p>Product Status <span>*</span></p>
                        <select name="status" class="box" required>
                            <option value="active" <?= $fetch_product['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="deactive" <?= $fetch_product['status'] === 'deactive' ? 'selected' : '' ?>>Deactive</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <p>Product Name <span>*</span></p>
                        <input type="text" name="name" value="<?= $fetch_product['name']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Product Price<span>*</span></p>
                        <input type="number" name="price" value="<?= $fetch_product['price']; ?>" class="box">
                    </div>
                    <div class="input-field">
                        <p>Product Description<span>*</span></p>
                        <textarea name="description" class="box"><?= $fetch_product['product_detail']; ?></textarea>
                    </div>
                    <div class="flex-btn">
                        <input type="submit" name="update" value="Update Product" class="btn">
                        <input type="submit" name="delete_product" value="Delete Product" class="btn">
                    </div>
                </form>
            </div>
            <?php
                    }
                } else {
                    echo '<div class="empty"><p>No products found!</p></div>';
                }
            ?>
        </div>
    </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>
</body>
</html>
