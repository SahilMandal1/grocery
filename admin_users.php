<?php 

    @include "config.php";

    session_start();

    $admin_id = $_SESSION['admin_id'];

    if(!isset($admin_id)) {
        header('location: login.php');
    }

    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_user->execute([$delete_id]);

        header('location:admin_users.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
    
    <?php include 'admin_header.php'; ?>

    <section class="user-accounts">

        <h1 class="title">User Accounts</h1>

        <div class="box-container">

            <?php 

                $select_users = $conn->prepare("SELECT * FROM `users`");
                $select_users->execute();

                if($select_users) {
                    while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {

            ?>

            <div class="box" style="<?php if($fetch_users['id'] == $admin_id) {echo 'display:none';};?>">
                <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt="">
                <p>User Id : <span><?= $fetch_users['id']; ?></span></p>
                <p>Username : <span><?= $fetch_users['name']; ?></span></p>
                <p>Email : <span><?= $fetch_users['email']; ?></span></p>
                <p>User Type : <span style="color : <?php if($fetch_users['user_type'] == 'admin') {echo 'orange';}; ?>"><?= $fetch_users['user_type']; ?></span></p>
                
                <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" class="delete-btn" onclick = "return confirm('delete this user?'); ">delete</a>
            </div>

            <?php
            
                }
            } else {
                echo "<p class='empty'>No users found!</p>";
            }

            ?>

        </div>

    </section>























    <script src="js/script.js"></script>

</body>
</html>