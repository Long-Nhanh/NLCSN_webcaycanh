<?php 
require('top.php');
$str=mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
	$get_product=get_product($con,'','','',$str);
}else{
	?>
		<script>
			window.location.href='index.php';
		</script>
	<?php
}										
?>

<div class="body__overlay"></div>
        
<!-- Bradcaump area -->
<div class="ht__bradcaump__area bg__white">
	<div class="ht__bradcaump__wrap">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="bradcaump__inner">
						<nav class="bradcaump-inner">
							<a class="breadcrumb-item" href="index.php">Trang Chủ</a>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active">Tìm Kiếm</span>
							<span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
							<span class="breadcrumb-item active"><?php echo $str?></span>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
        
<!-- Product Grid -->
<section class="htc__product__grid bg__white ptb--50" style="margin-top: -60px;">
	<div class="container">
		<div class="row">
			<?php if(count($get_product)>0){?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="htc__product__rightidebar">
					<!-- Product View -->
					<div class="row row-cols-1 row-cols-md-3 g-4">
						<div class="shop__grid__view__wrap">
							<div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
								<?php
									foreach($get_product as $list) {
								?>
								<!-- Single Product -->
								<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12 ">
                    
									<div class="ht__cat__thumb mt--30">
										<a href="product_detail.php?id=<?php echo $list['id']?>">
											<img src="./media/product/<?php echo $list['image']?>" alt="product images" style="height: 320px; width: auto; border-radius:6px;">
										</a>
									</div>
									<div class="fr__hover__info">
										<ul class="product__action">
											<li><a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><i class="icon-heart icons"></i></a></li>
											<li>
												<a href="product_detail.php?id=<?php echo $list['id']?>" >
													<i class="icon-handbag icons"></i>
												</a>
											</li>
										</ul>
									</div>
									
									<div class="fr__product__inner">
										<h4><a href="product_detail.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h4>
										<ul class="fr__pro__prize">
											<li><?php  echo number_format($list['price'],0,',','.')?>đ</li>
										</ul>
									</div>
								</div>
								
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } else { 
				echo "Data not found";
			} ?>
		</div>
	</div>
</section>

<input type="hidden" id="qty" value="1"/>

<?php require('footer.php')?>        