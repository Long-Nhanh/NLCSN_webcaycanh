<?php
require('top.inc.php');
isAdmin();
$order_id=get_safe_value($con,$_GET['id']);

if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	
	$update_sql='';

	
	if($update_order_status=='5'){
		mysqli_query($con,"update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
	}else{
		mysqli_query($con,"update `order` set order_status='$update_order_status' $update_sql where id='$order_id'");
	}
	
	if($update_order_status==4){
		$ship_order=mysqli_fetch_assoc(mysqli_query($con,"select ship_order_id from `order` where id='$order_id'"));
		if($ship_order['ship_order_id']>0){
			$token=validShipRocketToken($con);
			cancelShipRocketOrder($token,$ship_order['ship_order_id']);
		}
	}
	
}
?>

<div class="content pb-0">
	<div class="orders">
	   	<div class="row">
		  	<div class="col-xl-12">
			 	<div class="card">
					<div class="card-body">
						<h4 class="box-title">Chi tiết đơn hàng </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table">
								<thead>
									<tr>
										<th class="product-thumbnail">Tên sản phẩm</th>
										<th class="product-thumbnail">Hình ảnh</th>
										<th class="product-name">Số lượng</th>
										<th class="product-price">Giá tiền</th>
										<th class="product-price">Tổng cộng</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image,`order`.address,`order`.orname,`order`.ormobile from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id");
										$total_price=0;
										while($row=mysqli_fetch_assoc($res)){
											$userInfo=mysqli_fetch_assoc(mysqli_query($con,"select * from `order` where id='$order_id'"));
											
											$orname=$userInfo['orname'];
											$address=$userInfo['address'];
											$ormobile=$userInfo['ormobile'];
										
											
											$total_price=$total_price+($row['qty']*$row['price']);
									?>
									<tr>
										<td class="product-name"><?php echo $row['name']?></td>
										<td class="product-name"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"></td>
										<td class="product-name"><?php echo $row['qty']?></td>
										<td class="product-name"><?php echo $row['price']?></td>
										<td class="product-name"><?php echo $row['qty']*$row['price']?></td>
									</tr>
									<?php }
										
									?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">
										</td>
									</tr>
									
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Tổng cộng</td>
										<td class="product-name"><?php 
											
										?></td>
									</tr>
								</tbody>
							</table>

							<div id="address_details">
								<strong>Tên người nhận: </strong>
								<?php echo $orname?><br/>

								<strong>Địa chỉ: </strong>
								<?php echo $address?><br/>

								<strong>Số điện thoại: </strong>
								<?php echo $ormobile?><br/>

								<strong>Trạng thái đơn hàng</strong>
								<?php 
									$order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name,order_status.id as order_status from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
									echo $order_status_arr['name'];
								?>
								<div>
									<form method="post">
										<select class="form-control" name="update_order_status" id="update_order_status" required onchange="select_status()">
											<option value="">Chọn trạng thái</option>
											<?php
												$res=mysqli_query($con,"select * from order_status");
												while($row=mysqli_fetch_assoc($res)){
													echo "<option value=".$row['id'].">".$row['name']."</option>";
												}
											?>
										</select>
								
										<input type="submit" class="form-control"/>
									</form>
								</div>
							</div>
						</div>
					</div>
			 	</div>
		  	</div>
	  	</div>
	</div>
</div>

<script>
	function select_status(){
		var update_order_status=jQuery('#update_order_status').val();
		if(update_order_status==3){
			jQuery('#shipped_box').show();
		}
	}
</script>

<?php
require('footer.inc.php');
?>