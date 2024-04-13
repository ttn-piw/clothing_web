<?php
    include("php/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin's Page</title>
    <link rel="stylesheet" href="index/admin_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <header>
        <h1>TOP</h1>
        <?php
            $sql_categories = "SELECT * FROM categories";
            $rs_cate = $connect->query($sql_categories);
        ?>
        <?php
            if(isset($_POST['add'])){
                $name = $_POST['pro_name'];

                $image = $_FILES['pro_image']['name'];
                $image_tmp = $_FILES['pro_image']['tmp_name'];

                $price = $_POST['pro_price'];
                $size = $_POST['pro_size'];
                $quantity = $_POST['pro_quantity'];
                $detail = $_POST['pro_detail'];
                $categories  = $_POST['pro_cate'];
                $insert_pro = "  INSERT INTO product(PName,PPrice,PSize,PRemain,PDetail,PImage,CTG_ID)
                                VALUES('$name','$price','$size','$quantity','$detail','imagine/$image','$categories')";
                $connect->query($insert_pro);

                move_uploaded_file($image_tmp, "imagine/$image");
                header("location: admin_page_product.php");
            }
        ?>
    <?php
        if (isset($_SESSION['valid'])) {
            echo '<li id=login><a href="customer_info.php">Xin chào ' . $_SESSION['username'] . '!</a></li>';
            echo "<li><a href='php/logout.php'>Log out</a></li>";
        } else {
            echo '<li id="login"><a href="login.php">Login / Sign up</a></li>';
        }
    ?>
    </header>
    <section class="admin-content">
    <div class="admin-content-left">
            <ul>
                <li><a href="admin_page.php">Trang chủ</a></li>
                <li><a href="">Tài khoản</a>
                    <ul>
                        <li><a href="admin_page_account.php">Danh sách tài khoản</a></li>
                    </ul>
                </li>
                <li><a href="">Loại sản phẩm</a>
                    <ul>
                        <li><a href="admin_page_add_categories.php">Thêm loại sản phẩm</a></li>
                        <li><a href="admin_page_categories.php">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="">Sản phẩm </a>
                    <ul>
                        <li><a href="admin_page_add_product.php">Thêm sản phẩm</a></li>
                        <li><a href="admin_page_product.php">Danh sách sản phẩm</a></li>
                        <li><a href="admin_page_search.php">Tìm kiếm sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-content-right">
            <h2>Thêm sản phẩm</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="text_input">
                    <label for="pro_name">
                        <div class="head">Tên sản phẩm</div>
                        <input type="text" name="pro_name" required>
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_image">
                        <div class="head">Ảnh sản phẩm</div>
                        <input type="file" name="pro_image">
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_price">
                        <div class="head">Giá sản phẩm</div>
                        <input type="number" id="pro_price" name="pro_price" required><sub> vnd</sub>
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_size">
                        <div class="head">Size</div>
                        <select name="pro_size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_quantity">
                        <div class="head">Số lượng sản phẩm</div>
                        <input type="number" id="pro_quantity" name="pro_quantity" required>
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_detail">
                        <div class="head">Mô tả sản phẩm</div>
                        <input type="text" id="pro_detail" name="pro_detail" required>
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_cate">
                        <div class="head">Loại sản phẩm</div>
                        <select name="pro_cate">
                            <?php
                                while($row_cate = $rs_cate->fetch_assoc()) {?>
                                    <option value="<?php echo $row_cate['CTG_ID'] ?>"><?php echo $row_cate['CTG_Name'] ?></option>
                            <?php }?>
                        </select>
                    </label>
                </div>
                <button class="add_pro_page" name="add">Thêm mới</button>
                <button class="add_pro_page">Nhập lại</button>
            </form>
        </div>
    </section>
</body>
</html>