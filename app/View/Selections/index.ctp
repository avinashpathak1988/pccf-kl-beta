
<?php echo $this->Form->create('Selections');  ?>
<div class="box-body">
	  	<div class="form-group">  
	  		<?php echo $this->Form->input('fyear',array(
			'class'=>'form-control',
			'label'=>'Select Financial Year',
			'options'=>$fyear
			)); ?>
	  	</div>	
	  	
	  	<div class="form-group">  
	  		<?php echo $this->Form->input('hos',array(
			'class'=>'form-control',
			'label'=>'Select Account Type',
			'options'=>$hos
			)); ?>
	  	</div>	
	  	
	  	<div class="form-group">  
	  		<?php echo $this->Form->end('Submit'); ?>
	  	</div>	
	  	
</div>

