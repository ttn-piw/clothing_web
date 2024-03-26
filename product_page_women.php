<?php 
    include("php/config.php");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Women's collection</title>
        <link rel="stylesheet" href="index/product_page/product_women.css">
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

        <div class="container">
            <h1><u>WOMEN'S COLLECTION</u></h1>
            <ul class="menu_product" type="disc">Danh mục
                <i class="fa-solid fa-arrow-down-wide-short" id="menu_button"></i>
                <li id="women_tee" class="submenu">T-shirt</li>
                <li id="women_vest" class="submenu">Vest/Blazer</li>
                <li id="women_dress" class="submenu">Chân váy</li>
                <li id="women_pant" class="submenu">Quần</li>
            </ul>
            <div class="option_arr">
                 <span id="id_option">Sắp xếp:</span>  
                 <select>
                    <option value="0">Sản phẩm nổi bật</option>
                    <option value="1">Giá: Tăng dần</option>
                    <option value="2">Giá: Giảm dần</option>
                 </select>
            </div>
            <div class="content">
                <div class="tee_space">
                    <div class="title_head">ÁO NỮ</div>
                    <div class="grid_container">
                    <?php
                        $sql = "SELECT * FROM product WHERE CTG_ID = 7";
                        $result = $connect->query($sql);
                            // Loop through each product and display them
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="item">
                                    <div class="img">
                                        <a href="detail_product.php?PID=<?php echo $row['PID']; ?>">
                                            <img src="<?php echo $row['PImage']; ?>">
                                        </a>
                                    </div>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="PID" value="<?php echo $row['PID']; ?>">
                                        <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng">
                                    </form>
                                    <div class="item_name"><?php echo $row['PName']; ?></div>
                                    <div class="price"><?php echo number_format($row['PPrice'], 3); ?> VND</div>
                                </div>
                            <?php
                            }
                        } else {
                            echo "No products available";
                        }   
                    ?>
                        <!-- <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/ao1.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Croptop hồng</div>
                            <div class="price">199.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/ao3.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Croptop sơ mi</div>
                            <div class="price">209.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/ao4.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Áo thun đen</div>
                            <div class="price">259.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/ao2.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Croptop tím</div>
                            <div class="price">199.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/ao5.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Sơ mi xanh nữ</div>
                            <div class="price">299.000 VND</div>
                        </div> -->
                    </div>
                </div>
                <hr>
                <!-- SOMI---------------- -->
                <div class="vest_space">
                    <div class="title_head">VEST/BLAZER</div>
                    <div class="grid_container">
                    <?php
                        $sql = "SELECT * FROM product WHERE CTG_ID = 8";
                        $result = $connect->query($sql);
                            // Loop through each product and display them
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="item">
                                    <div class="img">
                                        <a href="detail_product.php?PID=<?php echo $row['PID']; ?>">
                                            <img src="<?php echo $row['PImage']; ?>">
                                        </a>
                                    </div>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="PID" value="<?php echo $row['PID']; ?>">
                                        <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng">
                                    </form>
                                    <div class="item_name"><?php echo $row['PName']; ?></div>
                                    <div class="price"><?php echo number_format($row['PPrice'], 3); ?> VND</div>
                                </div>
                            <?php
                            }
                        } else {
                            echo "No products available";
                        }   
                    ?>
                        <!-- <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/blazer1.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Sơ mi xanh navy nam</div>
                            <div class="price">359.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/blazer2.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Sơ mi nâu</div>
                            <div class="price">359.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/blazer3.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Sơ mi Oxford nam</div>
                            <div class="price">399.000 VND</div>
                        </div>
                    </div> -->
                </div>
                <hr>
                <!-- VEST/BLAZER ----------------------->
                <div class="dress_space">
                    <div class="title_head">CHÂN VÁY</div>
                    <div class="grid_container">
                    <?php
                        $sql = "SELECT * FROM product WHERE CTG_ID = 9";
                        $result = $connect->query($sql);
                            // Loop through each product and display them
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="item">
                                    <div class="img">
                                        <a href="detail_product.php?PID=<?php echo $row['PID']; ?>">
                                            <img src="<?php echo $row['PImage']; ?>">
                                        </a>
                                    </div>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="PID" value="<?php echo $row['PID']; ?>">
                                        <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng">
                                    </form>
                                    <div class="item_name"><?php echo $row['PName']; ?></div>
                                    <div class="price"><?php echo number_format($row['PPrice'], 3); ?> VND</div>
                                </div>
                            <?php
                            }
                        } else {
                            echo "No products available";
                        }   
                    ?>
                        <!-- <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/chanvay.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Chân váy jeans</div>
                            <div class="price">359.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/chanvay2.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Chân váy dạ ngắn</div>
                            <div class="price">200.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/chanvay3.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Chân váy caro</div>
                            <div class="price">259.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/chanvay4.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Chân váy trắng</div>
                            <div class="price">299.000 VND</div>
                        </div> -->
                    </div>
                </div>
                <hr>
                <!-- Quần ------------------->
                <div class="pant_space">
                    <div class="title_head">QUẦN</div>
                    <div class="grid_container">
                    <?php
                        $sql = "SELECT * FROM product WHERE CTG_ID = 10";
                        $result = $connect->query($sql);
                            // Loop through each product and display them
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class="item">
                                    <div class="img">
                                        <a href="detail_product.php?PID=<?php echo $row['PID']; ?>">
                                            <img src="<?php echo $row['PImage']; ?>">
                                        </a>
                                    </div>
                                    <form action="cart.php" method="post">
                                        <input type="hidden" name="PID" value="<?php echo $row['PID']; ?>">
                                        <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng">
                                    </form>
                                    <div class="item_name"><?php echo $row['PName']; ?></div>
                                    <div class="price"><?php echo number_format($row['PPrice'], 3); ?> VND</div>
                                </div>
                            <?php
                            }
                        } else {
                            echo "No products available";
                        }   
                    ?>
                        <!-- <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/quan1.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Quần tây lưng thun</div>
                            <div class="price">409.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/quan2.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Quần Jeans be</div>
                            <div class="price">409.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/quan3.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Quần vải ống suông</div>
                            <div class="price">359.000 VND</div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="/imagine/Product_img/Women_img/quan4.jpg"></div>
                            <div class ="BtnBuy">Thêm vào giỏ hàng</div>
                            <div class="item_name">Quần tây ống đứng đen</div>
                            <div class="price">409.000 VND</div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER    -------------------------------------------------------- -->
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
        <script src="index/product_page/homebar.js"></script>
        <script src="index/product_page/submenu.js"></script>
    </body>
</html>