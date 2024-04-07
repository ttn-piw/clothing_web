<?php
    include("php/config.php");
    session_start();
   
    if(isset($_GET['id'])){
        $ID = $_GET['id'];
        $sql_del = "DELETE FROM users WHERE ID='$ID' ";
        $connect->query($sql_del);
        $connect->close();
        header("location: admin_page_account.php");
    };

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account's list</title>
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
                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-content-right">
            <h2>Quản lý tài khoản</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Password</th>
                    <th>Xóa</th>
                </tr>
                <?php
                $sql_list_account = "  SELECT * FROM users ";
               
                $rs = $connect->query($sql_list_account);
                if($rs->num_rows > 0)
                    while($row_data = $rs->fetch_assoc()){    
                        
                ?> 
                    <tr>
                        <?php $id = $row_data['ID']; ?>
                        
                        <td><p><?php echo $row_data['ID']; ?></p></td>
                        <td><p><?php echo $row_data['Username']; ?></p></td>
                        <td><p><?php echo $row_data['Email'] ;?></p></td>
                        <?php 
                            $sql_detail_customer = "SELECT * FROM customers 
                                                    WHERE UID = '$id' ";
                            $rs_cus = $connect->query($sql_detail_customer);
                            if ($rs_cus->num_rows >0)
                                while($row_data_cus = $rs_cus->fetch_assoc()){ ?>
                                    <td><p><?php echo $row_data_cus['CPhone'] ;?></p></td>
                                    <td><p><?php echo $row_data_cus['CAddress'] ;?></p></td>
                               <?php }
                        ?> 
                        
                        <td><p><?php echo $row_data['Password'] ;?></p></td>
                        <form action="" method="get">
                            <td name="del_product_page">
                                <a onclick="return Del_pro('<?php echo $row_data['ID']; ?>')" href="admin_page_account.php?id=<?php echo $row_data['ID']; ?>">Xóa</a>
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
        function Del_pro(name_pro){
            return confirm("Bạn muốn xóa sản phẩm: "+ name_prp + "? ");
        }
    </script>
</body>
</html>