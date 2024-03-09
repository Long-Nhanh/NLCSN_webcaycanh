<?php
require('top.inc.php');

$condition='';
$condition1='';
if($_SESSION['ADMIN_ROLE']==1) {
	$condition=" and product.added_by='".$_SESSION['ADMIN_ID']."'";
	$condition1=" and added_by='".$_SESSION['ADMIN_ID']."'";
}

$name='';
$price='';
$qty='';
$image='';
$description ='';

$msg='';
$image_required='required';

$attrProduct['product_id']='';
$attrProduct['price']='';
$attrProduct['qty']='';
$attrProduct['id']='';


if(isset($_GET['pi']) && $_GET['pi']>0){
	$pi=get_safe_value($con,$_GET['pi']);
	$delete_sql="delete from product_images where id='$pi'";
	mysqli_query($con,$delete_sql);
}

if(isset($_GET['id']) && $_GET['id']!='') {
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0) {
		$row=mysqli_fetch_assoc($res);
		$name=$row['name'];
		$price=$row['price'];
		$qty=$row['qty'];
		$description=$row['description'];
		$image=$row['image'];
		
		$resProductAttr=mysqli_query($con,"select * from product_attributes where product_id='$id'");
		$attrProduct['product_id']=$id;
		$attrProduct['price']=$row['price'];
		$attrProduct['qty']=$row['qty'];
		$attrProduct['id']=$row['id'];
		
				
	}else {
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])) {
	//prx($_POST);
	$name=get_safe_value($con,$_POST['name']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$description=get_safe_value($con,$_POST['description']);
	
	$res=mysqli_query($con,"select product.* from product where product.name='$name'");
	
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if(isset($_GET['id']) && $_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if(isset($_FILES['product_images'])){
		foreach($_FILES['product_images']['type'] as $key=>$val){
			if($_FILES['product_images']['type'][$key]!=''){
				if($_FILES['product_images']['type'][$key]!='image/png' && $_FILES['product_images']['type'][$key]!='image/jpg' && $_FILES['product_images']['type'][$key]!='image/jpeg'){
					$msg="Please select only png,jpg and jpeg image formate in multipel product images";
				}
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql="update product set name='$name', price='$price', qty='$qty',description='$description' where id='$id'";
				$update_sql="update product_attributes set price='$price', qty='$qty' where id='$id'";
				
			}else{
				$update_sql="update product set name='$name', price='$price', qty='$qty',description='$description' where id='$id'";
				$update_sql="update product_attributes set price='$price', qty='$qty' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		
		} else {
			$image=$_FILES['image']['name'];
			
			move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
			mysqli_query($con,"insert into product(name,price,qty,description,status,image,added_by) values('$name','$price','$qty','$description',1,'$image','".$_SESSION['ADMIN_ID']."')");
			$id=mysqli_insert_id($con);
			mysqli_query($con,"insert into product_attributes(id,product_id,price,qty) values('$id','$id','$price','$qty')");
		}
		
		/*Product Multiple Images*/
		if(isset($_GET['id']) && $_GET['id']!='') {
			if(isset($_FILES['product_images']['name'])){
				foreach($_FILES['product_images']['name'] as $key=>$val){
				if($_FILES['product_images']['name'][$key]!=''){
					if(isset($_POST['product_images_id'][$key])){
						$image=$_FILES['product_images']['name'][$key];
						move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
						mysqli_query($con,"update product_images set product_images='$image' where id='".$_POST['product_images_id'][$key]."'");
					}else{
						$image=$_FILES['product_images']['name'][$key];
						move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
						mysqli_query($con,"insert into product_images(product_id,product_images) values('$id','$image')");
					}
				} }
			}
		} else {
			if(isset($_FILES['product_images']['name'])){
				foreach($_FILES['product_images']['name'] as $key=>$val){
					if($_FILES['product_images']['name'][$key]!=''){
						$image=$_FILES['product_images']['name'][$key];
						move_uploaded_file($_FILES['product_images']['tmp_name'][$key],PRODUCT_MULTIPLE_IMAGE_SERVER_PATH.$image);
						mysqli_query($con,"insert into product_images(product_id,product_images) values('$id','$image')");
					}
				}
			}
		}
		
		//Product Attributes
		
		
				
				
		
			
		redirect('product.php');
	}
}
?>

<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>Sản Phẩm</strong></div>
					<form method="post" enctype="multipart/form-data">
						<div class="card-body card-block">
							
							<div class="form-group">
								<div class='row'>
									<div class="col-lg-9">
										<label class=" form-control-label">Tên sản phẩm</label>
										<input type="text" name="name" placeholder="Nhập tên sản phẩm" class="form-control" required value="<?php echo $name?>">
									</div>
								</div>
							
							</div>

							<div class="form-group"  id="product_attr_box">
								<div class="row" id="attr_<?php echo $attrProductLoop?>">
									<div class="col-lg-2">
										<label class=" form-control-label">Giá</label>
										<input type="text" name="price" class="form-control" required value="<?php echo $price?>">
									</div>
								
									<div class="col-lg-2">
										<label  class=" form-control-label">Số lượng</label>
										<input type="text" name="qty" class="form-control" required value="<?php echo $qty?>">
									</div>					
								</div>
							</div>

							<div class="form-group">
								<div class="row"  id="image_box">
									<div class="col-lg-10">
										<label class="form-control-label">Ảnh</label>
										<input type="file" name="image" class="form-control" <?php echo $image_required?>>
										<?php
											if($image!=''){
											echo "<a target='_blank' href='".PRODUCT_IMAGE_SITE_PATH.$image."'>
											<img width='150px' src='".PRODUCT_IMAGE_SITE_PATH.$image."'/></a>";
											}
										?>
									</div>
									<!--<div class="col-lg-2">
										<label  class=" form-control-label"></label>
										<button id="" type="button" class="btn btn-lg btn-info btn-block" onclick="add_more_images()">
											<span id="payment-button-amount">Thêm ảnh</span>
										</button>
									</div>-->
									<?php
										if(isset($multipleImageArr[0])){
											foreach($multipleImageArr as $list){
												echo '<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'.$list['id'].'">
													<label for="categories" class=" form-control-label">Ảnh</label>
													<input type="file" name="product_images[]" class="form-control" >
													<a href="manage_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;">
														<button type="button" class="btn btn-lg btn-danger btn-block">
															<span id="payment-button-amount">
															<a href="manage_product.php?id='.$id.'&pi='.$list['id'].'" style="color:white;">Xóa</span>
						
														</button>
													</a>';
													echo "<a target='_blank' href='".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']."'>
														<img width='150px' src='".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list['product_images']."'/></a>";
													echo '<input type="hidden" name="product_images_id[]" value="'.$list['id'].'"/>
												</div>';
											}										 
										}
									?>
								</div>
							</div>

							<div class="form-group">
								<label class=" form-control-label">Chi tiết</label>
								<textarea style="min-height: 180px" name="description" placeholder="Nhập thông tin chi tiết sản phẩm" class="form-control" required ><?php echo $description?></textarea>
							</div>

							<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
								<span id="payment-button-amount">Gửi</span>
							</button>
							<div class="field_error"><?php echo $msg?></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
		 

<script>
	var total_image=1;
	function add_more_images(){
		total_image++;
		var html='<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'+total_image+'"><label class=" form-control-label">Ảnh</label><input type="file" name="product_images[]" class="form-control" required><button type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_image("'+total_image+'")><span id="payment-button-amount">Remove</span></button></div>';
		jQuery('#image_box').append(html);
	}
	
	function remove_image(id){
		jQuery('#add_image_box_'+id).remove();
	}
	
	var attr_count=1;
	function add_more_attr(){
		attr_count++;
		
		var html='<div class="row mt20" id="attr_'+attr_count+'"> div class="col-lg-2"><label  class=" form-control-label">Price</label><input type="text" name="price[]" placeholder="Price" class="form-control" required="" value=""> </div> <div class="col-lg-2"><label class=" form-control-label">Qty</label><input type="text" name="qty[]" placeholder="Qty" class="form-control" required="" value=""> </div><div class="col-lg-2"><label class=" form-control-label">&nbsp;</label><button id="" type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_attr("'+attr_count+'")><span id="payment-button-amount">Remove</span></button> </div><input type="hidden" name="attr_id[]" value=""/></div>';
		jQuery('#product_attr_box').append(html);
	}
	
	function remove_attr(attr_count,id){
		jQuery.ajax({
			url:'remove_product_attr.php',
			data:'id='+id,
			type:'post',
			success:function(result){
				jQuery('#attr_'+attr_count).remove();
			}
		});
	}
</script>     

<?php
require('footer.inc.php');
?>
