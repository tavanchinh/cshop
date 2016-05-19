<div id="header">
   <div class="left cms-name">Hệ thống quản trị website <?php echo Yii::app()->request->hostInfo?></div>
   <div class="navbar">
      <ul class="nav pull-right">
         <li class="dropdown pull-left">
            <?php
               $model = new Member();
               $admin_id = Yii::app()->session['admin_id'];                  
               if($admin_id > 0){
                  $object = $model->findByPk($admin_id);
                  if($object == null) $this->redirect('/admin/default/login');
                  $admin_name = $object->attributes['display_name'];   
               }else{
                  $this->redirect('/admin/default/login');
               }
            ?>
            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)" onclick="$('.dropdown-menu').toggle();">Xin chào, <strong style="color: #EFEA05;"><?php echo $admin_name?></strong> <i class="admin_user nav-icon"></i><b class="caret"></b></a>
            <ul class="dropdown-menu pull-left">
               <li class="divider"></li>
               <li><a href="/admin/member/changepassword"><i class="icon-file"></i>Đổi mật khẩu</a></li>
               <li><a href="/admin/default/logout"><i class="icon-off"></i><strong> Logout</strong></a></li>
            </ul>
         </li>
      </ul>
   </div>
</div>