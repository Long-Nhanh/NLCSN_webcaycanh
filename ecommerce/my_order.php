<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	    window.location.href='index.php';
	</script>
	<?php
}
?>

<div class="ht__bradcaump__area bg__white">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Trang Chủ</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Cảm ơn bạn đã tin tưởng chúng tôi!</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<!-- cart-main-area -->
<div class="wishlist-area ptb--40 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">ID đơn hàng</th>
                                        <th class="product-name"><span class="nobr">Ngày đặt hàng</span></th>
                                        <th class="product-price"><span class="nobr"> Tên người nhận </span></th>
                                        <th class="product-price"><span class="nobr"> Địa chỉ </span></th>
                                        <th class="product-price"><span class="nobr"> Số điện thoại</span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Phương thức thanh toán </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Trạng thái thanh toán </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Trạng thái đơn hàng </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $uid=$_SESSION['USER_ID'];
                                        $res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status order by `order`.id desc");
                                        while($row=mysqli_fetch_assoc($res)){
                                    ?>
                                    <tr>
                                        <td class="product-add-to-cart">
                                            <a href="my_order_details.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a>
                                            <br/>
                                            <a href="order_pdf.php?id=<?php echo $row['id']?>"> PDF</a>
                                        </td>
                                        <td class="product-name"><?php echo $row['added_on']?></td>
                                        <td class="product-name">
                                            <?php echo $row['orname']?><br/>
                                        </td>
                                        <td class="product-name">
                                            <?php echo $row['address']?><br/>
                                        </td>
                                        <td class="product-name">
                                            <?php echo $row['ormobile']?><br/>
                                        </td>
                                        <td class="product-name"><?php echo $row['payment_type']?></td>
                                        <td class="product-name"><?php echo ucfirst($row['payment_status'])?></td>
                                        <td class="product-name"><?php echo $row['order_status_str']?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        						
<?php require('footer.php')?>        