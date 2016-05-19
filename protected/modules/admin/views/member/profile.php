<div class="uk-grid" id="user_profile">
    <div class="uk-width-7-10">
        <div class="md-card">
            <div class="user_heading">
                <div class="user_heading_avatar">
                    <img src="/cms/assets/img/avatars/user.png" alt="user avatar" />
                </div>
                <div class="user_heading_content">
                    <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo $info['display_name']?></span><span class="sub-heading"><?php echo $info['name']?></span></h2>
                </div>
            </div>
            <div class="user_content">
                <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom">
                    <div class="uk-width-large-1-2">
                        <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                        <ul class="md-list md-list-addon">
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><?php echo $info['email']?></span>
                                    <span class="uk-text-small uk-text-muted">Email</span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><?php echo $info['phone_number']?></span>
                                    <span class="uk-text-small uk-text-muted">Phone</span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon uk-icon-facebook-official"></i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">facebook.com</span>
                                    <span class="uk-text-small uk-text-muted">Facebook</span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-addon-element">
                                    <i class="md-list-addon-icon uk-icon-twitter"></i>
                                </div>
                                <div class="md-list-content">
                                    <span class="md-list-heading">twitter.com</span>
                                    <span class="uk-text-small uk-text-muted">Twitter</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="uk-width-large-3-10">
        <div class="md-card">
            <div class="md-card-content">
                <h3 class="heading_a uk-margin-bottom">Các dự án đang tham gia</h3>
                <div class="uk-overflow-container">
                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th class="uk-text-nowrap">Tên dự án</th>
                                <th class="uk-text-nowrap">Ngày bắt đầu</th>
                            </tr>
                        </thead>
                        
                        <?php if(count($list_project) > 0){
                            foreach($list_project as $value){ 
                                ?>
                                <tr class="uk-table-middle">
                                    <td><a href="/cms/project/view/id/<?php echo $value['id']?>"><?php echo $value['name']?></a></td>
                                    <td class="uk-text-nowrap"><?php echo $value['create_date']?></td>
                                </tr>
                            <?php }
                        }else{?>
                        <tr class="uk-table-middle">
                            <td colspan="5">Click vào <a href="/cms/issues/create">đây</a> để tạo task mới</td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-grid">
    <div class="uk-width-1-1">
        <div class="md-card">
            <div class="md-card-content">
                <a style="float: right;" href="/cms/issues/admin/member/<?php echo Yii::app()->session['admin_id'];?>" title="Xem thêm">Xem thêm</a>
                <h3 class="heading_a uk-margin-bottom">Công việc của bạn</h3>
                <div class="uk-overflow-container">
                    <table class="uk-table">
                        <thead>
                            <tr>
                                <th class="uk-text-nowrap">Task</th>
                                <th class="uk-text-nowrap">Project</th>
                                <th class="uk-text-nowrap">Trạng thái</th>
                                <th class="uk-text-nowrap">Tiến độ</th>
                                <th class="uk-text-nowrap">Deadline</th>
                            </tr>
                        </thead>
                        
                        <?php if(count($list_issues) > 0){
                            foreach($list_issues as $value){ 
                                $progress_class = 'uk-progress uk-progress-mini uk-margin-remove ';
                                if($value['tempo'] < 10){
                                    $progress_class .= 'uk-progress-danger';
                                }elseif($value['tempo'] < 50){
                                    $progress_class .= 'uk-progress-warning';
                                }elseif($value['tempo'] < 70){
                                    $progress_class .= 'uk-progress-success';
                                }
                                else{
                                    $progress_class .= '';
                                }
                                ?>
                                <tr class="uk-table-middle">
                                    <td><a href="/cms/issues/view/id/<?php echo $value['id']?>"><?php echo $value['name']?></a></td>
                                    <td><a href="/cms/project/view/id/<?php echo $value['pid']?>"><?php echo $value['pname']?></a></td>
                                    <td><?php echo Issues::model()->list_status[$value['status']]?></td>
                                    <td>
                                        <div title="<?php echo $value['tempo'].'%'?>" class="<?php echo $progress_class?>">
                                            <div class="uk-progress-bar" style="width: <?php echo $value['tempo'],'%'?>;"></div>
                                        </div>
                                    </td>
                                    <td class="uk-text-nowrap"><?php echo $value['expire_date']?></td>
                                </tr>
                            <?php }
                        }else{?>
                        <tr class="uk-table-middle">
                            <td colspan="5">Click vào <a href="/cms/issues/create">đây</a> để tạo task mới</td>
                        </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


