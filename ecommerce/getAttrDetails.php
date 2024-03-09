<?php
require('connection.inc.php');
require('functions.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);


$res=mysqli_query($con,"select * from product_attributes where product_id='$pid' and qty='$qty'");
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	$productSoldQtyByProductId=productSoldQtyByProductId($con,$pid,$row['id']);									
	$pending_qty=$row['qty']-$productSoldQtyByProductId;
	echo json_encode(['qty'=>$pending_qty,'price'=>$row['price']]);
	
}else{
	
}
?>