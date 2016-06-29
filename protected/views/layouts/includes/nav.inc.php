<?php 
$tree_menu = Menu::model()->getMultilevel();
$path_info = Yii::app()->request->getPathInfo();
?>
<div class="container nav">
    <ul id="main-menu"> 
        <?php 
            $menus = array(
                'Xem gì hôm nay','Chuyện sao','Cine','Quotes & Quiz','Video',
            );
        ?>
        <?php 
        $i = 0;
        foreach($tree_menu as $value){
            $i++;
            ?>
            <li <?php echo ($value['slug'] == $path_info) ? 'class="active"' : ''?>>
                <a href="<?php echo $value['slug']?>" title=""><?php echo $value['title']?></a>
                <?php if(isset($value['sub'])){
                    $list_sub = $value['sub'];
                    ?>
                    <ul class="sub-menu">
                        <?php foreach($list_sub as $sub){?>
                            <li><a title="<?php echo $sub['title']?>" href="<?php echo $sub['slug']?>"><?php echo $sub['title']?></a></li>
                        <?php }?>
                    </ul>
                <?php }?>
            </li>
        <?php }?>
    </ul>
</div>