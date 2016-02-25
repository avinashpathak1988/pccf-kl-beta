

      <?php echo $this->Form->create('Worker');  ?>
	  <div class="box-body">
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("ro_id",array(
				'label'=>'Select RO',
				'class'=>'form-control',
				'options'=>$ros,
			));  ?>
	  	</div>	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("worker_code",array(
				'label'=>'Code',
				'class'=>'form-control'
			));  ?>
	  	</div>
          
         <div class="form-group"> 
	  		<?php echo $this->Form->input("workercategory_id",array(
				'label'=>'Category',
				'class'=>'form-control',
                'options'=>$categories,
                'empty'=>'-- Select Category --',
			));  ?>
	  	</div>  
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("title",array(
				'label'=>'Name',
				'class'=>'form-control'
			));  ?>
	  	</div>	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("card_number",array(
				'label'=>'Card Number',
				'class'=>'form-control'
			));  ?>
	  	</div>	
	  	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("address",array(
				'label'=>'Address',
				'class'=>'form-control',
				'div'=>false,
				'rows'=>'4',
			));  ?>
	  	</div>	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("contact_number",array(
				'label'=>'Contact Number',
				'class'=>'form-control'
			));  ?>
	  	</div>	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("city",array(
				'label'=>'City/Village',
				'class'=>'form-control'
			));  ?>
	  	</div>	
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->input("postal_code",array(
				'label'=>'Postal Code',
				'class'=>'form-control'
			));  ?>
	  	</div>	
	  	
	  <div class="form-group"> 
	  		<?php echo $this->Form->input("is_enable",array(
				'label'=>'Is Enable',
				'class'=>'form-control',
				'options'=>$options_is_enable
			));  ?>
	  	</div>
	  	
	  	<div class="form-group"> 
	  		<?php echo $this->Form->end("Save");  ?>
	  	
	  	</div>	
	  
	  
	  
	  </div>
	  
	  