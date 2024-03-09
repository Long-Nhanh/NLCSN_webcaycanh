<?php 
require('top.php');
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
                            <span class="breadcrumb-item active">Giỏ hàng</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cart-main-area start -->
<div class="cart-main-area ptb--40 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Sản phẩm</th>
                                    <th class="product-name">Tên sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Tổng tiền</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                                <?php
                                
                                $cart_total=0;
                                if(isset($_SESSION['cart'])) {
                                    foreach($_SESSION['cart'] as $key=>$val) {
                                    foreach($val as $key1=>$val1) {
                                    $productArr=get_product($con,'','',$key,'','',$key1);
                                    $pname=$productArr[0]['name'];
                                    $price=$productArr[0]['price'];
                                    $image=$productArr[0]['image'];
                                    $qty=$val1['qty'];
                                    $pid=$productArr[0]['id'];
    
        							$cart_total=$cart_total+($price*$qty);
                                ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="product.php?id=<?php echo $pid?>"><img src="./media/product/<?php echo $image?>"/></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="product.php?id=<?php echo $pid?>"><?php echo $pname?></a>

                                    </td>
                                    <td class="product-price">
                                        <span class="amount"><?php echo formatMoney($price)?> đ</span>
                                    </td>
                                    <td class="product-quantity">
                                        <input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>"/>
                                        <br/><a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','update')">Chỉnh sửa</a>
                                    </td>
                                    <td class="product-subtotal"><?php echo formatMoney($qty*$price)?> đ</td>
                                    <td class="product-remove">
                                        <a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a>
                                    </td>
                                </tr>
                                <?php } } } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH?>">Tiếp tục mua sắm</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="checkout.php">Đặt hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
										
<?php require('footer.php')?>        