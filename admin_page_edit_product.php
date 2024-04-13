<?php
    include("php/config.php");
        if(isset($_GET['id'])){
            $ID = $_GET['id'];
            $cate_id_ = $_GET['cate_id'];
            $sql_edit = "SELECT * FROM product WHERE PID='$ID'";
            $sql_take_cate = "  SELECT * FROM  categories WHERE CTG_ID !='$cate_id_'";
            $rs = $connect->query($sql_edit);
            $rs_cate = $connect->query($sql_take_cate);

            if($rs->num_rows >0){
                while($row_data = $rs->fetch_assoc()){
                    $name = $row_data['PName'];
                    $image = $row_data['PImage'];
                    $price = $row_data['PPrice'];
                    $remain = $row_data['PRemain'];
                    $detail = $row_data['PDetail'];
                    $ctg_id = $row_data['CTG_ID'];
                }
            }
        } 

        if(isset($_POST['edit'])){
            $p_name =  $_POST['pro_name'];
            $p_price = $_POST['pro_price'];
            $p_size = $_POST['pro_size'];
            $p_quantity = $_POST['pro_quantity'];
            $p_detail = $_POST['pro_detail'];
            $p_cate = $_POST['pro_cate'];
            
            if ($_FILES['pro_image']['name'] == ''){
                $p_image = $image;
                $sql_update = " UPDATE product SET PName='$p_name' ,PImage='$p_image',PPrice='$p_price',
                                PSize='$p_size',PDetail='$p_detail',PRemain='$p_quantity',CTG_ID='$p_cate'
                                WHERE PID ='$ID' ";
                move_uploaded_file($p_temp_image, $p_image);
            } else {
                $p_image = $_FILES['pro_image']['name'];
                $p_temp_image = $_FILES['pro_image']['tmp_name'];
                $sql_update = " UPDATE product SET PName='$p_name' ,PImage='imagine/$p_image',PPrice='$p_price',
                            PSize='$p_size',PDetail='$p_detail',PRemain='$p_quantity',CTG_ID='$p_cate'
                            WHERE PID ='$ID' ";
                move_uploaded_file($p_temp_image, "imagine/$p_image");
            }
            $connect->query($sql_update);

            header("location: admin_page_product.php");
            
        } 
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index/admin_page.css">
</head>
<body>
    <header>
        <h1>TOP</h1>  
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
            <h2>Sửa sản phẩm</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="text_input">
                    <label for="pro_name">
                        <div class="head">Tên sản phẩm</div>
                        <input type="text" name="pro_name" value="<?php echo $name?>">
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_image">
                        <div class="head">Ảnh sản phẩm</div>
                        <img src="<?php echo $image; ?>" alt="">
                        <input type="file" name="pro_image">
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_price">
                        <div class="head">Giá sản phẩm</div>
                        <input type="number" id="pro_price" name="pro_price"  value="<?php echo $price?>"><sub> vnd</sub>
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
                        <input type="number" id="pro_quantity" name="pro_quantity"  value="<?php echo $remain?>">
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_detail">
                        <div class="head">Mô tả sản phẩm</div>
                        <input type="text" id="pro_detail" name="pro_detail"  value="<?php echo $detail?>">
                    </label>
                </div>
                <div class="text_input">
                    <label for="pro_cate">
                        <div class="head">Loại sản phẩm</div>
                        <select name="pro_cate">
                            <option value="<?php echo $ctg_id ;?>"><?php 
                                $sql_take_first_cate = "SELECT CTG_Name FROM categories WHERE CTG_ID='$ctg_id'" ;
                                $rs_first_cate = $connect->query($sql_take_first_cate);
                                
                                $first_cate =  $rs_first_cate->fetch_assoc(); 
                                echo $first_cate['CTG_Name'];  
                              
                                $connect->close();
                              ?>
                            </option>
                            <?php
                                if( $rs_cate->num_rows > 0) {
                                    while($row_data_cate =  $rs_cate->fetch_assoc()){ ?> 
                                        <option value="<?php echo $row_data_cate['CTG_ID']; ?>"><?php echo $row_data_cate['CTG_Name']; ?></option>
                                    <?php }
                                }  
                            ?>
                        </select>
                    </label>
                </div>
                <button class="edit_pro_page" name="edit">Sửa</button>
            </form>
        </div>
    </section>
</body>
</html>