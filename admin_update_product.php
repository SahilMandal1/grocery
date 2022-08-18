<?php 

    @include "config.php";

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)) {
        header('location: login.php');
    }

    if(isset($_POST['update_product'])) {

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $details = $_POST['details'];
        $details = filter_var($details, FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);

        $category = $_POST['category'];
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $pid = $_POST['pid'];
        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "uploaded_img/".$image;
        $old_image = $_POST['old_image'];

        $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, details = ?, price = ? WHERE id = ?");
        $update_product->execute([$name, $category, $details, $price, $pid]);

        $message[] = 'Product updated successfully!';

        if(!empty($image)) {
            if($image_size > 2000000) {
                $message[] = "Image size is too large!";
            } else {
                $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
                $update_image->execute([$image, $pid]); 

                if($update_image) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    unlink('uploaded_img/'.$old_image);
                
                    $message[] = "Image updated successfully!";
                }
            }
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
    
    <?php include 'admin_header.php'; ?>

    <section class="update_product">

        <h1 class="title">update product</h1>
        
        <?php 
        
            $update_id = $_GET['update'];

            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$update_id]);
            $number_of_products = $select_product->rowCount();

            if($number_of_products > 0) {
                while($fetch_products = $select_product->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pid" value="<?= $fetch_products['id'];?>">

            <input type="hidden" name="old_image" value="<?= $fetch_products['image'] ?>">

            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">

            <input type="text" name="name" class="box" placeholder="enter product name" value="<?= $fetch_products['name']; ?>" required>
            
            <input type="number" name="price" class="box" placeholder="enter product price" value="<?= $fetch_products['price']; ?>" min="0" required>

            <select name="category" class="box" required>
                <option selected><?= $fetch_products['category']; ?></option>
                <option value="vegitables">vegitables</option>
                <option value="fruits">fruits</option>
                <option value="meat">meat</option>
                <option value="fish">fish</option>
            </select>

            <textarea name="details" class="box" placeholder="enter product details" rows="10" cols="30" required><?= $fetch_products['details']; ?></textarea>

            <input type="file" name="image" class="box" accept="image/jpeg, image/jpg, image/png" required>

            <div class="flex-btn">
                <input type="submit" name="update_product" value = "update product" class="btn">
                <a href="admin_product.php" class="option-btn">go back</a>
            </div>

        </form>

        <?php 
        
            }
        } else {
            echo '<p class="empty">No product found!</p>';
        }

        ?>

    </section>





















    <script src="js/script.js"></script>

</body>
</html>