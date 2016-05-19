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
        <li class="menu-search">
            <form class="form-search" id="form-search" action="" method="GET">
                <div class="input-container">
                    <input name="p" placeholder="Tìm kiếm" />
                    <i class="fa fa-search" onclick="$('#form-search').submit();"></i>
                </div>
            </form>
        </li>
    </ul>
</div>