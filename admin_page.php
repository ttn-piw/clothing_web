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
                <li><a href="">Danh mục</a>
                    <ul>
                        <li><a href="">Thêm Danh mục</a></li>
                        <li><a href="">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li><a href="">Loại sản phẩm</a>
                    <ul>
                        <li><a href="">Thêm loại sản phẩm</a></li>
                        <li><a href="">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="">Sản phẩm </a>
                    <ul>
                        <li><a href="">Thêm sản phẩm</a></li>
                        <li><a href="">Danh sách sản phẩm</a></li>
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
                        <td><p><?php echo number_format($row_data['PPrice'],3) ?></p><sub>vnd</sub></td>
                        <td><?php echo $row_data['PRemain'] ?></td>
                        <td><?php echo $row_data['PDetail'] ?></td>
                        <td><?php echo $row_data['CTG_Name'] ?></td>
                        <td><a href="">Sửa</a></td>
                        <td><a href="">Xóa</a></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </section>
</body>
</html>