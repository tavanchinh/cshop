<div class="most-view block">
    <div class="tabs">
        <div data-id="d" class="tab active"><span>Trending</span></div>
        <div data-id="w" class="tab"><span>Tin mới</span></div>
        <div data-id="m" class="tab"><span>Hot nhất</span></div>
    </div>
    <div class="clear"></div>
    <ul class="list-news">
        <?php for($i = 1; $i <= 5; $i++){
            $image = 'http://nextwpthemes.com/themes/orbitnews/upload/thumb1.jpg';
            $link = '#';
            $ratePoint = rand(0,5);
            ?>
        <li>
            <a href="<?php echo $link?>" title="<?php echo 'Dictum ipsum vel laoreet. Sed convallis quam ut elit'?>">
                <img class="avatar" alt="<?php echo 'Dictum ipsum vel laoreet. Sed convallis quam ut elit'?>" src="<?php echo $image;?>" />
                <div class="title">
                    <p class="name"><?php echo 'Dictum ipsum vel laoreet. Sed convallis quam ut elit'?></p>                    
                </div>
            </a>
            <p class="view"><?php echo '123'?> lượt xem</p>
            <p class="star" data-rating="<?php echo $ratePoint?>"></p>
        </li>
        <?php }?>
    </ul>
</div> <!-- End most-view -->
<script src="/js/jquery.raty.js"></script>
<script>
    $(document).ready(function(){
        $(".most-view .tab").click(function(){
            var type = $(this).attr('data-id');
            $(".most-view .list-film").html("");
            $(".most-view .tab").removeClass('active');
            $(this).addClass('active');
            var data={'type':type}
            var success_fnc = function(data){
                $(".most-view .list-film").html(data);   
                $('.star').raty({
                    readOnly : true,
                    numberMax : 5,
                    half  : true,
                    score: function() {
                        return $(this).attr('data-rating');
                    },
                    space : false
                });
            }
            handleAjax('/film/AjaxView','POST','',data,success_fnc);
            
        });
          
        $('.star').raty({
            readOnly : true,
            numberMax : 5,
            half  : true,
            score: function() {
                return $(this).attr('data-rating');
            },
            space : false
        });  
    })
</script>