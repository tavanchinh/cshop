<div class="container page-shadow">
    <div class="breaking-news isscrolling" rel="0">
        <div class="breaking-title">
            <i class="fa fa-bullhorn"></i><b>Trending</b>
            <div class="the-corner"></div>
        </div>
        <div class="breaking-block">
            <ul style="left: 0;">
                <li><a href="post.html">Lorem ipsum dolor sit amet et dolor adolescens sit</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
                <li><a href="post.html">Alia corpora ea vim, te erant viris bonorum sit, ei doming prompta vis</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
                <li><a href="post.html">Nam in mundi tractatos, audire atomorum qualisque ea eos</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
                <li><a href="post.html">Lorem ipsum dolor sit amet et dolor adolescens sit</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
                <li><a href="post.html">Alia corpora ea vim, te erant viris bonorum sit, ei doming prompta vis</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
                <li><a href="post.html">Nam in mundi tractatos, audire atomorum qualisque ea eos</a><span>Ea cum tation populo dolores, ex modo falli oblique sit oblique sit. Sed cu omnium debitis qualisque...</span></li>
            </ul>
        </div>
        <div class="breaking-controls">
            <a href="#" class="breaking-arrow-left">&nbsp;</a><a href="#" class="breaking-arrow-right">&nbsp;</a>
            <div class="clear-float"></div>
            <div class="the-corner"></div>
        </div>
        <!-- END .breaking-news -->
    </div>
    <div class="hot-news">
        <ul>
            <li class="large">
                <a href="#">
                    <img src="http://nextwpthemes.com/themes/orbitnews/upload/slide4.jpg" alt=""/>
                    <p>More Than 120 ER Visits Linked To Synthetic WordPress In NYC Over Past Week</p>
                </a>
            </li>
            <?php for($i = 0; $i < 4; $i++){?>
                <li <?php echo ($i%2 == 1) ? 'class="no-margin-right"' : ''?>>
                    <a href="#">
                        <img src="http://nextwpthemes.com/themes/orbitnews/upload/slide1.jpg" />
                        <p>Create a Flexible Folded Paper Effect Using CSS3 Features</p>
                
                    </a>
                </li>
            <?php }?>
        </ul>
    </div>
    <div class="left-content">
        <div class="block block-1">
            <ul class="heading">
                <li><a href="#"><span><i class="fa fa-pencil"></i></span>Xem gì hôm nay</a></li>
                <?php 
                    $list = ['Style hunter','Vogue','Health & Fitness','Travel','Gadgets','More'];
                    foreach($list as $value){?>
                        <li><a href="#"><?php echo $value;?></a></li>
                    <?php }
                ?>
                
            </ul>
            <ul class="list-news">
                <li class="large">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/51-324x235.jpg"/>
                        <p>10 Landscapes You Won’t Have Even Imagined Exist</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                    <div>Prince Edward Island, Canada Prince Edward Island is a Canadian province. It is one of the three Maritime provinces and it is the smallest in...</div>
                </li>
                <?php for($i = 0; $i < 4; $i++){?>
                <li>
                    <a href="#">
                        <img src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/101-100x70.jpg" alt=""/>
                        <p>DIY and interior design tips: Decorating to celebrating the great indoors</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="block block-2">
            <ul class="heading">
                <li><a href="#"><span><i class="fa fa-pencil"></i></span>Chuyện sao</a></li>
                <?php 
                    $list = ['Style hunter','Vogue','Health & Fitness','Travel','Gadgets','More'];
                    foreach($list as $value){?>
                        <li><a href="#"><?php echo $value;?></a></li>
                    <?php }
                ?>
                
            </ul>
            <ul class="list-news">
                <li class="large">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/69-324x160.jpg"/>
                        <p>Whitewater Rafting Day Trip from New York in the East</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                    <div>Prince Edward Island, Canada Prince Edward Island is a Canadian province. It is one of the three Maritime provinces and it is the smallest in...</div>
                </li>
                <li class="large no-margin-right">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/67-324x160.jpg"/>
                        <p>Five things you may have missed over the weekend from the...</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                    <div>Prince Edward Island, Canada Prince Edward Island is a Canadian province. It is one of the three Maritime provinces and it is the smallest in...</div>
                </li>
                <?php for($i = 0; $i < 4; $i++){?>
                <li class="small-item <?php echo ($i%2 == 1) ? 'no-margin-right' : '';?>">
                    <a href="#">
                        <img src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/101-100x70.jpg" alt=""/>
                        <p>DIY and interior design tips: Decorating to celebrating the great indoors</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="block block-3">
            <ul class="heading">
                <li><a href="#"><span><i class="fa fa-pencil"></i></span>Cine</a></li>
                <?php 
                    $list = ['Style hunter','Vogue','Health & Fitness','Travel','Gadgets','More'];
                    foreach($list as $value){?>
                        <li><a href="#"><?php echo $value;?></a></li>
                    <?php }
                ?>
                
            </ul>
            <ul class="list-news">
                <li class="medium">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/105-218x150.jpg"/>
                        <p>Whitewater Rafting Day Trip from New York in the East</p>
                    </a>
                    
                </li>
                <li class="medium">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/102-218x150.jpg"/>
                        <p>Five things you may have missed over the weekend from the...</p>
                    </a>
                    
                </li>
                <li class="medium no-margin-right">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/103-218x150.jpg"/>
                        <p>Whitewater Rafting Day Trip from New York in the East</p>
                    </a>
                </li>
        
            </ul>
        </div>
        <div class="block block-4">
            <ul class="heading">
                <li><a href="#"><span><i class="fa fa-pencil"></i></span>Quotes</a></li>
                <?php 
                    $list = ['Style hunter','Vogue','Health & Fitness','Travel','Gadgets','More'];
                    foreach($list as $value){?>
                        <li><a href="#"><?php echo $value;?></a></li>
                    <?php }
                ?>
                
            </ul>
            <ul class="list-news">
                <li class="large">
                    <a href="#">
                        <img alt="" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/51-324x235.jpg"/>
                        <p>10 Landscapes You Won’t Have Even Imagined Exist</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                    <div>Prince Edward Island, Canada Prince Edward Island is a Canadian province. It is one of the three Maritime provinces and it is the smallest in...</div>
                </li>
                <?php for($i = 0; $i < 4; $i++){?>
                <li>
                    <a href="#">
                        <img src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/101-100x70.jpg" alt=""/>
                        <p>DIY and interior design tips: Decorating to celebrating the great indoors</p>
                    </a>
                    <em>23/04/2015 - 10:44</em>
                </li>
                <?php }?>
            </ul>
        </div>
    </div> <!--End left-content-->
    <div class="right-content">
        <?php $this->renderPartial('//layouts/blocks/right_block');?>
    </div>

</div>
<script>
    $(function(){
        var total_w = 0;
        var number = $(".breaking-block ul li").length;
        var i = 0;
        $(".breaking-block ul li").each(function(){
            i++;
            if(i < number){
                total_w += $(this).width();
            }else{
                return false;
            }
                
            
        });
        
        
        var isPaused = false;
        var left = 0;
        setInterval(function(){
            if(!isPaused){
                left--;
                if(left > (-1)*total_w){
                    $(".breaking-block ul").css('left',left+'px');
                }else{
                    left = 0;
                }
            }
            
        },40);
        
        $(".breaking-news").hover(function(){
            isPaused = true;
        },function(){
            isPaused = false;
        })
    })
</script>