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
</head>
<body>
    <header>
        <h1>TOP</h1>
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
            <h2>Danh mục sản phẩm</h2>
            <table>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Size</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                <?php
                $sql_query = "  SELECT * FROM product p JOIN categories c 
                                ON  p.CTG_ID = c.CTG_ID";
                $rs = $connect->query($sql_query);
                if($rs->num_rows > 0)
                    while($row_data = $rs->fetch_assoc()){    
                        
                ?> 
                    <tr>
                        <td><?php echo $row_data['PID']; ?></td>
                        <td><p><?php echo $row_data['PName'] ?></p></td>
                        <td><img src="<?php echo $row_data['PImage'] ?>" alt=""></td>
                        <td><p><?php echo $row_data['PSize'] ?></p></td>
                        <td><p><?php echo number_format($row_data['PPrice'],0) ?></p><sub>vnd</sub></td>
                        <td><?php echo $row_data['PRemain'] ?></td>
                        <td><?php echo $row_data['PDetail'] ?></td>
                        <td><?php echo $row_data['CTG_Name'] ?></td>
                        
                        <form action="" method="get">
                            <td name="edit_product_page">
                                <a href="admin_page_edit_product.php?id=<?php echo $row_data['PID']; ?>&cate_id=<?php echo $row_data['CTG_ID']; ?>">Sửa</a>
                            </td>
                            <form action="" method="get">
                            <td name="del_product_page">
                                <a onclick="return Del_pro('<?php echo $row_data['PName']; ?>')" href="cart.php?name=<?php echo $row_data['PName']; ?>&id=<?php echo $row_data['PID']; ?>">Xóa</a>
                            </td>
                        </form>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </section>
    </form>
        <script>
            function Del_pro(name_pro) {
                return confirm("Hành động xóa sẽ xóa hết tất cả dữ liệu. Bạn xác nhận xóa sản phẩm: " + name_pro + "?");}
        </script>
</body>
</html>