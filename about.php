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
    <title>About</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <?php include 'header.php'; ?>

    <section class="about">

    <div class="row">

        <div class="box">
            <img src="images/about-img-1.png" alt="">
            <h3>why choose us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus veniam dolor odio quos porro praesentium recusandae itaque aliquam ratione quas aut pariatur, nulla alias molestiae culpa numquam perferendis quam aliquid?</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="box">
            <img src="images/about-img-2.png" alt="">
            <h3>what we provide?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus veniam dolor odio quos porro praesentium recusandae itaque aliquam ratione quas aut pariatur, nulla alias molestiae culpa numquam perferendis quam aliquid?</p>
            <a href="shop.php" class="btn">our shop</a>
        </div>

    </div>

    </section>

    <section class="reviews">

    <h1 class="title">clients Reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum iure placeat fugiat laboriosam minima minus.</p>

            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum iure placeat fugiat laboriosam minima minus.</p>

            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum iure placeat fugiat laboriosam minima minus.</p>

            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum iure placeat fugiat laboriosam minima minus.</p>

            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>john deo</h3>
        </div>

    </div>
    
    </section>






















    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>
</html>