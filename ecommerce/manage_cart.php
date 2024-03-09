<?php
require('connection.inc.php');
require('functions.inc.php');
require('add_to_cart.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$attr_id=0;


$obj=new add_to_cart();

if($type=='add'){
	$obj->addProduct($pid,$qty,$attr_id);
}

if($type=='remove'){
	$obj->removeProduct($pid,$attr_id);
}

if($type=='update'){
	$obj->updateProduct($pid,$qty,$attr_id);
}

echo $obj->totalProduct();
?>