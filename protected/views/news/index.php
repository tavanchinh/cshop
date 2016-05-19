<div class="container page-shadow">
    <div class="left-content">
        <div class="block">
            <p class="caption"><span class="icon-pencil"><i class="fa fa-pencil"></i></span>Xem gì hôm nay</p>
            <ul class="list-news-cate">
                <?php for($j = 1; $j < 3; $j++){?>
                <?php for($i = 1; $i < 5; $i++){?>
                <li>
                    <a href="#">
                        <img src="http://nextwpthemes.com/themes/orbitnews/upload/imagepost<?php echo $i?>.jpg" />
                        <p>Create a Flexible Folded Paper Effect Using CSS3 Features</p>
                    </a>
                    <div>Venenatis volutpat orci, ut sodales augue tempor nec. Integer tempus ullamcorper felis eget dipiscing. Maecenas orci justo, mollis at</div>
                </li>
                <?php } }?>
            </ul>
        </div>
        <ul class="pagination">
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">...</a></li>
			<li><a href="#">50</a></li>
		</ul>
        
    </div>
    <div class="right-content">
        <?php $this->renderPartial('//layouts/blocks/right_block');?>
    </div>
</div>