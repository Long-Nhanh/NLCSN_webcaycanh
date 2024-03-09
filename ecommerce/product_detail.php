<!doctype html>
<html class="no-js" lang="en">
<head>
	<link rel="stylesheet" href="style.css">
	<style>
		.button{
			display: inline-block;
			position: relative;
			background-color: #099809;  
	
			color: #FFFFFF;  
			
			text-align: center;  
			-webkit-transition-duration: 0.4s; 
			border-radius: 8px;
			/* Safari */  
			transition-duration: 0.4s;  
			text-decoration: none;  
			overflow: hidden;  
			cursor: pointer;
			width: 45%;
			
			font-size: 14px;
			height: 46px;
			line-height: 46px;
			transition: 0.3s;
			margin-top: 6px;
		}
		.button:after {  
			content: "";  
			background: #f1f1f1;  
			display: block;  
			position: absolute;  
			padding-top: 300%;  
			padding-left: 350%;  
			margin-left: -20px !important;  
			margin-top: -120%;  
			opacity: 0;  
			transition: all 0.8s;
			color: #FFFFFF;
		}
		.button:active:after {  
			padding: 0;  
			margin: 0;  
			opacity: 1;  
			transition: 0s;
		}
		.pro__tab__content__inner{
			color: #000000;
			font-size: 20px;
			line-height: 35px;
		}
	</style>
</head>
<?php 
ob_start();
require('top.php');
if(isset($_GET['id'])){
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
	
	$resMultipleImages=mysqli_query($con,"select product_images from product_images where product_id='$product_id'");
	$multipleImages=[];
	if(mysqli_num_rows($resMultipleImages)>0){
		while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
			$multipleImages[]=$rowMultipleImages['product_images'];
		}
	}

	$resAttr=mysqli_query($con,"select product_attributes.* from product_attributes where product_attributes.product_id='$product_id'");
	$productAttr=[];
	if(mysqli_num_rows($resAttr)>0){
		while($rowAttr=mysqli_fetch_assoc($resAttr)){
			$productAttr[]=$rowAttr;
		}
	}
	
} else {
	?>
	<script>
		window.location.href='index.php';
	</script>
	<?php
}
?>

<!-- Bradcaump area -->
<div class="ht__bradcaump__area bg__white">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
							<a class="breadcrumb-item" href="product.php">Sản Phẩm</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active"><?php echo $get_product['0']['name']?></span> 
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Product Details Area -->
<section class="htc__product__details bg__white ptb--60" style="margin-top: -20px;">
	<!--Product Details Top -->
	<div class="htc__product__details__top">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-lg-5 col-sm-12 col-xs-12 ml--40">
					<div class="htc__product__details__tab__content">
						<!--Product Big Images -->
						<div class="product__big__images">
							<div class="portfolio-full-image tab-content">
								<div role="tabpanel" class="tab-pane fade in active rounded float-end" id="img-tab-1">
									<div id="">	           
										<img src="./media/product_images/<?php echo $get_product['0']['image']?>" class="rounded float-end " style="max-width: 100%; height: auto; border-radius:8px;">
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40 ml--60 col-5">
					<div class="ht__product__dtl">
						<h2><?php echo $get_product['0']['name']?></h2>
						<p class="pro__info">Giá sản phẩm: <?php echo number_format($get_product['0']['price'],0,',','.')?>đ</p>		
								<div class="input-group-prepend" method="post" >
									<p>Số lượng: </p>
									<input type="number" name="qty" id="qty" value="1" size="1" min="1" max ="10">
								</div>
								<div class="ht__pro__desc">																					
									<?php 
											$cart_show='yes';
											$is_cart_box_show="hide";
											
										?>
											
										<div class="sin__desc align--left <?php echo $isQtyHide?>" id="cart_qty" style="display: none;">
											<?php
												if($cart_show!='') {
											?>
											<p>
												<span>Số lượng:</span> 
												<select id="qty" class="select__size">
													<?php
														for($i=1;$i<=$pending_qty;$i++){
															echo "<option>$i</option>";
														}
													?>
												</select>
											</p>
											<?php } ?>
										</div>
										
										<div id="cart_attr_msg"></div>
										<div id="is_cart_box_show">
											<a  class="button" style="color: #FFFFFF;" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Thêm vào giỏ hàng
											<script>window.location.href='#';</script>
											</a>
										</div> 
									</div>
								</div>
							</div>
							
					</div>
			</div> 
		</div>
	</div>
</section>
<input type="hidden" id="cid"/>
<input type="hidden" id="sid"/>
		
<!--Product Description -->
<section class="htc__produc__decription bg__white style="font-family: tahoma;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- List And Grid View -->
				<ul class="pro__details__tab" >
					<li class="description active"><a href="#description" data-toggle="tab">Chi Tiết</a></li>

				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="ht__pro__details__content" >
					<!-- Single Content -->
					<div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
						<div class="pro__tab__content__inner" style="text-align: justify;">
							<?php echo $get_product['0']['description']?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	function showMultipleImage(im) {
		jQuery('#img-tab-1').html("<img src='"+im+"' data-origin='"+im+"'/>");
	}
	let pid='<?php echo $product_id?>';
</script>			

<?php 
require('footer.php');
ob_flush();
?>        
