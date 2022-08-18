<?php 

    include "config.php";

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header('location: login.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <?php include 'header.php'; ?>

    <section class="p-category">

        <a href="category.php?category=fruits">fruits</a>
        <a href="category.php?category=vegitables">vegitables</a>
        <a href="category.php?category=fish">fish</a>
        <a href="category.php?category=meat">meat</a>

    </section>


    <section class="products">

<h1 class="title">latest products</h1>

<div class="box-container">

    <?php 
    
        $select_products = $conn->prepare("SELECT * FROM `products`");
        $select_products->execute();
        
        if($select_products->rowCount() > 0) {
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <form action="" method="POST" class="box">
        <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
        <a href="view_page.php?pid=<?= $fetch_products['id'];?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
        <div class="name" ><?= $fetch_products['name']; ?></div>
        <div class="details"><?= $fetch_products['details']; ?></div>

        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
        <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
        <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
        <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">

        <input type="number" class="qty" name="p_qty" min="1" value="1">
        <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
    </form>

    <?php 
        }
    } else {
        echo "<p class='empty'>No product added yet!</p>";
    }
    ?>

</div>

</section>





















    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>