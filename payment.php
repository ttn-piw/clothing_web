<?php
    include("php/config.php");
    session_start();

    $email = $_SESSION['valid'];
    $sql = "SELECT * FROM users u JOIN customers c ON u.ID = c.UID WHERE u.Email ='$email'";
    $rs = $connect->query($sql);
    if($rs->num_rows > 0 ){
        while($row = $rs->fetch_assoc()){
            $name = $row['CName'];
            $phone = $row['CPhone'];
            $address = $row['CAddress'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trang thanh toán</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="index/Cart/payment.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1>ĐƠN HÀNG</h1>
                <div class="payment">
                    <div class="cart_info">
                        <div class="icon_show">
                            <span>Thông tin đơn hàng</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <table id="cart_table">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                            </tr>
                            <?php
                                //cart_detail
                                if(isset($_SESSION['cus-cart']) && is_array($_SESSION['cus-cart'])){
                                    for ($i=0; $i < sizeof($_SESSION['cus-cart']); $i++) {
                                        echo   '<tr>
                                                    <td><img src="'.$_SESSION['cus-cart'][$i][0].'" width="125px"></td>
                                                    <td>'.$_SESSION['cus-cart'][$i][1].'</td>
                                                    <td>'.$_SESSION['cus-cart'][$i][3].'</td>
                                                    <td>'.$_SESSION['cus-cart'][$i][5].'</td>
                                                </tr>';
                                    }
                                } else {
                                    echo '<tr>
                                            <td colspan="4">Chưa có sản phẩm nào trong giỏ hàng</td>
                                          </tr>';
                                }
                            ?> 
                        </table>
                    </div>
                    <div class="info">
                        <h2>Thông tin giao hàng</h2>
                        <b>Họ và tên: </b><span><?php echo $name; ?></span><br>
                        <b>Email: </b><span><?php echo $_SESSION['valid']; ?></span><br>
                        <b>Số điện thoại: </b><span><?php echo $phone ?></span><br>
                        <b>Địa chỉ nhận hàng: </b><span><?php echo $address ?></span><br>
                        <b>Note:</b><span>ándolajnosldjnoaidjioa</span>
                    </div>
                   
                    <div class="feedback">
                        <input type="text" name="feedback" placeholder="Nhận xét khách hàng">
                    </div>
                    <div class="shipping">
                        <h2>Phương thức vận chuyển</h2>
                        <input id="Btn_shipping" type="radio"><span> Giao hàng tận nơi</span>
                    </div>
                    <div class="pay_type">
                        <h2>Phương thức thanh toán</h2>
                        <input id="Btn_shipping" type="radio"><span> Thanh toán khi nhận hàng</span>
                    </div>
                    <div class="money">
                        <b>Tổng tiền: <?php echo number_format($_SESSION['total_money'],3) ?> vnđ </b>
                    </div>
                </div>      
            </div>
        </div>
    </body>
    <script>
        const show_cart = document.querySelector('.icon_show')
        show_cart.addEventListener('click', () =>{
            var table = document.getElementById("cart_table");
            if (table.style.display === "none") {
                table.style.display = "table";
            } else {
                table.style.display = "none";
            }
        })
    </script>
</html>