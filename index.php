<?php
    include("php/config.php");
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home's Page</title>  
        <link rel="stylesheet" href="index/index.css"> 
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

        <div class="intro_space">
         <div id="title_intro">
            <b>Space for intro</b><br>
         </div>
         <div class="slide_show">
            <div class="item">
                <img src="imagine/Intro1.png" alt="Picture_intro1">
            </div>
            <div class="item">
                <img src="imagine/Beige Brown Minimalist Casual Style Banner Landscape.png" alt="Picture_intro1">
            </div>
            <div class="item">
                <img src="imagine/Summer_collection.png" alt="Picture_intro1">
            </div>
            <div class="item">
                <img src="imagine/Intro3.png " alt="Picture_intro1">
            </div>
         </div> 

           <!-- Button prev & next -->
         <div class="buttons">
            <button id="btnPrev"><i class="fa-solid fa-angle-left"></i></button>
            <button id="btnNext"><i class="fa-solid fa-angle-right"></i></button>
         </div>
         <!-- Dots -->
         <ul class="dots" ; style="list-style-type:disc;">
            <li class="animation"></li>
            <li></li>
            <li></li>
            <li></li>
         </ul>
        </div>
       
        <div class="new_arrival_block">
            <div id="title_na"><a href="">NEW ARRIVAL</a></div>
               <ul class="list_product" >
               <?php
                $sql = "SELECT * FROM product p JOIN categories c ON p.CTG_ID = c.CTG_ID 
                        WHERE c.CTG_Name='New Arrival'";
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
                        <?php if ($row['PRemain'] > 0 ){ 
                                    echo '<form action="cart.php" method="post">
                                        <input type="hidden" name="PID" value="'. $row['PID'].'">
                                        <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng"> 
                                        </form>';   
                                } else {
                                    echo '<div class="BtnBuy">Hết hàng</div>';
                                } ?>
                            <div class="item_name"><?php echo $row['PName']; ?></div>
                            <div class="price"><?php echo number_format($row['PPrice'],3); ?> VND</div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No products available";
                }
                ?>

            </ul>
            <i id="na_left" class="fa-solid fa-angle-left"></i>
            <i id="na_right" class="fa-solid fa-angle-right"></i>
        </div>   
         <!-- COLLECTION----------------->
         <div id="collection_block">
            <div id="title_collection"><a href="">COLLECTION</a></div>
            <div class="content_collection">
             <div class="men_collection">
               <a href="product_page_men.php">
                <img src="imagine\men_clothing.png" width="700px">
               </a>
               <span class="text_collection_men">MEN COLLECTION</span>
             </div>
             <div class="women_collection">
               <a href ="product_page_women.php">
                   <img src ="imagine\women_clothing.png" width="700px">
               </a>
               <span class="text_collection_women">WOMEN COLLECTION</span>
             </div>
            </div>
           </div>     
        <!-- BEST SELLER --------------------------------------------------------------------------->
        <div class="container_block">
         <div id="title_bs"><a href="">BEST SELLER</a></div>
            <ul class="list_product" >
                <?php
                    $sql = "SELECT * FROM product p JOIN categories c ON p.CTG_ID = c.CTG_ID 
                            WHERE c.CTG_Name='Best Seller'";
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
                                <?php if ($row['PRemain'] > 0 ){ 
                                        echo '<form action="cart.php" method="post">
                                                <input type="hidden" name="PID" value="'. $row['PID'].'">
                                                <input type="submit" class="BtnBuy" name="submit" value="Đặt hàng"> 
                                            </form>';
                                        } else {
                                            echo '<div class="BtnBuy">Hết hàng</div>';
                                        } ?>
                                <div class="item_name"><?php echo $row['PName']; ?></div>
                                <div class="price"><?php echo number_format($row['PPrice'],3); ?> VND</div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No products available";
                    }
                    ?>
         </ul>
         <i id="bs_left" class="fa-solid fa-angle-left"></i>
         <i id="bs_right" class="fa-solid fa-angle-right"></i>
        </div>
        <!-- TIN THOI TRANG     ----------------------------------------------------------->
        <div class="news_container">
            <div class="title_news">TIN TỨC THỜI TRANG</div>
            <ul class="content_news" type="none">
                <li>
                    <a href="https://www.realmenrealstyle.com/dress-for-body-type/"><img src="imagine/body_shape_news.jpg" alt="">
                    </a>
                    <h3><a href="https://www.realmenrealstyle.com/dress-for-body-type/">TÌM HIỂU "HÌNH KHỐI" CƠ THỂ CỦA CHÚNG TA?</a></h3>
                </li>
                <li>
                    <a href="https://cardina.vn/blogs/kien-thuc-thoi-trang/phong-cach-thoi-trang-nam"><img src="imagine/style.jpg" alt=""></a>
                    <h3><a href="https://www.realmenrealstyle.com/dress-for-body-type/">THỜI TRANG NAM "HOT" TRONG NĂM 2024 CHO NAM GIỚI?</a></h3>
                </li>
                <li>
                    <a href="https://cardina.vn/blogs/kien-thuc-thoi-trang/cac-phong-cach-thoi-trang"><img src="imagine/style_women_news.png" alt=""></a>
                    <h3><a href="https://cardina.vn/blogs/kien-thuc-thoi-trang/cac-phong-cach-thoi-trang">PHONG CÁCH THỜI TRANG CHO QUÝ CÔ</a></h3>
                </li>
            </ul>
        </div>
        <!-- FOOTER    -------------------------------------------------------- -->
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
    <?php
        $connect->close();
    ?>
</html>