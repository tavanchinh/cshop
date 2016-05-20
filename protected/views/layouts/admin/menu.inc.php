<?php 
    $module = 'admin'; //Yii::app()->controller->module->id ;
    $menus = array(
        array(
            'text' => 'Thống kê',
            'icon' => '<i class="material-icons">&#xE01D;</i>',
            'link' => '/'.$module.'/default',
            'list_controller_actions' => array(
                'default_index',
            )
        ),
        
        array(
            'text' => 'User',
            'icon' => '<i class="material-icons">perm_identity</i>',
            'link' => '/'.$module.'/default',
            'list_controller_actions' => array(
                'default_index',
            )
        ),
        
        array(
            'text' => 'Sản phẩm',
            'icon' => '<i class="material-icons">shopping_cart</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'product_admin',
                'product_create',
                
            ),
            'sub' => array(
                array('link' => '/'.$module.'/product/admin?view=all','text' => 'Tất cả sản phẩm','controller_action' => 'product_admin'),
                array('link' => '/'.$module.'/product/create','text' => 'Thêm mới','controller_action' => 'product_create'),
            )
        ),
        array(
            'text' => 'Ban quản trị',
            'icon' => '<i class="material-icons">&#xE7FB;</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'member_admin',
                'member_create',
                'groups_admin',
                'groups_update',
                'functional_admin',
                'functional_create',
                'functional_update',
                'cache_admin',
            ),
            'sub' => array(
                array('link' => '/'.$module.'/member/admin','text' => 'Tài khoản admin','controller_action' => 'member_admin'),
                array('link' => '/'.$module.'/groups/admin','text' => 'Quản lý nhóm','controller_action' => 'groups_admin'),
                array('link' => '/'.$module.'/functional/admin','text' => 'Danh sách chức năng','controller_action' => 'functional_admin'),
                array('link' => '/'.$module.'/member/create','text' => 'Tạo tài khoản','controller_action' => 'member_create'),
                array('link' => '/'.$module.'/cache/admin','text' => 'Quản lý cache','controller_action' => 'cache_admin'),
            )
        ),
        
        array(
            'text' => 'Thể loại',
            'icon' => '<i class="material-icons">&#xE02F;</i>',
            'link' => '/'.$module.'/category/admin',
            'list_controller_actions' => array(
                'category_admin',
                'category_create',
                'category_update'
            )
        ),
        array(
            'text' => 'Quản lý bài viết',
            'icon' => '<i class="material-icons">create</i>',
            'link' => '/'.$module.'/news/admin',
            'list_controller_actions' => array(
                'news_admin',
                'news_create',
                'news_update'
            )
        ),
        
        array(
            'text' => 'Quản lý tags',
            'icon' => '<i class="material-icons">&#xE54E;</i>',
            'link' => '/'.$module.'/tag/admin',
            'list_controller_actions' => array(
                'tag_admin',
                'tag_create',
                'tag_update'
            )
        ),
        array(
            'text' => 'User',
            'icon' => '<i class="material-icons">&#xE853;</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'member_admin',
                'feedback_admin',
            ),
            'sub' => array(
                 array('link' => '/'.$module.'/member/admin','text' => 'Tất cả','controller_action' => 'member_admin'),
                array('link' => '/'.$module.'/feedback/admin','text' => 'Ý kiến phản hồi','controller_action' => 'feedback_admin'),
            )
        ),
        
        array(
            'text' => 'Cấu hình',
            'icon' => '<i class="material-icons">&#xE8B8;</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'webconfig_admin',
                'webconfig_update',
                'slide_admin',
                'slide_create',
                'slide_update',
                'ads_update',
                'ads_admin',
                'ads_create',
            ),
            'sub' => array(
                 array('link' => '/'.$module.'/webconfig/admin','text' => 'Web config','controller_action' => 'webconfig_admin'),
                 array('link' => '/'.$module.'/slide/admin','text' => 'Quản lý slide','controller_action' => 'slide_admin'),
                 array('link' => '/'.$module.'/ads/admin','text' => 'Quản lý quảng cáo','controller_action' => 'ads_admin'),
            )
        ),
    );
    
?>
<div class="menu_section">
    <ul>
        <?php 
            $controller_action = $this->id.'_'.$this->action->id;
            foreach($menus as $value){
                $class_current_section = '';
                if(in_array($controller_action,$value['list_controller_actions'])){
                    $class_current_section = 'current_section';
                }
                $list_sub = isset($value['sub']) ? $value['sub'] : array();
                $count_sub = count($list_sub);
                ?>
                <li class="<?php echo $class_current_section; echo ($count_sub > 0) ? ' submenu_trigger' : '' ?>" title="<?php echo $value['text']?>">
                    <a class="parent-menu" href="<?php echo $value['link']?>">
                        <span class="menu_icon"><?php echo $value['icon']?></span>
                        <span class="menu_title"><?php echo $value['text']?></span>
                    </a>
                    <?php if($count_sub > 0){
                        echo '<ul>';
                        foreach($list_sub as $sub_item){?>
                            <li class="<?php echo ($controller_action == $sub_item['controller_action']) ? 'act_item' : ''?>"><a href="<?php echo $sub_item['link']?>"><?php echo $sub_item['text']?></a></li>
                        <?php }
                        echo '</ul>';
                    }?>
                </li>
        <?php }?>
    </ul>
</div>
