<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];
    }else{
        $seller_id = '';
        header('Location: login.php');
    }

    // update order from database
    
    if (isset($_POST['update_order'])) {

        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

        $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
        $update_pay->execute([$update_payment, $order_id]);
        $success_msg[] = 'order payment status updated';

    }

    // delete order

    if (isset($_POST['delete_order'])) {

        $delete_id = $_POST['order_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
            $delete_order->execute([$delete_id]);

            $success_msg[] = 'order deleted';
        }else{
            $warning_msg[] = 'order already deleted';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">

</head>
<body>
    
    <div class='main-container'>
    <?php include '../components/admin_header.php'; ?>
    <section class="order-container">
        <div class="heading">
            <h1>total order placed</h1>
            <img src="../image/separator-img.png">
        </div>
            <div class="box-container">
            
    <?php
        $select_orders = $conn->prepare("SELECT * FROM `orders`");
        $select_orders->execute();

        if ($select_orders->rowCount() > 0) {
            while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
    ?>
    
    <div class="box">
        <div class="status" style="color: <?= ($fetch_order['status'] == 'in progress') ? 'limegreen' : 'red'; ?>;">
            <?= $fetch_order['status']; ?>
        </div>
        <div class="details">
            <p>user name : <span><?= htmlspecialchars($fetch_order['name']); ?></span></p>
            <p>user id : <span><?= htmlspecialchars($fetch_order['user_id']); ?></span></p>
            <p>placed on : <span><?= htmlspecialchars($fetch_order['date']); ?></span></p>
            <p>user number : <span><?= htmlspecialchars($fetch_order['number']); ?></span></p>
            <p>user email : <span><?= htmlspecialchars($fetch_order['email']); ?></span></p>
            <p>total price : <span><?= htmlspecialchars($fetch_order['price']); ?></span></p>
            <p>payment method : <span><?= htmlspecialchars($fetch_order['method']); ?></span></p>
            <p>user address : <span><?= htmlspecialchars($fetch_order['address']); ?></span></p>
        </div>
        <form action="" method="post">
            <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">
            <select name="update_payment" class="box" style="width: 90%;">
                <option disabled selected><?= $fetch_order['payment_status']; ?></option>
                <option value="pending">pending</option>
                <option value="order delivered">order delivered</option>
            </select>
            <div class="flex-btn">
                <input type="submit" name="update_order" value="update payment" class="btn">
                <input type="submit" name="delete_order" value="delete order" class="btn" onclick="return confirm('delete this order')">
            </div>
        </form>
    </div>
    <?php
                }
            }else{
                echo '
                    <div class="empty">
                    <p>no order placed yet!</p>
                </div>
                ';
            }
        ?>
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