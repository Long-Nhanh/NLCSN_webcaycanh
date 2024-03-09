<?php 
require('top.php');
?>

<div class="body__overlay"></div>
    
<!-- Product Area -->
<section class="ptb--20">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">Sản Phẩm Mới</h2>
                </div>
            </div>
        </div>
        <div class="htc__product__container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="product__list clearfix">
                    <?php
                    $get_product=get_product($con,8);
                    foreach($get_product as $list){
                    ?>
                    <!-- Single Product -->
                    <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12 ">
                        
                            <div class="ht__cat__thumb mt--30 center">
                                <a href="product_detail.php?id=<?php echo $list['id']?>">
                             
                                    <img src="./media/product/<?php echo $list['image']?>" alt="product images center">
                        
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


<input type="hidden" id="qty" value="1"/>

<?php require('footer.php')?>        