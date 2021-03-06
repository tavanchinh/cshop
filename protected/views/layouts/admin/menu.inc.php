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
            'text' => 'Menu',
            'icon' => '<i class="material-icons">menu</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'menu_admin',
            ),
            'sub' => array(
                array('link' => '/'.$module.'/menu/admin?view=all','text' => 'Quản lý menu','controller_action' => 'menu_admin'),
                
            )
        ),
        
        array(
            'text' => 'Post',
            'icon' => '<i class="material-icons">mode_edit</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'post_admin',
                'post_create',
                'post_update'
            ),
            'sub' => array(
                array('link' => '/'.$module.'/post/admin?view=all','text' => 'Tất cả','controller_action' => 'post_admin'),
                array('link' => '/'.$module.'/post/create','text' => 'Thêm mới','controller_action' => 'post_create'),
            )
        ),
        
        array(
            'text' => 'User',
            'icon' => '<i class="material-icons">perm_identity</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'member_admin',
                'member_update',
                'groups_admin',
                'functional_admin',
            ),
            'sub' => array(
                array('link' => '/'.$module.'/member/admin','text' => 'Tất cả user','controller_action' => 'member_admin'),
                array('link' => '/'.$module.'/member/create','text' => 'Thêm mới','controller_action' => 'member_create'),
                array('link' => '/'.$module.'/groups/admin','text' => 'Quản lý nhóm','controller_action' => 'groups_admin'),
                array('link' => '/'.$module.'/functional/admin','text' => 'Menu admin','controller_action' => 'functional_admin'),
            )
        ),
        
        array(
            'text' => 'Sản phẩm',
            'icon' => '<i class="material-icons"></i>',
            'link' => '#',
            'list_controller_actions' => array(
                'product_admin',
                'product_create',
                'product_update',
                
            ),
            'sub' => array(
                array('link' => '/'.$module.'/product/admin?view=all','text' => 'Tất cả sản phẩm','controller_action' => 'product_admin'),
                array('link' => '/'.$module.'/product/create','text' => 'Thêm mới','controller_action' => 'product_create'),
            )
        ),
        
        array(
            'text' => 'Đơn hàng',
            'icon' => '<i class="material-icons">shopping_cart</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'orders_admin',
                'orders_create',
                'orders_update',
                
            ),
            'sub' => array(
                array('link' => '/'.$module.'/orders/admin?view=all','text' => 'Tất cả','controller_action' => 'orders_admin'),
                array('link' => '/'.$module.'/orders/create','text' => 'Thêm mới','controller_action' => 'product_create'),
            )
        ),
        
        array(
            'text' => 'Slider',
            'icon' => '<i class="material-icons">view_carousel</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'slide_admin',
                'slide_create',
                'slide_update',
                
            ),
            'sub' => array(
                array('link' => '/'.$module.'/slide/admin','text' => 'Tất cả','controller_action' => 'slide_admin'),                
            )
        ),
        
        array(
            'text' => 'Trang',
            'icon' => '<i class="material-icons">library_books</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'page_admin',
                'page_create',
                'page_update',
                
            ),
            'sub' => array(
                array('link' => '/'.$module.'/page/admin','text' => 'Tất cả','controller_action' => 'page_admin'),                
            )
        ),
        /*
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
        */
        array(
            'text' => 'Thể loại',
            'icon' => '<i class="material-icons">subject</i>',
            'link' => '/'.$module.'/category/admin',
            'list_controller_actions' => array(
                'category_admin',
                'category_create',
                'category_update'
            ),
            'sub' => array(
                array('link' => '/'.$module.'/category/admin?view=all','text' => 'Tất cả sản phẩm','controller_action' => 'category_admin'),
                array('link' => '/'.$module.'/category/create','text' => 'Thêm mới','controller_action' => 'category_create'),
            )
        ),
        array(
            'text' => 'Feedback',
            'icon' => '<i class="material-icons">mode_comment</i>',
            'link' => '#',
            'list_controller_actions' => array(
                'feedback_admin',
            ),
            'sub' => array(
                array('link' => '/'.$module.'/feedback/admin','text' => 'Tất cả','controller_action' => 'feedback_admin'),
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
                 array('link' => '/'.$module.'/webconfig/update/','text' => 'Web config','controller_action' => 'webconfig_update'),
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
