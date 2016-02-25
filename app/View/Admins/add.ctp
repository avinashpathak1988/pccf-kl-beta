
<div class="box-body">
      <?php echo $this->Form->create('Admin');  ?>
      
      <div class="form-group"> <?php echo $this->Form->input('title',array(
					 	'class'=>'form-control',
					 	'label'=>'Name'				 
					 ));  ?> 
					 
		</div>
		
		<div class="form-group"> <?php echo $this->Form->input('email',array(
					 	'class'=>'form-control'				 
					 ));  ?> 
					 
		</div>
		
		<div class="form-group"> <?php echo $this->Form->input('usertype_id',array(
					 	'class'=>'form-control',
					 	'label'=>'User Type',
					 	'options'=>$usertype_id		 
					 ));  ?> 
					 
		</div>
		
		<div class="form-group"> <?php echo $this->Form->input('user_id',array(
					 	'class'=>'form-control',
					 	'label'=>'User ID',
					 	'type'=>'text'		 
					 ));  ?> 
					 
		</div>
		
		<div class="form-group"> <?php echo $this->Form->input('password',array(
					 	'class'=>'form-control'				 
					 ));  ?> 
					 
		</div>
		
			<div class="form-group"> <?php echo $this->Form->input('is_enable',array(
					 	'class'=>'form-control',
					 	'options'=>$options_is_enable			 
					 ));  ?> 
					 
		</div>
		
					 
					 <div class="form-group"> <?php echo $this->Form->end('Save'); ?> 
					 
					 </div>
					 </div>