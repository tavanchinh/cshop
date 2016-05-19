<?php $detect_mobile = new Mobile_Detect;?>
<?php if(!$detect_mobile->isMobile()):?>
<div class="block">
    <div class="fb-page" data-href="https://www.facebook.com/phimbathu/" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
</div>
<?php $this->renderPartial('/layouts/blocks/most_view')?>
<?php $this->renderPartial('/layouts/blocks/tags')?>
<?php endif;?>
