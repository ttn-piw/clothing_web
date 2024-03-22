<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset ="UTF-8">
        <title>Login/Register's Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="index/Login_register/login_register.css">
    </head>
    <body>
        <div class="container">
            <form action="" method="post" class="sign-in-form">
                <div class="box form-box">
                    <?php
                        require_once("php/config.php");

                        if(isset($_POST['submit'])){
                            $username = mysqli_real_escape_string($connect,$_POST['username']);
                            $password = mysqli_real_escape_string($connect,$_POST['password']);

                            $result_set = mysqli_query($connect,"SELECT * FROM users
                            WHERE Username='$username' AND Password='$password'") or die("Lỗi select");
                            
                            $row_data = mysqli_fetch_assoc($result_set);
                            
                            if(!empty($row_data)){
                                $_SESSION['valid'] = $row_data['Username'];
                                
                            }
                        }
                    ?>
                        <span>
                            <span class="title">Login</span>
                            <span id="logo"><img src="/imagine/logo.png" alt=""></span>
                        </span>
                            <div class="text_input">
                                <label for="username"><i class="fa-solid fa-user"></i>
                                    <input type="text" name="username" placeholder="Username" required>
                                </label>
                            </div>
                            <div class="text_input">
                                <label for="password"><i class="fa-solid fa-lock"></i>
                                    <input type="text" name="password" placeholder="Password" required>
                                </label>
                            </div>
                                <input type="submit" name="submit" class="btn" id="button_signin" value="Đăng nhập">
                            <div id="DKTK">
                                Đăng ký tài khoản ở đây nhé! <a href="register.html">Đăng ký</a>
                            </div>
                </div>
            </form>
        </div>
        <script src="/index/Login_register/login.js"></script>
    </body>
</html>