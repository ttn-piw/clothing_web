<?php
    include("php/config.php");
    session_start();

    $_SESSION['total_money'] = 0;
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    if (!isset($_SESSION['cus-cart'])) $_SESSION['cus-cart']=[];

    if(isset($_POST['submit'])) {
       if(isset($_POST['PID'])) {
           $PID = $_POST['PID'];
           $SQL = "SELECT * FROM product WHERE PID ='$PID'";
           $result = $connect->query($SQL);

           if($result->num_rows > 0){
               while ($row_data = $result->fetch_assoc()){
                   $pro_pid = $row_data['PID'];
                   $pro_image = $row_data['PImage'];
                   $pro_name = $row_data['PName'];
                   $pro_price = $row_data['PPrice'];
                   $pro_size = $row_data['PSize'];
                   $pro_remain =$row_data['PRemain'];
                   $pro_quantity = 1;

                   $check = 0;
                   for ($i=0; $i < sizeof($_SESSION['cus-cart']) ; $i++) { 
                        if($_SESSION['cus-cart'][$i][1] == $pro_name){
                            $check = 1;
                            if ($_SESSION['cus-cart'][$i][5] + $pro_quantity < $pro_remain){
                                $new_quantity = $_SESSION['cus-cart'][$i][5] + $pro_quantity;
                                $_SESSION['cus-cart'][$i][5] = $new_quantity;
                            } else 
                                $_SESSION['cus-cart'][$i][5] = $pro_remain;
                            break;
                        }

                   }
                   if ($check == 0){
                    $product=[$pro_image,$pro_name,$pro_price,$pro_size,$pro_remain,$pro_quantity,$pro_pid];
                    $_SESSION['cus-cart'][] = $product;
                   }
               }
           }
       }
   } 
   function deleteProduct($index) {
        if(isset($_SESSION['cus-cart']) && is_array($_SESSION['cus-cart'])) {
            unset($_SESSION['cus-cart'][$index]);
            $_SESSION['cus-cart'] = array_values($_SESSION['cus-cart']);
        }
    }

    if(isset($_POST['del_pro'])){
        deleteProduct($_POST['del_pro']);
    }
    if (isset($_GET['name'])){
        $admin_name = $_GET['name'];
        for ($i=0; $i < sizeof($_SESSION['cus-cart']) ; $i++){
            if (strcmp($_SESSION['cus-cart'][$i][1], $admin_name) == 0){
                deleteProduct($i);
            }
        }
        header("location: admin_page_product.php");
    }
    if(isset($_GET['id'])){
        $ID = $_GET['id'];
        $sql_del = "DELETE FROM product WHERE PID='$ID' ";
        $connect->query($sql_del);
        $connect->close();
        header("location: admin_page_product.php");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart's Page</title>  
        <link rel="stylesheet" href="index/Cart/cart.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
    <header>
            <span id="cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <a href ="cart.php">Giỏ hàng</a>
            </span>
            <span id="logo">ER Space</span>
            <div class="hamburger">
        
                <span id="bar"><i class="fa-solid fa-bars"></i></span>
            </div>
        </header>
        <nav>
         <div class="home_bar" >
            <div id="close_menu">X</div>
          <ul type ="none">
            <span><img src="imagine/logo.png" width="70px"></span> 
            <li><a href="index.php">Home</a></li>
            <li>
                <a href="product_page_men.php">Men</a>
                <ul class="men_menu" type="none">
                    <li id="men_tee"><a href="">T-shirt</a></li>
                    <li><a href="">Somi</a></li>
                    <li><a href="">Vest/Blazer</a></li>
                    <li><a href="">Quần</a></li>
                </ul>
            </li>
            <li>
                <a href="product_page_women.php">Women</a>
                <ul class="women_menu" type="none">
                    <li><a href="">Áo</a></li>
                    <li><a href="">Vest/Blazer</a></li>
                    <li><a href="">Chân váy</a></li>
                    <li><a href="">Quần</a></li>
                </ul>
            </li>
            <li>
                <a href="#">About us</a>
                <span id="about_content">
                    <img src="imagine/logo.png">
                    <p>
                        Chào mừng bạn đến với chúng tôi - nơi hội tụ của những trải nghiệm mua sắm độc đáo và phóng khoáng! 
                        Chúng tôi là địa chỉ tin cậy cho những người yêu thích phong cách vintage, nơi mang đến cho bạn những 
                        sản phẩm độc đáo và đẹp mắt. Tại đây, chúng tôi tự hào giới thiệu những bộ sưu tập đặc sắc, từ những 
                        chiếc áo thời trang, đồ trang sức đến những đồ nội thất độc lạ - tất cả đều đậm chất retro và vintage.
                        <br>
                        <br>
                        Chúng tôi không chỉ là một trang web bán đồ, mà còn là không gian của những câu chuyện, kỷ niệm và 
                        sở thích thú vị. Hãy đồng hành cùng chúng tôi để khám phá và tận hưởng sự độc đáo trong từng sản phẩm. 
                        Với cam kết chất lượng và dịch vụ tận tâm, chúng tôi mong muốn mang lại cho bạn trải nghiệm mua sắm thú vị
                        và đặc biệt - nơi bạn có thể tìm thấy những khoảnh khắc retro trong cuộc sống hiện đại. 
                        Hãy đắm chìm trong không gian vintage của chúng tôi và tạo nên phong cách riêng biệt cho chính mình!
                    </p>
                </span> 
            </li>
            <li id="contact_home"><a href="">Contact</a></li>
            <?php 
                if (isset($_SESSION['valid'])) {
                    echo '<li id=login><a href="customer_info.php">Xin chào ' . $_SESSION['username'] . '!</a></li>';
                    echo "<li><a href='php/logout.php?valid=" . $_SESSION['valid'] . "'>Log out</a></li>";
                } else {
                    echo '<li id="login"><a href="login.php">Login / Sign up</a></li>';
                }
            ?>
          </ul>
        </div>
        </nav>
        
      
        <div class="container">
            <div class="content">
                <div class="content_left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                        <?php
                        if(isset($_POST['action'])) {
                            $action = $_POST['action'];
                            $productIndex = $_POST['product_index'];

                            if($action === 'plus' && $_SESSION['cus-cart'][$productIndex][5] < $_SESSION['cus-cart'][$productIndex][4]) {
                                $_SESSION['cus-cart'][$productIndex][5]++;
                            } elseif($action === 'minus') {
                                if($_SESSION['cus-cart'][$productIndex][5] > 1) {
                                    $_SESSION['cus-cart'][$productIndex][5]--;
                                }
                            }
                        }

                        if(isset($_SESSION['cus-cart']) && is_array($_SESSION['cus-cart'])){
                            for ($i=0; $i < sizeof($_SESSION['cus-cart']); $i++) {
                                echo '
                                <tr>
                                    <td><img src="'.$_SESSION['cus-cart'][$i][0].'"></td>
                                    <td><p>'.$_SESSION['cus-cart'][$i][1].' </p></td>
                                    <td><p>'.$_SESSION['cus-cart'][$i][3].'</p></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="product_index" value="'.$i.'">
                                            <button class="minus_pro" name="action" value="minus">-</button>
                                            <input type="number" name="quantity" class="quantity" value="'.$_SESSION['cus-cart'][$i][5].'" min="0" max="'.$_SESSION['cus-cart'][$i][4].'">
                                            <button class="plus_pro" name="action" value="plus">+</button>
                                        </form>
                                    </td>
                                    <td>
                                        <p class="product_money">
                                            '.  number_format($_SESSION['cus-cart'][$i][2] * $_SESSION['cus-cart'][$i][5], 0).'
                                        </p>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <button id="del_pro" name="del_pro" value="'.$i.'">X</button>
                                            <input type="hidden" name="del_pid" value="'.$_SESSION['cus-cart'][$i][6].'">
                                        </form>
                                    </td>
                                </tr>';
                            }
                           
                        }
                        ?>
                    </table>
                    <button id="back_shop"><a href="product_page_men.php">TIẾP TỤC MUA SẮM</a></button>
                </div>
                <div class="content_right">
                <form action="payment.php" method="post">
                    <div class="total">
                        Tổng tiền
                        <span id="money"><b><?php
                            for ($i=0; $i < sizeof($_SESSION['cus-cart']) ; $i++) { 
                                $_SESSION['total_money'] = $_SESSION['total_money'] + ($_SESSION['cus-cart'][$i][2] * $_SESSION['cus-cart'][$i][5]);
                            }
                                echo number_format($_SESSION['total_money'],0); ?> vnd</b>
                        </span>
                    </div>
                    <div class="note">
                        <h3>Ghi chú</h3>
                        <input type="text" name="cart_note" placeholder="Bạn muốn mô tả rõ hơn về đơn hàng...">
                    </div>
                    <?php
                        $sql_take_info_shipping = " SELECT * FROM users u JOIN customers c ON u.ID = c.UID 
                                                    WHERE Email ='" . $_SESSION["valid"] . "' AND CName != '' ";
                        $rs_info_ship = $connect->query($sql_take_info_shipping);
                        if ($rs_info_ship->num_rows == 0 ){ ?>
                        <div class="shipping_detail">
                            <h2>Thông tin giao hàng</h2>
                        
                            <div class="text_input">
                                <label for="Name"><i class="fa-solid fa-user"></i>
                                    <input type="text" name="cart_name" id="cus_name" placeholder="Họ và tên" required>
                                </label>
                            </div>
                            <div class="text_input">
                                <label for="email"><i class="fa-solid fa-envelope"></i>
                                    <input type="text" name="cart_email" id="email" placeholder="Email" required>
                                </label>
                           </div>
                            <div class="text_input">
                                <label for="address"><i class="fa-solid fa-location-dot"></i>
                                    <input type="text" name="cart_address" id="address" placeholder="Địa chỉ giao hàng:" required>
                                </label>
                            </div>
                        </div>
                        <?php } ?>
                            <a href="payment.php">
                                <button type="submit" name="get_bill" id="get_bill">THANH TOÁN</button>
                            </a>
                </form>  
                </div>
            </div>
        </div>
        <footer id="footer_page">
            <div class="policy">
             <ul type="none">
               <li><a href="">Chính sách đổi trả</a></li>
               <li><a href="">Chính sách giao hàng</a></li>
               <li><a href="">Chính sách bảo mật</a></li>
               <li><a href="">Giới thiệu về chúng tôi</a></li>
               <li><a href="">Liên hệ chúng tôi</a></li>
               <li><a href="">Hướng dẫn mua hàng</a></li>
             </ul>
            </div>
           
           <div class="contact_container">
            <div class="contact">
               <h3>Liên hệ chúng tôi:</h3><br>
               <p><i class="fa-solid fa-phone"></i><b> Phone:</b> (+84) 946 755 961</p>
               <p><i class="fa-solid fa-envelope"></i><b> Email:</b> ttrungnguyen2003@gmail.com</p>
            </div>
            <div class="shop_info">
               <h3>Thông tin cửa hàng:</h3><br>
               <p><i class="fa-solid fa-location-dot"></i></i><b> Địa chỉ:</b> Hẻm 1, Nguyễn Việt Hồng, An Phú, Ninh Kiều, Cần Thơ, Việt Nam.</p>
            </div>
           </div>

           <div id="footer_mail">
               <input type="text" placeholder="Nhập email của bạn:">
               <button>Đăng ký</button>    
           </div>
           <div class="social_contact">
               <span>
                   <i class="fa-brands fa-facebook"></i>
                   <a href="https://www.facebook.com/Enny.Trann/">Trần Trung Nguyễn</a>
               </span>
               <span>
                   <i class="fa-brands fa-square-instagram"></i>
                   <a href="https://www.instagram.com/trngngyen_0612_/">trngngyn_0612</a>
               </span> 
           </div>
       </footer>
        <script src="index/intro_space.js"></script>
        <script src="index/home_bar_index.js"></script>
        <script src="index/best_seller.js"></script>
        <script src="index/new_arrival.js"></script>
    </body>
</html>