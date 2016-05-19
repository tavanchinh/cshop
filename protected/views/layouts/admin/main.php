<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <title>Administrator - <?php echo $this->pageTitle;?></title>

    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/components/weather-icons/css/weather-icons.min.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/components/metrics-graphics/dist/metricsgraphics.css" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/components/chartist/dist/chartist.min.css" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/components/uikit/css/uikit.almost-flat.min.css" media="all" />
    
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/icons/flags/flags.min.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/main.min.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/titatoggle-dist.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/common.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/ga-api-index.css" media="all" />
    <link rel="stylesheet" href="<?php echo $baseUrl?>/assets/admin/css/gridview/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/assets/admin/components/select2/select2.css" />
    <link rel="stylesheet" href="/css/jquery.datetimepicker.css" />
    <script type="text/javascript" src="<?php echo $baseUrl;?>/assets/admin/js/jquery-1.11.1.min.js"></script>
    
    <!-- common functions -->
    <script src="<?php echo $baseUrl?>/assets/admin/js/common.min.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/ckeditor/config.js"></script>	
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl?>/js/jquery.datetimepicker.js"></script>

    
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li class="user-actions">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="/assets/admin/images/user.png" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="/admin/member/changepassword">Đổi mật khẩu</a></li>
                                    <li><a href="/admin/default/logout">Đăng xuất</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="/admin" class="sSidebar_hide"><img src="/images/logo-2.png" alt="" style="width: 45px;"/></a>
                <a href="/admin" class="sSidebar_show"><img src="/images/logo-2.png" alt=""  style="width: 32px;"/></a>
            </div>
        </div>
        
        <?php include('menu.inc.php')?>
    </aside><!-- main sidebar end -->
    <div id="page_content">
        <div id="page_content_inner">
            <?php echo $content;?>
        </div>
    </div>

<div id="style_switcher">
    <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
    <div class="uk-margin-medium-bottom">
        <h4 class="heading_c uk-margin-bottom">Colors</h4>
        <ul class="switcher_app_themes" id="theme_switcher">
            <li class="app_style_default active_theme" data-app-theme="">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_a" data-app-theme="app_theme_a">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_b" data-app-theme="app_theme_b">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_c" data-app-theme="app_theme_c">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_d" data-app-theme="app_theme_d">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_e" data-app-theme="app_theme_e">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_f" data-app-theme="app_theme_f">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
            <li class="switcher_theme_g" data-app-theme="app_theme_g">
                <span class="app_color_main"></span>
                <span class="app_color_accent"></span>
            </li>
        </ul>
    </div>
    <div class="uk-visible-large uk-margin-medium-bottom">
        <h4 class="heading_c">Sidebar</h4>
        <p>
            <div class="checkbox checkbox-slider-md checkbox-slider--b-flat">
            	<label>
           		   <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" />
                   <span>Mini Sidebar</span>
            	</label>
            </div>    
        </p>
    </div>
</div>
<script>
    $(function() {
        
        
        var $switcher = $('#style_switcher'),
            $switcher_toggle = $('#style_switcher_toggle'),
            $theme_switcher = $('#theme_switcher'),
            $mini_sidebar_toggle = $('#style_sidebar_mini'),
            $boxed_layout_toggle = $('#style_layout_boxed'),
            $body = $('body'),
            $document = $(document),
            $user_action = $('.user-actions');

        $user_action.click(function(){
           $this = $(this); 
           $this.toggleClass('uk-open');
        });
        $switcher_toggle.click(function(e) {
            e.preventDefault();
            $switcher.toggleClass('switcher_active');
        });

        $theme_switcher.children('li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                this_theme = $this.attr('data-app-theme');

            $theme_switcher.children('li').removeClass('active_theme');
            $(this).addClass('active_theme');
            $body
                .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g')
                .addClass(this_theme);

            if(this_theme == '') {
                localStorage.removeItem('altair_theme');
            } else {
                localStorage.setItem("altair_theme", this_theme);
            }

        });

        // hide style switcher
        $document.on('click keyup', function(e) {
            if( $switcher.hasClass('switcher_active') ) {
                if (
                    ( !$(e.target).closest($switcher).length )
                    || ( e.keyCode == 27 )
                ) {
                    $switcher.removeClass('switcher_active');
                }
            }
        });

        // get theme from local storage
        if(localStorage.getItem("altair_theme") !== null) {
            $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
        }


    // toggle mini sidebar

        // change input's state to checked if mini sidebar is active
        if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
            $body.addClass('sidebar_mini');
            $mini_sidebar_toggle.prop( "checked", true );
        }

        $mini_sidebar_toggle
            .on('click', function(event){
                if($mini_sidebar_toggle.is(":checked")){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                }else{
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                }
                window.location.reload();
                
            })
            
    // toogle sidebar
    $("#sidebar_main_toggle").click(function(){
        $(".sidebar_main_swipe").toggleClass('sidebar_main_open');
    });
    
    //toogle submenu
    $(".parent-menu").click(function(e){
        e.preventDefault();
        $this = $(this);
        if($this.attr('href') == '#'){
            $this.next().toggle();    
        }else{
            window.location.href=$this.attr('href');
        }
        
    
    })

    });
</script>
<script type="text/javascript" src="/assets/admin/js/jquery.ba-bbq.js"></script>
<script type="text/javascript" src="/assets/admin/components/select2/select2.js"></script>
</body>
</html>