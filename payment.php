<?php
    include("php/config.php");
    session_start();
  
    $email = $_SESSION['valid'];
    $c_name = $_POST['cart_name'];
    $c_address = $_POST['cart_address'];
    $c_note = $_POST['cart_note'];
    //Show info
    $sql = "SELECT * FROM users u JOIN customers c ON u.ID = c.UID WHERE u.Email ='$email'";
    $rs = $connect->query($sql);
    if($rs->num_rows > 0 ){
        while($row = $rs->fetch_assoc()){
            if ($c_name == '' ) {
                $name = $row['CName'];
            } else $name = $c_name;
            $phone = $row['CPhone'];
            if ($c_address == ''){
                $address = $row['CAddress'];
            } else $address = $c_address;
        }
    }
    if (isset($_POST['get_bill'])){
        $date = date("Y-m-d");
        
        if (isset($_POST['cart_note'])){
            $note = $_POST['cart_note'];
        } else $note = '';
        $sql_insert_oder = "SELECT * FROM users WHERE Email= '".$_SESSION['valid']."' ";
        $rs_order = $connect->query($sql_insert_oder);
        $row_order = $rs_order->fetch_assoc();
        
        $SQL1 = "INSERT INTO orders(ID,O_Date,O_Money,O_Note) VALUES('".$row_order['ID']."','$date','".$_SESSION['total_money']."','$note')";
        $connect->query($SQL1);
        $last_id = $connect->insert_id;

        for ($i=0; $i < sizeof($_SESSION['cus-cart']) ; $i++){ 
            $sql_insert_oderdetail = "  INSERT INTO order_detail(od_pid,od_image,od_quantity,od_price,od_total,oid)
                                        VALUES('".$_SESSION['cus-cart'][$i][6]."',
                                                '".$_SESSION['cus-cart'][$i][0]."',
                                                '".$_SESSION['cus-cart'][$i][5]."',
                                                '".$_SESSION['cus-cart'][$i][2]."',
                                                '".$_SESSION['cus-cart'][$i][2] * $_SESSION['cus-cart'][$i][5]."',
                                                '$last_id')";
            $sql_update_remain = "UPDATE product SET PRemain='".$_SESSION['cus-cart'][$i][4] - $_SESSION['cus-cart'][$i][5]."' WHERE product.PID ='".$_SESSION['cus-cart'][$i][6]."' ";
            $connect->query($sql_update_remain);
            $connect->query($sql_insert_oderdetail);
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
                <div class="back_home">
                    <a href="index.php">
                        
                        <button><i class="fa-solid fa-house"></i>Trang chủ</button>
                    </a>
                </div>
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
                    <div class="under_table">
                        <div class="info">
                            <h2>Thông tin giao hàng</h2>
                            <b>Họ và tên: </b><span><?php echo $name; ?></span><br>
                            <b>Email: </b><span><?php echo $_SESSION['valid']; ?></span><br>
                            <b>Số điện thoại: </b><span><?php echo $phone ?></span><br>
                            <b>Địa chỉ nhận hàng: </b><span><?php echo $address ?></span><br>
                            <b>Note:</b><span><?php echo $c_note; ?></span>
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