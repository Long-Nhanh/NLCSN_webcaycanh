<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');
$wishlist_count=0;
/*
$cat_res=mysqli_query($con,"select * from order_detail where status=1 order by order_detail asc");
$cat_arr=array();
while($row=mysqli_fetch_assoc()){
	$cat_arr[]=$row;	
}
*/

date_default_timezone_set('Asia/Ho_Chi_Minh');

$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();

if(isset($_SESSION['USER_LOGIN'])){
	$uid=$_SESSION['USER_ID'];
	
	if(isset($_GET['wishlist_id'])){
		$wid=get_safe_value($con,$_GET['wishlist_id']);
		mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid'");
	}

	//$wishlist_count=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'"));
	
}

$script_name=$_SERVER['SCRIPT_NAME'];
$script_name_arr=explode('/',$script_name);
$mypage=$script_name_arr[count($script_name_arr)-1];

$meta_title="Trang Chủ";
$meta_desc="Trang Chủ";
$meta_keyword="Trang Chủ";
$meta_url=SITE_PATH;
$meta_image="";
if ($mypage=='product.php') {
	$meta_title='Sản Phẩm';
} 
if ($mypage=='aboutus.php') {
	$meta_title='Giới Thiệu';
} 
if ($mypage=='contact.php'){
	$meta_title='Contact Us';
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $meta_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta property="og:title" content="<?php echo $meta_title?>"/>
	<meta property="og:image" content="<?php echo $meta_image?>"/>
	<meta property="og:url" content="<?php echo $meta_url?>"/>
	<meta property="og:site_name" content="<?php echo SITE_PATH?>"/>
	
	<link rel="icon" type="image/x-icon" href="images/logo/logo.png">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/core.css">
    <link rel="stylesheet" href="css/shortcode/shortcodes.css">
    
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
	
	<script type="module" src="./js/model-viewer.min.js"></script>
    <script nomodule src="./js/model-viewer.js"></script>	
	
	<style>
	.htc__shopping__cart a span.htc__wishlist {
		background: #c43b68;
		border-radius: 100%;
		color: #fff;
		font-size: 9px;
		height: 17px;
		line-height: 19px;
		position: absolute;
		right: 18px;
		text-align: center;
		top: -4px;
		width: 17px;
		margin-right:15px;
	}

	
	</style>
</head>
<body>
    <!-- Body main wrapper start -->
<div class="wrapper">
	<header id="htc__header" class="htc__header__area header--one" style="border-bottom: 1px solid #f1f2f3;">
		<div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
			<div class="container">
				<div class="row">
					<div class="menumenu__container clearfix">
						<div class="col-lg-2 col-md-2 col-sm-3 col-xs-5"> 
							<div class="logo">
								<a href="index.php"><img src="images/logo/logo1.png" alt="logo images" style="height: 100px; width: auto;"></a>

							</div>
						</div>
						<div class="col-md-7 col-lg-6 col-sm-5 col-xs-3 mt--20">
							<nav class="main__menu__nav hidden-xs hidden-sm">
								<ul class="main__menu">
									<li class="drop"><a href="index.php">Trang Chủ</a></li>
									<li><a href="product.php">Sản Phẩm</a></li>
									<li><a href="aboutus.php">Giới Thiệu</a></li>
									<li><a href="contact.php">Liên Hệ</a></li>
								</ul>
							</nav>
							
							<div class="mobile-menu clearfix visible-xs visible-sm">
								<nav id="mobile_dropdown">
									<ul>
										<li><a href="index.php">Trang Chủ</a></li>	
										<li><a href="product.php">Sản Phẩm</a></li>						
										<li><a href="aboutus.php">Giới Thiệu</a></li>
										<li><a href="contact.php">Liên Hệ</a></li>
									</ul>
								</nav>
							</div>  
						</div>

						<div class="col-md-3 col-lg-4 col-sm-4 col-xs-4 mt--20">
							<div class="header__right">
								<?php 
									
									if(isset($_SESSION['USER_LOGIN'])) {
										$class="";
								} ?>

								<div class="header__search search search__open <?php echo $class?>">
									<a href="#"><i class="icon-magnifier icons"></i></a>
								</div>
								
								<div class="header__account ">
									<?php if(isset($_SESSION['USER_LOGIN'])) { ?>
									<div>
										<ul class="navbar-nav">
											<li class="nav-item dropdown">
												<a class="nav-link dropdown-toggle name-fix" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" >
													Hi <?php echo $_SESSION['USER_NAME']?>
												</a>
												<div class="dropdown-menu">
													
														<a class="dropdown-item" href="my_order.php">Đơn hàng<br></a>
														<a class="dropdown-item" href="profile.php">Hồ sơ</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="logout.php">Đăng xuất</a>
													
												</div>
												
											</li>
										</ul>
									</div>

									<?php } else {
										echo '<a href="login.php" >Đăng Nhập </a>';
									} ?>
								</div>

								<div class="htc__shopping__cart">
									<?php
										if(isset($_SESSION['USER_ID'])) {
									?>
									<?php } ?>
									<a href="cart.php"><i class="icon-handbag icons"></i></a>
									<a href="cart.php"><span class="htc__qua"><?php echo $totalProduct?></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="mobile-menu-area">
					
				</div>

			</div>
		</div>
	</header>

	<div class="body__overlay"></div>
	
	<div class="offset__wrapper">
		<div class="search__area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="search__inner">
							<form action="search.php" method="get">
								<input placeholder="Nhập từ khóa..." type="text" name="str">
								<button type="submit"></button>
							</form>
							<div class="search__close__btn">
								<span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>