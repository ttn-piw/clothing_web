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
            <div class="box form-box">  

            <?php
                include("php/config.php");

                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $check_email = mysqli_query($connect,"SELECT Email FROM users WHERE Email='$email'");
                    if(mysqli_num_rows($check_email) !=0 ){
                        echo    "<div class='message'>
                                    <p> Địa chỉ email đã được sử dụng. Vui lòng nhập địa chỉ khác!</p>
                                </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
                    }
                    else {
                        mysqli_query($connect,"INSERT INTO users (Username,Email,Password)
                                                VALUES('$username','$email','$password') ") or die("Lỗi xảy ra");
                                                
                        echo "<div class='message'>
                            <p> Đăng ký thành công!</p>
                        </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Login now</button></a>";
                    }
                } else{
            ?>

                    <form action="register.php" method="post" class="sign-up-form">
                        <div>
                            <span class="title">Sign up</span>
                            <span id="logo"><img src="/imagine/logo.png" alt=""></span>
                        </div>
                            <div class="text_input">
                                <label for="username"><i class="fa-solid fa-user"></i>
                                    <input type="text" name="username" id="username" placeholder="Username" required>
                                </label>
                            </div>
                            <div class="text_input">
                                <label for="email"><i class="fa-solid fa-envelope"></i>
                                    <input type="text" name="email" id="email" placeholder="Email" required>
                                </label>
                           </div>
                            <div class="text_input">
                                <label for="password"><i class="fa-solid fa-lock"></i>
                                    <input type="password" name="password" id="password" placeholder="Password" required>
                                </label>
                            </div>
                                <input type="submit" class="btn" name="submit" value="Đăng ký">
                            <div id="DKTK">
                                Bạn đã là thành viên ?<a href="login.php">Đăng nhập</a>
                            </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
