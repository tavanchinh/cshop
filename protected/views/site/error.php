<div class="container page-shadow">
    <div class="left-content">
        <?php if($code == 404){?>
            <div class="error-404">
                <p>Error <strong>404</strong>
                <span>Xin lỗi, nội dung bạn tìm kiếm đã mất tích khỏi hệ thống</span></p>
            </div>
            
        <?php }?>
    </div>
    <div class="right-content">
        <div class="block">
            <div class="fb-page" data-href="https://www.facebook.com/phimbathu/" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
        </div>
        <?php $this->renderPartial('/layouts/blocks/tags')?>
    </div>
</div>