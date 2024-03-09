<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
	header('location:login.php');
	die();
}
$meta_title="Graden Home";
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <title><?php echo $meta_title?></title>


   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" type="image/x-icon" href="images/logo.png">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->
</head>
<body>
   <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="menu-title">Menu</li>
               <li class="menu-item-has-children dropdown">
                  <a href="product.php" >Sản phẩm</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <?php 
                     if($_SESSION['ADMIN_ROLE']==1){
                        echo '<a href="order_master_vendor.php" >Đơn hàng</a>';
                     }else{
                        echo '<a href="order_master.php" >Đơn hàng</a>';
                     }
                  ?>
               </li>
               <?php if($_SESSION['ADMIN_ROLE']!=1){?>

                  <li class="menu-item-has-children dropdown">
                     <a href="users.php">Người dùng</a>
                  </li>
                 
                  <li class="menu-item-has-children dropdown">
                     <a href="contact_us.php">Liên hệ</a>
                  </li>
               <?php } ?>
            </ul>
         </div>
      </nav>
   </aside>

   <div id="right-panel" class="right-panel">
      <header id="header" class="header">
         <div class="navbar-header">
            <a  href="product.php"><img src="images/logo1.png" alt="Logo" style="height: 80px; width: auto;"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" >Xin chào, <?php echo $_SESSION['ADMIN_USERNAME']?></a>
                  <div class="user-menu dropdown-menu">
                     <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Đăng xuất</a>
                  </div>
               </div>
         </div>
            
   
        
      </header>
   
    