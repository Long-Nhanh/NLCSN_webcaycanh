<?php 
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0) {
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}

$cart_total=0;
$errMsg="";

$address='';
$orname='';
$ormobile='';



if(isset($_POST['submit'])) {
	$orname=get_safe_value($con,$_POST['orname']);
	$address=get_safe_value($con,$_POST['address']);
	$ormobile=get_safe_value($con,$_POST['ormobile']);

	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_id=$_SESSION['USER_ID'];
	
	foreach($_SESSION['cart'] as $key=>$val) {
		foreach($val as $key1=>$val1)	{
			$resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.* from product_attributes where product_attributes.id='$key1'"));						
			$productArr=get_product($con,'','',$key,'','','','',$key1);
			$price=$productArr[0]['price'];
			$qty=$val1['qty'];
			$cart_total=$cart_total+($price*$qty);
		}
	}

	$total_price=$cart_total;
	$payment_status='pending';
	if($payment_type=='cod') {
		$payment_status='success';
	}
	$order_status='1';
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$added_on=date('Y-m-d h:i:s');
	
	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	
	
	mysqli_query($con,"insert into `order`(user_id,orname,address,ormobile,payment_type,payment_status,order_status,added_on,total_price,txnid) values('$user_id','$orname','$ormobile','$address','$payment_type','$payment_status','$order_status','$added_on','$total_price','$txnid')");
	
	$order_id=mysqli_insert_id($con);
	foreach($_SESSION['cart'] as $key=>$val) {
		foreach($val as $key1=>$val1)	{
			$resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.* from product_attributes where product_attributes.id='$key1'"));						
			$productArr=get_product($con,'','',$key,'','','','',$key1);
			$price=$productArr[0]['price'];
			$qty=$val1['qty'];
			mysqli_query($con,"insert into `order_detail`(order_id,product_id,product_attr_id,qty,price) values('$order_id','$key','$key1','$qty','$price')");
		}
	}
	
	sentInvoice($con,$order_id);
	
	?>
	<script>
		window.location.href='thank_you.php';
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
							<a class="breadcrumb-item" href="index.php">Trang chủ</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active">Đặt Hàng</span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- cart-main-area -->
<div class="checkout-wrap ptb--40">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php echo $errMsg?>
				<div class="checkout__inner">
					<div class="accordion-list">
						<div class="accordion">
							<?php 
								$accordion_class='accordion__title';
								if(!isset($_SESSION['USER_LOGIN'])) {
									$accordion_class='accordion__hide';
							?>
							<div class="accordion__title">Checkout Method</div>
							<div class="accordion__body">
								<div class="accordion__body__form">
									<div class="row">
										<div class="col-md-6">
											<div class="checkout-method__login">
												<form id="login-form" method="post">
													<h5 class="checkout-method__title">Đăng Nhập</h5>
													<div class="single-input">
														<input type="text" name="login_email" id="login_email" placeholder="Email*" style="width:100%">
														<span class="field_error" id="login_email_error"></span>
													</div>
													
													<div class="single-input">
														<input type="password" name="login_password" id="login_password" placeholder="Mật khẩu*" style="width:100%">
														<span class="field_error" id="login_password_error"></span>
													</div>
													
													<a href="forgot_password.php" class="forgot_password">Quên mật khẩu?</a>
													<div class="dark-btn">
														<button type="button" class="fv-btn" onclick="user_login()">Đăng Nhập</button>
													</div>
													<div class="form-output login_msg">
														<p class="form-messege field_error"></p>
													</div>
												</form>
											</div>
										</div>
										<div class="col-md-6">
											<div class="checkout-method__login">
												<form action="#">
													<h5 class="checkout-method__title">Đăng ký</h5>
													<div class="single-input">
														<input type="text" name="name" id="name" placeholder="Tên*" style="width:100%">
														<span class="field_error" id="name_error"></span>
													</div>
													<div class="single-input">
														<input type="text" name="email" id="email" placeholder="Email*" style="width:100%">
														<span class="field_error" id="email_error"></span>
													</div>
													<div class="single-input">
														<input type="password" name="password" id="password" placeholder="Mật khẩu*" style="width:100%">
														<span class="field_error" id="password_error"></span>
													</div>
													<div class="dark-btn">
														<button type="button" class="fv-btn" onclick="user_register()">Đăng ký</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } //else {
								//$lastOrderDetailsRes=mysqli_query($con,"select address from `order` where user_id='".$_SESSION['USER_ID']."'");
								//if(mysqli_num_rows($lastOrderDetailsRes)>0) {
								//	$lastOrderDetailsRow=mysqli_fetch_assoc($lastOrderDetailsRes);
								//	$address=$lastOrderDetailsRow['address'];
									
							
							?>
							<div class="<?php echo $accordion_class?>">
								Thông tin giao hàng
							</div>
							<form method="post">
									<div class="bilinfo">
										<div class="row">
											<div class="col-md-12">
												<div class="single-input">
													<p>Tên người nhận:</p>
													<input type="text" name="orname" placeholder="" required value="<?php echo $orname?>">
												</div>
												<div class="single-input">
													<p>Địa chỉ giao hàng:</p>
													<input type="text" name="address" placeholder="" required value="<?php echo $address?>">
												</div>
												<div class="single-input">
													<p>Số điện thoại:</p>
													<input type="text" name="ormobile" placeholder="" required value="<?php echo $ormobile?>">
												</div>
												
											</div>
										</div>
									</div>
									
									<div class="<?php echo $accordion_class?>">
										Phương thức thanh toán
									</div>
									<div class="paymentinfo">
										<div class="single-method">
											COD <input type="radio" name="payment_type" value="COD" required/>
											Chuyển khoản ngân hàng <input type="radio" name="payment_type" value="chuyenkhoan" required/>
										</div>
									</div>

								<input type="submit" name="submit" value="BUY" class="fv-btn"/>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="order-details">
					<h5 class="order-details__title">Đơn hàng của bạn</h5>
					<div class="order-details__item">
						<?php
						$cart_total=0;
						if(isset($_SESSION['cart'])) {
						foreach($_SESSION['cart'] as $key=>$val) {
						foreach($val as $key1=>$val1) {
												
							$resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.* from product_attributes where product_attributes.id='$key1'"));						
							$productArr=get_product($con,'','',$key,'','','','',$key1);
							$pid=$productArr[0]['id'];
							$pname=$productArr[0]['name'];
				
							$price=$productArr[0]['price'];
							$image=$productArr[0]['image'];
							$qty=$val1['qty'];
							
							$cart_total=$cart_total+($price*$qty);
						?>
						<div class="single-item">
							<div class="single-item__thumb">
								<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"/>
							</div>
							<div class="single-item__content">
								<a href="product.php?id=<?php echo $pid?>"><?php echo $pname?> * <?php echo $qty?></a>
								<span class="price" style="text-align: right;"><?php echo formatMoney($price*$qty)?>đ</span>
							</div>
						</div>
						<?php } } } ?>
					</div>
					<div class="ordre-details__total">
						<h5>Tổng số đơn đặt hàng</h5>
						<span class="price">
							<span id="order_total_price"><?php echo formatMoney($cart_total)?></span>
							<span> đ</span>
						</span>
					</div>

			
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function formatCash(str) {
		return str.split('').reverse().reduce((prev, next, index) => {
			return ((index % 3) ? next : (next + ',')) + prev
		})
	}

</script>		

<?php 
require('footer.php');
?>        