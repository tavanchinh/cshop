<?php $baseUrl = Yii::app()->request->baseUrl;
$cates = Category::model()->getTreeFrontend();
?>
<div id="header">
    <div class="btn-humber"></div>
    <a class="logo" href="/" title="Trang chủ">
		<img src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/06/logo-header.png" alt="" />
	</a>
    <i class="fa fa-search btn-search" onclick="$('.mobile-search-bar').removeClass('hide');$('#keyword').focus();"></i>
    
    <div class="mobile-search-bar hide">
        <form action="/tim-kiem.html" method="GET" id="form_search">
            <input name="q" id="keyword" autocomplete="off"  type="text" placeholder="Tìm kiếm..." />
            <div style="display: block;" id="suggestions" class="msuggestions top-search-box"></div>
        </form>
        <i class="fa fa-search mobile-search-submit" onclick="$('#form_search_mobile').submit()"></i>
        <i class="fa fa-times close-button" onclick="$('.mobile-search-bar').addClass('hide')"></i>

    </div>
</div>
<div id="main-menu">
	<ul>
		<?php foreach($cates as $key=>$value){?>
            <li>
                <a href="#"><?php echo $value['name']?></a>
                <?php if(isset($value['sub'])){?>
                    <ul class="sub-menu">
                        <?php foreach($value['sub'] as $sub){?>
                            <li><a href="#"><?php echo $sub['name']?></a></li>
                        <?php }?>
                        
                    </ul>
                <?php }?>
            </li>
        <?php }?>
	</ul>

</div>
<script src="/js/jquery.touchSwipe.min.js"></script>
<script>
    var $menu = $("#main-menu");
    var $over_lay = $('#overlay_menu');
    var hw = $(window).height();
    
    function set_height_menu(){
        /*
        var w_scroll_top = $(window).scrollTop();
        if(w_scroll_top >= 50){
            pos_top_menu = 0;
        }else{
            pos_top_menu = 50-w_scroll_top;
        }
        $menu.css('top',pos_top_menu+'px');
        $("#overlay_menu").css('top',pos_top_menu+'px');
        */
    }
    function open_menu(){
        $('body').addClass('menu-active');
        $menu.addClass('expanded');
        set_height_menu();
        $(".btn-humber").addClass('active');
        
    }
    
    function close_menu(){
        $('body').removeClass('menu-active');
        $menu.removeClass('expanded');
        var w_scroll_top = $(window).scrollTop();
        if(w_scroll_top >= 50){
            pos_top_menu = 0;
        }else{
            pos_top_menu = w_scroll_top;
        }
        set_height_menu();
        $(".btn-humber").removeClass('active');
    }
    
    $(document).ready(function(){
        //Xử lý khi ấn vào nút menu
        $(".btn-humber").click(function(){
            if($menu.hasClass('expanded')){
                close_menu();
            }else{
                open_menu();
            }
        }); 
        
        //Xu ly khi vuot tren man hinh
        /*
        $("#content").swipe({    
            swipeRight:function(event, direction, distance, duration, fingerCount){                
                open_menu();
            },
            threshold:20,
            fingers:'all',
        });
        $("#overlay_menu").swipe({
            swipeLeft:function(event, direction, distance, duration, fingerCount){
                close_menu();
            },
            threshold:10,
            fingers:'all',
        });
        */
        $(window).scroll(function(){
           set_height_menu(); 
        });
        
        $(".parent-menu").click(function(){
            $this = $(this);
            $arrow = $this.find('.fa-expand');
            if($arrow.hasClass('fa-angle-down')){
                $arrow.removeClass('fa-angle-down').addClass('fa-angle-up');
            }else{
                $arrow.addClass('fa-angle-down').removeClass('fa-angle-up');
            }
            $this.find('.sub-menu').toggle(); 
        });
        
    });
</script>