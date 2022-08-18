<?php 

    include "config.php";

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)) {
        header('location: login.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
    
    <?php include 'admin_header.php'; ?>

    <section class="dashboard">

        <h1 class="title">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php 
                    $total_pendings = 0;
                    $select_pendings = $conn->prepare("SELECT * FROM orders WHERE payment_status = ?");
                    $select_pendings->execute(['pending']);
                    while($fetch_pending = $select_pendings->fetch(PDO::FETCH_ASSOC))
                    {
                        $total_pendings += $fetch_pending['total_price'];
                    }
                ?>

                <h3>$<?= $total_pendings; ?>/-</h3>
                <p>total pendings</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php 
                    $total_completed = 0;
                    $select_completed = $conn->prepare("SELECT * FROM orders WHERE payment_status = ?");
                    $select_completed->execute(['completed']);
                    while($fetchcompleted = $select_completed->fetch(PDO::FETCH_ASSOC))
                    {
                        $total_completed += $fetchcompleted['total_price'];
                    }
                ?>

                <h3>$<?= $total_completed; ?>/-</h3>
                <p>completed orders</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php 
                    $select_orders = $conn->prepare("SELECT * FROM orders");
                    $select_orders->execute();
                    $number_of_orders = $select_orders->rowCount();
                ?>

                <h3><?= $number_of_orders; ?></h3>
                <p>order placed</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <?php 
                    $select_products = $conn->prepare("SELECT * FROM products");
                    $select_products->execute();
                    $number_of_products = $select_products->rowCount();
                ?>

                <h3><?= $number_of_products; ?></h3>
                <p>products added</p>
                <a href="admin_product.php" class="btn">see products</a>
            </div>

            <div class="box">
                <?php 
                    $select_users = $conn->prepare("SELECT * FROM users WHERE user_type = ?");
                    $select_users->execute(['user']);
                    $number_of_users = $select_users->rowCount();
                ?>

                <h3><?= $number_of_users; ?></h3>
                <p>total users</p>
                <a href="admin_users.php" class="btn">see accounts</a>
            </div>

            <div class="box">
                <?php 
                    $select_admin = $conn->prepare("SELECT * FROM users WHERE user_type = ?");
                    $select_admin->execute(['admin']);
                    $number_of_admin = $select_admin->rowCount();
                ?>

                <h3><?= $number_of_admin; ?></h3>
                <p>total admin</p>
                <a href="admin_users.php" class="btn">see accounts</a>
            </div>

            <div class="box">
                <?php 
                    $select_accounts = $conn->prepare("SELECT * FROM users");
                    $select_accounts->execute();
                    $number_of_accounts = $select_accounts->rowCount();
                ?>

                <h3><?= $number_of_accounts; ?></h3>
                <p>total accounts</p>
                <a href="admin_users.php" class="btn">see accounts</a>
            </div>

            <div class="box">
                <?php 
                    $select_messages = $conn->prepare("SELECT * FROM message");
                    $select_messages->execute();
                    $number_of_messages = $select_messages->rowCount();
                ?>

                <h3><?= $number_of_messages; ?></h3>
                <p>total messages</p>
                <a href="admin_contacts.php" class="btn">total message</a>
            </div>

        </div>

    </section>






















    <script src="js/script.js"></script>

</body>
</html>