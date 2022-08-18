<?php 
    
    if(isset($message)) {
        foreach($message as $message) {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
        ';
        }
    }
?>

<header class="header">

    <div class="flex">
        <a href="admin_page.php" class="logo">Groco<span>.</span></a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="shop.php">shop</a>
            <a href="orders.php">orders</a>
            <a href="about.php">about</a>
            <a href="contact.php">contact</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <a href="search_page.php" class="fas fa-search"></a>

            <?php 
                $count_cart_item = $conn->prepare("SELECT * FROM `cart` where user_id = ?");
                $count_cart_item->execute([$user_id]);
                $total_cart_items = $count_cart_item->rowCount();

                $count_wishlist_item = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                $count_wishlist_item->execute([$user_id]);
                $total_wishlist_items = $count_wishlist_item->rowCount();
            ?>

            <a href="cart.php"><i class="fas fa-shopping-cart"></i> <span>(<?= $total_cart_items; ?>)</span></a>

            <a href="wishlist.php"><i class="fas fa-heart"></i> <span>(<?= $total_wishlist_items; ?>)</span> </a>

        </div>

        <div class="profile">

            <?php 
                $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC); 
            ?>

            <img src="uploaded_img/<?= $fetch_profile['image'];?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>

            <a href="user_update_profile.php" class="btn">Update Profile</a>
            <a href="logout.php" class="delete-btn">Logout</a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>
        </div>

    </div>

</header>