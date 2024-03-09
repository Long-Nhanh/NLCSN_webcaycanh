<?php 
require('top.php');					
?>
<div class="ht__bradcaump__area bg__white">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Trang Chủ</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Sản Phẩm</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>

<section class="ptb--40">
    <div class="container">
        <div class="htc__product__container">
            <div class="row">
                <div class="product__list clearfix mt--5">
                    <?php
                    $get_product=get_product($con,40);
                    foreach($get_product as $list){
                    ?>
                    <!-- Single product -->
                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                    
                            <div class="ht__cat__thumb center">
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
                    <?php 
                    } ?>
                </div>
            </div>
        </div>
    </div>  
</section>
</div>

 

<?php require('footer.php')?>        