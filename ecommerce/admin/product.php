<?php
require('top.inc.php');

$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==1){
	$condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
	$condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' $condition1 where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from product where id='$id'";
		mysqli_query($con,$delete_sql);
		$delete_sql_1="delete from product_attributes where product_id='$id'";
		mysqli_query($con,$delete_sql_1);
	}
}

$sql="select * from product";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   	<div class="row">
		  	<div class="col-xl-12">
			 	<div class="card">
					<div class="card-body">
						<h4 class="box-title">Sản Phẩm </h4>
						<h4 class="box-link"><a href="manage_product.php">Thêm sản phẩm</a> </h4>
					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										
										<th width="2%">ID</th>
										<th width="20%">Tên</th>
										<th width="40%">Ảnh</th>
										<th width="28%"></th>
									</tr>
								</thead>
								<tbody>
									<?php while($row=mysqli_fetch_assoc($res)) { ?>
									<tr>
										
										<td><?php echo $row['id']?></td>
										<td><?php echo $row['name']?></td>
										<td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"/></td>
										
										<td>
											<?php
												if($row['status']==1){
													echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
												}else{
													echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
												}
												echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
												echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['id']."'>Delete</a></span>";
											?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
			 	</div>
		  	</div>
	   	</div>
	</div>
</div>

<?php
require('footer.inc.php');
?>