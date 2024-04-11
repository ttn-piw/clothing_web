<?php
    session_start();
    $valid =  $_GET['valid'];
    include('config.php');
    $sql_take_id = "SELECT ID FROM users WHERE Email = '$valid'";
    $rs_take_id = $connect->query($sql_take_id);
        if ($rs_take_id->num_rows > 0 ){
            while ($row_take_id = $rs_take_id->fetch_assoc()){
                $uid = $row_take_id['ID'];
                $sql_del_all_orders = "DELETE FROM orders WHERE ID = '$uid'";
                $connect->query($sql_del_all_orders);
            }
        }
    
    session_destroy();
    header("Location: ../index.php");
?>