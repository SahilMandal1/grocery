<?php 

    include "config.php";

    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header('location: login.php');
    }

    if(isset($_POST['add_to_wishlist'])) {
        $pid = $_POST['pid'];
        $pid = filter_var($pid, FILTER_SANITIZE_STRING);

        $p_name = $_POST['p_name'];
        $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);

        $p_price = $_POST['p_price'];
        $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);

        $p_name = $_POST['p_name'];
        $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);

        $p_image = $_POST['p_image'];
        $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$p_name, $user_id]);

        if($check_wishlist_numbers->rowCount()) {
            $message[] = "Already added to wishlist!";
        } elseif($check_cart_numbers->rowCount()) {
            $message[] = "Alresdy added to cart!";
        } else {
            $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES (?,?,?,?,?)");
            $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);

            $message[] = "Added to wishlist!";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <?php include 'header.php'; ?>

    <section class="products">

        <h1 class="title">products categories</h1>

        <div class="box-container">

            <?php 
            
                $category_name = $_GET['category'];

                $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
                $select_products->execute([$category_name]);
                
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
            echo "<p class='empty'>No product available!</p>";
        }
        ?>

        </div>

    </section>

























    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>