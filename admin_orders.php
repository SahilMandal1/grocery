<?php 

    @include "config.php";

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)) {
        header('location: login.php');
    }

    if(isset($_POST['order_update'])) {
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];
        $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);

        $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
        $update_orders->execute([$update_payment, $order_id]);

        $message[] = "Payment has been updated!"; 
    }

    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_order->execute([$delete_id]);
        header("location:admin_orders.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
    
    <?php include 'admin_header.php'; ?>


    <section class="placed-orders">

        <h1 class="title">Placed Orders</h1>

        <div class="box-container">

            <?php 
            
                $select_orders = $conn->prepare("SELECT * FROM `orders`");
                $select_orders->execute();

                if($select_orders->rowCount() > 0) {
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
            ?>

            <div class="box">
                <p>User Id : <span><?= $fetch_orders['user_id']; ?></span></p>
                <p>Placed On : <span><?= $fetch_orders['placed_on']; ?></span></p>
                <p>Name : <span><?= $fetch_orders['name']; ?></span></p>
                <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
                <p>Number : <span><?= $fetch_orders['number']; ?></span></p>
                <p>Total Products : <span><?= $fetch_orders['total_products']; ?></span></p>
                <p>Total Price : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
                <p>Payment Method : <span><?= $fetch_orders['method']; ?></span></p>

                <form action="" method="POST">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">

                    <select name="update_payment" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>

                    <div class="flex-btn">
                        <input type="submit" class="option-btn" value="update" name="order_update">
                        <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick = "return confirm('Delete this order?');">delete</a>
                    </div>
                </form>
            </div>


            <?php       
                }
            } else {
                echo '<p class="empty">No orders placed yet!</p>';
            }
            ?>

        </div>

    </section>




















    <script src="js/script.js"></script>

</body>
</html>