<?php 
    
?>
<div class="md-card">
    <div class="md-card-content">
        <div class="uk-grid">
            <?php $form = $this->beginWidget('CActiveForm',array(
                'id' => 'form-search'
            ));?>
            <div class="uk-width-1-5">
                <?php 
                    $list_project = Member::model()->getListProject();
                    echo CHtml::dropDownList('project_id',$project_id,$list_project);
                ?>
            </div>
            <div class="uk-width-1-5">
            
            </div>
            <?php $this->endWidget();?>
        </div>
        
    </div>
</div>
<div class="uk-grid">
    <div class="uk-width-1-2">
        <div class="md-card">
            <div class="md-card-content">
                <h2 class="heading_a uk-margin-bottom">Từ khóa xu hướng tăng</h2>
                <table class="uk-table uk-table-striped">
                    <thead>
                        <th>Từ khóa</th>
                        <th>Thứ hạng</th>
                        <th>Nhân viên</th>
                        <th>Đề xuất</th>
                    </thead>
                    <?php if(count($arr_asc) > 0){
                        foreach($arr_asc as $key=>$value){
                            $sql = "SELECT a.*, b.display_name from keyword a INNER JOIN member b ON a.member_id = b.id WHERE a.id = $key";
                            $info = Yii::app()->db->createCommand($sql)->queryRow();
                            echo '<tr>';
                                echo '<td>'.$info['title'].'</td>';
                                echo '<td>'.$value.'</td>';
                                echo '<td>'.$info['display_name'].'</td>';
                                echo '<td></td>';
                            echo '</tr>';
                        }
                    }?>
                </table>
            </div>
        </div>
    </div>
    
    <div class="uk-width-1-2">
        <div class="md-card">
            <div class="md-card-content">
                <h2 class="heading_a uk-margin-bottom">Từ khóa xu hướng giảm</h2>
                <table class="uk-table uk-table-striped">
                    <thead>
                        <th>Từ khóa</th>
                        <th>Thứ hạng</th>
                        <th>Nhân viên</th>
                        <th>Đề xuất</th>
                    </thead>
                    <?php if(count($arr_desc) > 0){
                        foreach($arr_desc as $key=>$value){
                            $sql = "SELECT a.*, b.display_name from keyword a INNER JOIN member b ON a.member_id = b.id WHERE a.id = $key";
                            $info = Yii::app()->db->createCommand($sql)->queryRow();
                            echo '<tr>';
                                echo '<td>'.$info['title'].'</td>';
                                echo '<td>'.$value.'</td>';
                                echo '<td>'.$info['display_name'].'</td>';
                                echo '<td></td>';
                            echo '</tr>';
                        }
                    }?>
                </table>
            </div>
        </div>
    </div>
</div>

    
<div class="md-card">
    <div class="md-card-content">
        <h2 class="heading_a uk-margin-bottom">Nhân viên</h2>
        <table class="uk-table">
            <thead>
                <th style="width: 150px;">Nhân viên</th>
                <th>Chuyên mục</th>
                <th>Chi tiêu</th>
                <th>Hiện tại</th>
                <th>% hoàn thành</th>
            </thead>
            <?php if(count($list_staff) > 0){
                
                foreach($list_staff as $key=>$value){
                    $ratio = ($value['target'] > 0) ? round($value['current']*100/$value['target'],2).'%' : '';
                    echo '<tr>';
                        echo '<td class="rowspan">'.$value['display_name'].'</td>';
                        echo '<td>'.$value['cat_name'].'</td>';
                        echo '<td>'.number_format($value['target'],0,'.',' ').'</td>';
                        echo '<td>'.number_format($value['current'],0,'.',' ').'</td>';
                        echo '<td>'.$ratio.'</td>';
                    echo '</tr>';
                }
            }?>
        </table>
    </div>
</div>
<div class="md-card">
    <div class="md-card-content">
        <h2 class="heading_a uk-margin-bottom">Cộng tác viên</h2>
        <table class="uk-table">
            <thead>
                <th style="width: 150px;">Tên CTV</th>
                <th>Công việc</th>
                <th>Chỉ tiêu</th>
                <th>Hiện tại</th>
                <th>% hoàn thành</th>
            </thead>
            <?php if(count($list_collaborators) > 0){
                
                foreach($list_collaborators as $key=>$value){
                    $ratio = ($value['target'] > 0) ? round($value['current']*100/$value['target'],2).'%' : '';
                    echo '<tr>';
                        echo '<td class="rowspan">'.$value['display_name'].'</td>';
                        echo '<td>'.Issues::model()->list_type[$value['type']].'</td>';
                        echo '<td>'.number_format($value['target'],0,'.',' ').'</td>';
                        echo '<td>'.number_format($value['current'],0,'.',' ').'</td>';
                        echo '<td>'.$ratio.'</td>';
                    echo '</tr>';
                }
            }?>
        </table>
    </div>
</div>
<script>
    
    var setRowspan = function () {
        first.attr('rowspan', rowspan);
        first.css({
            'text-align':'center',
            'vertical-align':'middle',
        });
        rowspan = 1;
    }
    var first;
    var prev = undefined;
    var rowspan = 1;
    $(document).ready(function(){
        
        $(".rowspan").each(function(){
            var txt = $(this).text();
            if (prev === txt) {
                rowspan += 1;
                $(this).remove();
            } else {
                // doesnt match, set colspan on first and reset colspan counter
                if (rowspan > 1) {
                    setRowspan();
                    console.log(rowspan);
                }
                first = $(this);
                prev = txt;
            }
        });
        
        if (rowspan > 1) {
            setRowspan();
        } 
        
        $("#project_id").change(function(){
            $("#form-search").submit();
        })
    });
    
    
</script>