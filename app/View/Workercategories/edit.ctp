<?php 
echo $this->Form->create('Workercategory'); ?>

<div class="box-body">
    <div class="form-group"> 
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->input('title',array(
            'label'=>'Category Name',
            'class'=>'form-control',            
        )); ?>
    </div>   
    
     <div class="form-group"> 
        <?php echo $this->Form->input('is_enable',array(
            'label'=>'Is Enable ?',
            'class'=>'form-control',  
            'options'=>$is_enable,
            'default'=>1          
        )); ?>
    </div>  
    
     <div class="form-group"> 
        <?php echo $this->Form->end('Save',array(
            'class'=>'form-control',            
        )); ?>
    </div>    
    
</div>
