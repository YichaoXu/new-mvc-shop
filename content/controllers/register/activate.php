<?php
//author: TanHongIT

if (isset($_GET['activation_code']) && isset($_GET['email'])) {
    $activation_code = $_GET['activation_code'];
    $email = $_GET['email'];
    $check_code = oneRaw("SELECT * FROM users WHERE email = '$email' AND activation_code = '$activation_code' ");
    if (empty($check_code)) {
        //activation_code is wrong
        echo "<div class='container'><div class='alert alert-danger'><strong>Oh No!</strong> The activation link is incorrect. Please check again. <br><br>If this is a system error, we hope you can send feedback <a href='index.php?controller=feedback'>here</a></div</div>";
    } else {
        if ($check_code['email_verified_at'] == 'verified') {
            echo "<div class='container'><div class='alert alert-warning'><strong>Oops!</strong> Your account has already been activated. Please <a href='admin.php'>login</a></div></div>";
        } else {
            $activated = updateRecord('users', array('email_verified_at' => 'verified'), array('email' => $email));
            if ($activated) {
                echo "<div class='container'><div class='alert alert-success'><strong>Done!</strong> You have successfully activated your account. You can now log in to the Chi Koi Restaurant website. Please go to <a href='admin.php'>Login</a></div></div>";
            } else {
                echo "<div class='container'><div class='alert alert-danger'><strong>Oh No!</strong> The activation link is incorrect. Please check again. <br><br>If this is a system error, we hope you can send feedback <a href='index.php?controller=feedback'>here</a></div</div>";
            }
        }
    }
} else {
    echo "<div class='container'><div class='alert alert-danger'><strong>Oh No!</strong> The activation link is incorrect. Please check again. <br><br>If this is a system error, we hope you can send feedback <a href='index.php?controller=feedback'>here</a></div</div>";
}

require('content/views/shared/footer.php');
