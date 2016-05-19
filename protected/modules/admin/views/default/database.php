<div class="form md-card">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'news-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
    )); ?>
    <?php 
        echo CHtml::textArea('sql',$sql,array(
            'style' => 'width:100%;padding:1%;height:200px',
            'placeholder' => 'Input string querry'
        ));
        
        echo '<br />';
        echo CHtml::submitButton("Send");
    ?>
    <?php $this->endWidget(); ?>
</div>
<?php  if($result != null){
    echo '<div class="md-card"><div class="md-card-content">';
    if(is_array($result)){
        echo '<table class="uk-table"><thead>';
        $keys = array_keys($result[0]);
        foreach($keys as $key=>$value){
            echo '<th style="text-align:center">'.$value.'</th>';
        }
        
        foreach($result as $value){
            echo '<tr>';
                foreach($keys as $key){
                    if(strpos($sql,'SELECT') !== false){
                        $text = Str::cutString($value[$key],100);    
                    }else{
                        $text = $value[$key];
                    }
                    
                    echo '<td>'.$text.'</td>';
                }
            echo '</tr>';
        }
        echo '</thead></table>';
    }else{
        var_dump($result);
    }
    echo '</div></div>';
}?>
