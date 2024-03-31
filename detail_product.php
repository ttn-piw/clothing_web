<?php 
    include("php/config.php");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thông tin sản phẩm</title>
        <link rel="stylesheet" href="index/product_page/detail_product.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <header>
            <span id="cart"><i class="fa-solid fa-cart-shopping"></i></span>
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
                       <li><a href="">T-shirt</a></li>
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
                   <a href="">About us</a>
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
                        echo "<li><a href='php/logout.php'>Log out</a></li>";
                    } else {
                        echo '<li id="login"><a href="login.php">Login / Sign up</a></li>';
                    }
                ?>
             </ul>
           </div>
           </nav>
           
           
            <?php
                $PID = $_GET['PID'];
                if (isset($PID)){
                    $SQL = "SELECT * FROM product WHERE PID='$PID' ";
                    $result = $connect->query($SQL);

                    if($result->num_rows >0 ){
                        $row_data = $result->fetch_assoc();
                        $name = $row_data['PName'];
                        $price = $row_data['PPrice'];
                        $remain = $row_data['PRemain'];
                        $detail = $row_data['PDetail'];
                        $image = $row_data['PImage'];

                    }
                }
                else    
                    echo 'Không có sản phẩm phù hợp!';
            ?>
        <div class="container">
                <div class="content">
                <div class="left_image">
                    <img src="<?php echo $image;  ?>">
                </div>
                <div class="content_right">
                   <h2><?php echo "$name"; ?> </h2>
                   <h2><?php echo number_format("$price", 3); ?> vnd </h2>
                   <p>Trạng thái: 
                        <?php
                            if($remain > 0)
                                echo " Còn hàng";
                            else    
                                echo " Hết hàng";
                        ?>
                   </p>
                    <p>
                        HƯỚNG DẪN CHỌN  SIZE:<br> - Size M: 1m65-1m70, 60kg-65kg 
                        <br>- Size L: 1m70-1m75, 65kg-70kg</p>
                    <p>
                    <?php
                        if ($remain > 0 )
                            echo'Số lượng còn lại: '. $remain;
                    ?>
                    </p>
                    <hr>
                    <?php
                        if ($remain > 0 )
                            echo '<form action="cart.php" method="post">
                                    <input type="hidden" name="PID" value="'.$PID.'">
                                    <button type="submit" name="submit">Thêm vào giỏ hàng</button>
                                  </form>';
                    ?>
                </div>
            </div>
            <div class="des_detail">
                <h3><u>Mô tả sản phẩm</u></h3>
                <p>  
                    <?php
                        echo $detail;
                    ?>
                </p>
                    <div class="size_ins">
                        <h4>HƯỚNG DẪN CHỌN SIZE:</h4> <br>
                        - Size M: 1m65-1m70, 60kg-65kg<br> 
                        <br>
                        - Size L: 1m70-1m75, 65kg-70kg<br> 
                        <br>
                        <h4>QUY ĐỊNH ĐỔI TRẢ:</h4>
                        <br>
                        - Đối với mặt hàng giảm giá, vui lòng không đổi trả. <br>
                        <br>
                        - Đối với hàng mới, shop chỉ nhận đổi các sản phẩm bị lỗi sản xuất còn nguyên tag chưa qua sử dụng trong vòng 3 ngày kể từ ngày nhận được hàng. <br>
                        <br>
                        - Nhận đổi trả size trong vòng 3 ngày kể từ ngày nhận hàng, phí ship đổi size quý khách vui lòng thanh toán 2 chiều.
                    </div>
                </p>
            </div>
            </div>
            <!-- <div class="relate_product">
                <h2>SẢN PHẨM LIÊN QUAN:</h2>
                <div class="relate_product_img">
                    <img src="/imagine/Product_img/Men_img/aothun1.jpg" alt="">
                    <img src="/imagine/Product_img/Men_img/aothun2.jpg" alt="">
                    <img src="/imagine/Product_img/Men_img/aothun3.jpg" alt="">
                </div>
            </div> -->


        <footer>
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
        <script src="/index/product_page/homebar.js"></script>
        <!-- <script src="/index/ScrollIntoView.js"></script> -->
    </body>
</html>