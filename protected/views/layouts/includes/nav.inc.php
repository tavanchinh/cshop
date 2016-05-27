<div class="container nav">
    <ul id="main-menu"> 
        <?php 
            $menus = array(
                'Xem gì hôm nay','Chuyện sao','Cine','Quotes & Quiz','Video',
            );
        ?>
        <?php 
        $i = 0;
        foreach($menus as $value){
            $i++;
            ?>
            <li <?php echo ($i == 1) ? 'class="active"' : ''?>>
                <a href="#" title=""><?php echo $value?></a>
                <?php if($i==3){?>
                    <ul class="sub-menu">
                        <li><a title="" href="#">Phim Châu Á</a></li>
                        <li><a title="" href="#">Phim Châu Mĩ</a></li>
                        <li><a title="" href="#">Phim rạp hot</a></li>
                    </ul>
                <?php }?>
                <?php if($i==5){?>
                    <ul class="sub-menu">
                        <li><a title="" href="#">Chế</a></li>
                        <li><a title="" href="#">Cảnh phim</a></li>
                        <li><a title="" href="#">OST</a></li>
                    </ul>
                <?php }?>
            </li>
        <?php }?>
    </ul>
</div>