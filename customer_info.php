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
            <div class="box form-box">  

            <?php
                include("php/config.php");

                if(isset($_POST['submit'])){
                    $name = $_POST['cus_name'];
                    $phone= $_POST['cus_phone'];
                    $address = $_POST['cus_address'];
                    
                    $email = $_SESSION['valid'];
                    $sql_check_email = "SELECT * FROM customers c JOIN users u ON c.UID = u.ID
                                         WHERE u.Email = '$email'";
                    $rs_check = $connect ->query($sql_check_email);
                    if ($rs_check->num_rows > 0){
                        while ($row_data = $rs_check->fetch_assoc()){
                            $UID = $row_data['UID'];
                            $sql_update = " UPDATE customers SET CName = '$name', CPhone = '$phone',
                                            CAddress = '$address' WHERE customers.UID = '$UID'";
                            $connect->query($sql_update);
                        }
                    } else {
                        $sql_take_uid = "SELECT * FROM users WHERE Email='$email'";
                        $rs_take_uid = $connect ->query($sql_take_uid);
                        while ($row_data_uid = $rs_take_uid->fetch_assoc()){
                            $u_uid = $row_data_uid['ID'];
                            $sql_insert_new_info = "INSERT INTO customers (CName,CPhone,CAddress,UID)
                                                    VALUES('$name','$phone','$address','$u_uid')";
                            $connect->query($sql_insert_new_info);
                        }
                        
                    }
                    echo "<div class='message'>
                            <p> Cập nhật thành công!</p>
                        </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Về trang chủ</button></a>";
                } else{
            ?> 

                    <form action="" method="post" class="sign-up-form">
                        <?php
                            echo '<h1>Xin chào ' . $_SESSION['username'] . ' !</h1>';
                            echo '<h1>Xin chào ' . $_SESSION['valid'] . ' !</h1>';
                        ?>
                        <h2>Thông tin khách hàng</h2>
                            <div class="text_input">
                                <label for="cus_name"><i class="fa-solid fa-user"></i>
                                    <input type="text" name="cus_name" id="cus_name" placeholder="Họ và tên" required>
                                </label>
                            </div>
                            <div class="text_input">
                                <label for="cus_phone"><i class="fa-solid fa-phone"></i>
                                    <input type="text" name="cus_phone" id="cus_phone" placeholder="Điện thoại" required>
                                </label>
                           </div>
                            <div class="text_input">
                                <label for="cus_address"><i class="fa-solid fa-house"></i>
                                    <input type="text" name="cus_address" id="cus_address" placeholder="Địa chỉ">
                                </label>
                            </div>
                                <input type="submit" class="btn" name="submit" value="Cập nhật thông tin">
                </form>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
