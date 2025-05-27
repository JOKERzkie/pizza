
<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location: login.php');
    exit();
}

// Count total products for the seller
$select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
$select_products->execute([$seller_id]);
$total_products = $select_products->rowCount();

// ✅ Fix: Select total orders where seller_id matches
$select_orders = $conn->prepare("SELECT COUNT(*) FROM orders WHERE seller_id = ?");
$select_orders->execute([$seller_id]);

$total_orders = $select_orders->fetchColumn();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller profile page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
</head>
<body>
    
<div class='main-container'>
    <?php include '../components/admin_header.php'; ?>
    <section class="seller-profile">
        <div class="heading">
            <h1>Profile</h1>
            <img src="../image/separator-img.png">
        </div>
        <div class="details">
            <div class="seller">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                <h3 class="name"><?= $fetch_profile['name']; ?></h3> <br>
                <span>seller</span> <br>
                <a href="update.php" class="btn">Update Profile</a>
            </div>

            <!-- Move flex inside details -->
            <div class="flex">
                <div class="box">
                    <span><?= $total_products; ?></span>
                    <p>Total Products</p>
                    <a href="view_product.php" class="btn">View Products</a>
                </div>
                <div class="box">
                    <span><?= $total_orders; ?></span>
                    <p>Total Orders Placed</p>
                    <a href="admin_order.php" class="btn">View Orders</a>
                </div>
            </div>
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
