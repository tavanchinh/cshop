<?php
$mobile_detect = new Mobile_Detect;
$mobile = $mobile_detect->isMobile();
$controller_action = $this->id.'_'.$this->action->id;
if(!$mobile && $controller_action == 'site_index'){?>
<script type="text/javascript" src="/js/jquery.fireworks.js"></script>
<script>
    $('body').fireworks(); 
    setTimeout(function() {
        $('body').fireworks('destroy'); 
    },10000);
</script>
<style>
    
	.caudoi{
		top:68px;
		position:absolute;
	}
	.caudoi.fix{
		position:fixed;
		top:40px;
	}
	.caudoi-left{
		left:0;
	}
	.caudoi-right{
		right:0;
	}
</style>
<div class="caudoi caudoi-left">
	<img src="/images/cau-doi-tet-1.png" />
</div>
<div class="caudoi caudoi-right">
	<img src="/images/cau-doi-tet-2.png" />
</div>
<?php }?>