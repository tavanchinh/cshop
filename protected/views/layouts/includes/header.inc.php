<?php 
$days = ['Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy','Chủ nhât'];
?>
<header id="header">
    
    <div class="top-menu">
        <div class="container">
            <span class="date"><?php echo $days[date('N')-1];?>, <?php echo date('d'). ' tháng ' . date('m') . ' năm ' . date('Y')?></span>
            <ul>
                <li>
                    <a href="#">Đăng nhập</a>
                    <span>/</span>
                    <a href="#">Đăng ký</a>
                </li>
                <li>
                    <a href="http://phimbathu.com" target="_blank">Xem phim</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="middle">
        <div class="container">
            <a class="logo" title="Trang chủ" href="/">
                <img id="logo" alt="hautruong.net" src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/06/logo-header.png" />
            </a>
            <div class="ads">
                <img src="http://demo.tagdiv.com/newspaper/wp-content/uploads/2015/04/rec728.jpg" />
            </div>
        </div>
    </div>
    
</header>
<div class="clear"></div>
<?php include('nav.inc.php');?>