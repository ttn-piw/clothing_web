<?php
    include("php/config.php");
    session_start();
   
    if(isset($_GET['id'])){
        $ID = $_GET['id'];
        $sql_del = "DELETE FROM categories WHERE CTG_ID='$ID' ";
        $connect->query($sql_del);
        $connect->close();
        header("location: admin_page_categories.php");
    };

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
                    <th>ID</th>
                    <th>Loại sản phẩm</th>
                    <th>Phân loại</th>
                    <th>Xóa</th>
                </tr>
                <?php
                $sql_list_cate = "  SELECT * FROM collection cl JOIN categories c 
                                ON  cl.COL_ID = c.COL_ID";
                $rs_cate = $connect->query($sql_list_cate);
                if($rs_cate->num_rows > 0)
                    while($row_data_cate = $rs_cate->fetch_assoc()){    
                        
                ?> 
                    <tr>
                        <td><p><?php echo $row_data_cate['CTG_ID']; ?></p></td>
                        <td><p><?php echo $row_data_cate['CTG_Name']; ?></p></td>
                        <td><p><?php echo $row_data_cate['COL_Sex']; ?></p></td>
                        <form action="" method="get">
                            <td name="del_cate_page">
                                <a onclick="return Del_cate('<?php echo $row_data_cate['CTG_Name']; ?>')" href="admin_page_categories.php?id=<?php echo $row_data_cate['CTG_ID']; ?>">Xóa</a>
                            </td>
                        </form>

                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </section>
    <script>
        function Del_cate(name_cate){
            return confirm("Bạn muốn xóa sản phẩm: "+ name_cate + "? ");
        }
    </script>
</body>
</html>