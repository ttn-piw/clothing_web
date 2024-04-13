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
            <h2>Trang chủ</h2>
            <div class="profit">
                <div class="order">
                    <?php
                        $sql_take_order = "SELECT COUNT(OID) AS c_order FROM orders";
                        $sql_take_profit = "SELECT SUM(O_Money) AS profit FROM orders";
                        $rs_take_order = $connect->query($sql_take_order);
                        $rs_take_profit = $connect->query($sql_take_profit);
                        
                        if($rs_take_order->num_rows > 0){
                            while($row_order = $rs_take_order->fetch_assoc()){
                                $total_order = $row_order['c_order'];
                            }
                        }
                        if($rs_take_profit->num_rows > 0){
                            while($row_profit = $rs_take_profit->fetch_assoc()){
                                $total_profit = $row_profit['profit'];
                            }
                        }
                    ?>
                    <h3>Tổng số đơn hàng</h3>
                    <span><?php echo $total_order; ?></span>
                </div>
                <div class="money">
                    <h3>Doanh thu</h3>
                    <span><?php echo number_format($total_profit,3); ?></span><sub> vnđ</sub>
                </div>
            </div>
            <table>
                <h1>THÔNG TIN CHI TIẾT ĐƠN HÀNG</h1>
                <tr>
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Ghi chú</th>
                    <th>Chi tiết đơn
                        <table>
                            <tr>
                                <th>Ảnh</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </table>
                    </th>
                    <th>Tổng tiền</th>
                </tr>
                <?php 
                    $sql_info_orders = "SELECT * FROM orders";
                    $rs_info_orders = $connect->query($sql_info_orders);
                    if($rs_info_orders->num_rows > 0 ){
                        while($row_info_orders = $rs_info_orders->fetch_assoc()){
                            $oid = $row_info_orders['OID'];
                            $uid = $row_info_orders['ID'];
                            $date = $row_info_orders['O_Date'];
                            $total_money = $row_info_orders['O_Money'];
                            $note = $row_info_orders['O_Note'];
                ?>  
                <tr>
                    <td><?php echo $oid; ?></td>
                    <td><?php 
                            $sql_info_cus = "SELECT * FROM customers WHERE UID = '".$uid."'";
                            $rs_info_cus = $connect->query($sql_info_cus);
                            $row_info_cus =  $rs_info_cus->fetch_assoc();
                            echo $row_info_cus['CName'];
                        ?>
                    </td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $note; ?></td>
                    <td>
                        <?php 
                            $sql_orders_detail = "SELECT * FROM order_detail WHERE oid = '$oid'";
                            $rs_order_detail = $connect->query($sql_orders_detail);
                            if ($rs_order_detail->num_rows > 0 ){
                                while($row_order_detail = $rs_order_detail->fetch_assoc()){
                                    $od_image = $row_order_detail['od_image'];
                                    $od_quantity = $row_order_detail['od_quantity'];
                                    $od_total = $row_order_detail['od_total'];
                                    
                                    echo "  <div class = 'table_order_detail'>
                                                <img src='$od_image' width='100px'>
                                                <span>".$od_quantity."</span>
                                                <span>".$od_total."</span>
                                            </div>";
                                }
                            }
                        ?>
                        <!-- <div class = 'table_order_detail'>
                            <img src='imagine/aothun.jpg' width='100px'>
                            <span>"1"</span>
                            <span>"300"</span>
                        </div> -->
                    </td>
                    <td><?php echo $total_money; ?></td>
                </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </section>
    </form>
</body>
</html>