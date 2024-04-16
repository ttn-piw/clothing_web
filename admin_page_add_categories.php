<?php
    include("php/config.php");
    session_start();
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
            $sql_collection = "SELECT * FROM collection";
            $rs_cate = $connect->query($sql_categories);
            $rs_col = $connect->query($sql_collection);
        ?>
        <?php
            if(isset($_POST['add'])){
                $col_name = $_POST['col_name'];
                $ctg_name = $_POST['ctg_name'];

                $sql_add_cate = "   INSERT INTO categories(COL_ID,CTG_Name)
                                    VALUES ('$col_name','$ctg_name')";
                $connect->query($sql_add_cate);
                $connect->close();
                header("location: admin_page_categories.php");
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
            <h2>Thêm loại sản phẩm</h2>
            <form action="" method="post">
                <div class="text_input">
                    <label for="col_name">
                        <div class="head">Bộ sưu tập</div>
                        <select name="col_name">
                            <?php
                                while($row_col = $rs_col->fetch_assoc()) {?>
                                    <option value="<?php echo $row_col['COL_ID'] ?>"><?php echo $row_col['COL_Sex'] ?></option>
                            <?php }?>
                        </select>
                    </label>
                </div>
                <div class="text_input">
                    <label for="ctg_name">
                        <div class="head">Tên loại sản phẩm mới</div>
                        <input type="text" name="ctg_name" required>
                    </label>
                </div>
                <button class="add_pro_page" name="add">Thêm mới</button>
                <button class="add_pro_page">Nhập lại</button>
            </form>
        </div>
    </section>
</body>
</html>