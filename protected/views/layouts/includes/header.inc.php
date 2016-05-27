<?php 
    $webconfig = WebConfig::model()->getInfo();
?>
<header id="header">
    
    <div class="top-menu">
        <div class="container">
            <ul class="support">
                <li>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span><?php echo $webconfig->hotline;?></span>
                </li>
                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span><?php echo $webconfig->email;?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="middle">
        <div class="container">
            <a class="logo" title="Trang chủ" href="/">
                <img id="logo" alt="" src="/images/logo.png" />
            </a>
            
            <form class="form-search" id="form-search" action="" method="GET">
                <div class="input-container">
                    <input name="p" placeholder="Tìm kiếm" />
                    <i class="fa fa-search" onclick="$('#form-search').submit();"></i>
                </div>
            </form>
        </div>
    </div>
    
</header>
<div class="clear"></div>
<?php include('nav.inc.php');?>