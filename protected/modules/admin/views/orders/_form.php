<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div style="clear: both;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <div class="uk-grid">
        <div class="uk-width-3-4">
            <div class="md-card">
                <div class="md-card-toolbar">
                    <div class="md-card-toolbar-actions">
                        <i class="md-icon material-icons md-card-toggle"></i>
                    </div>
                    <h3 class="md-card-toolbar-heading-text">Thông tin đơn hàng</h3>
                </div>
                <div class="md-card-content">
                    <div class="row">
                        <h2 style="margin: 0;">#<?php echo $model->id?></h2>
                        <div><span><strong>Họ tên:</strong> <?php echo $model->full_name?></span></div>
                        <div></div>
                    </div>
                    
                    <div class="row">
                        <span><strong>SĐT:</strong> <?php echo $model->phone_number?></span>
                    </div>
                    <div class="row">
                        <span><strong>Email:</strong> <?php echo $model->email?></span>
                    </div>
                    <div class="row">
                        <span><strong>Địa chỉ:</strong> <?php echo $model->address?></span>
                    </div>
                    <div class="row">
                        <span><strong>Note:</strong> <?php echo $model->note?></span>
                    </div>
                </div>
            </div>
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">Sản phẩm</h3>
                    
                </div>
                <div class="md-card-content">
                    <?php 
                        $list_product = Orders::model()->getListProduct($model->id);
                        if(count($list_product) > 0){?>
                            <table class="uk-table">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Sale</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php 
                                $total_money = 0;
                                $total_money_sale = 0;
                                foreach($list_product as $value){
                                    $money_sale = $value['price']*$value['qty']*($value['sale'])/100;
                                    $total_money_sale += $money_sale;
                                    $money = $value['price']*(100-$value['sale'])/100*$value['qty'];
                                    $total_money+=$money;
                                    ?>
                                    <tr>
                                        <td>
                                            <img style="margin-right: 5px;width: 40px;" src="<?php echo SimpleImage::model()->getThumbnail($value['image'],60)?>" />
                                            <?php echo $value['title']?>
                                        </td>
                                        <td><?php echo Str::formatNumber($value['price'])?></td>
                                        <td><?php echo $value['sale']?> %</td>
                                        <td><?php echo $value['qty']?></td>
                                        <td><?php echo Str::formatNumber($money)?></td>
                                    </tr>
                                <?php }?>
                                <tr>
                                    <td colspan="4" style="text-align: right;">Sale:</td>
                                    <td><?php echo Str::formatNumber($total_money_sale) . Product::model()->currency;?></td>
                                </tr>
                                <tr style="color:#bb0000;font-weight: bold;">
                                    <td colspan="4" style="text-align: right; border:none;">Tổng tiền:</td>
                                    <td style="border: none;"><?php echo Str::formatNumber($total_money) . Product::model()->currency;?></td>
                                </tr>
                            </table>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="uk-width-1-4">
            <div class="md-card">
                <div class="md-card-content">
                    <div class="row">
                    	<?php echo $form->labelEx($model,'status'); ?>
                    	<?php echo $form->dropDownList($model,'status',Orders::model()->list_status); ?>
                    	<?php echo $form->error($model,'status'); ?>
                    </div>
                    <div class="">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class' => 'md-btn md-btn-success')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->