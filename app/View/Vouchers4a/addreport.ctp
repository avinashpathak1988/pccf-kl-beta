<div class="box-body">
<?php echo $this->Form->create('Vouchers4aReport', array('type' => 'file')); ?>
<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->input('vouchers4a_id',array('type'=>'hidden','id'=>'vouchers4a_id','value'=>$id)); ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2"></th>
				<th rowspan="2">MIII</th>
				<th rowspan="2">IVM</th>
				<th colspan="4">IVM</th>
				<th rowspan="2">Total</th>
			</tr>
			<tr>
				<th>I</th>
				<th>II</th>
				<th>III</th>
				<th>TB</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>Previous Bundle</strong></td>
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile previousBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile previousBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile previousBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric previousBundle',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric previousBundle',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric previousBundle',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('previous_bundle_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control previousBundleTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Today Bundle</strong></td>
				<td>
<?php 
            		echo $this->Form->input('today_bundle_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_bundle_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('today_bundle_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_bundle_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayBundle',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_bundle_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayBundle',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_bundle_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayBundle',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('today_bundle_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control todayBundleTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Total Bundle</strong></td>
				<td>
<?php 
            		echo $this->Form->input('total_bundle_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_bundle_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('total_bundle_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalBundle',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_bundle_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalBundle',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_bundle_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalBundle',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_bundle_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalBundle',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('total_bundle_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control totalBundleTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Before Filled Sack</strong></td>
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('before_filled_sack_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control beforeFilledSackTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Today Filled Sack</strong></td>
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('today_filled_sack_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control todayFilledSackTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Total Filled Sack</strong></td>
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalFilledSack',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalFilledSack',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('total_filled_sack_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control totalFilledSackTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>No. of Sacks before godown storage</strong></td>
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeSacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeSacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('before_sacks_godown_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control beforeSacksGodownTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>No. of sacks to store today in godown </strong></td>
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todaySacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todaySacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todaySacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todaySacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todaySacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todaySacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('today_sacks_godown_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control todaySacksGodownTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Total No. of sacks to be stored in godown </strong></td>
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalSacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalSacksGodown',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalSacksGodown',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('total_sacks_godown_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control totalSacksGodownTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>	
			<tr>
				<td><strong>Before Grading Test </strong></td>
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile beforeGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric beforeGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('before_grading_test_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control beforeGradingTestTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Today Grading Test </strong></td>
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile todayGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric todayGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('today_grading_test_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control todayGradingTestTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Total Grading Test </strong></td>
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalGradingTest',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalGradingTest',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('total_grading_test_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control totalGradingTestTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Total Days </strong></td>
				<td>
<?php 
            		echo $this->Form->input('total_days_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalDays',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_days_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalDays',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('total_days_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile totalDays',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_days_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalDays',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_days_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalDays',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('total_days_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric totalDays',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('total_days_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control totalDaysTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Average </strong></td>
				<td>
<?php 
            		echo $this->Form->input('average_miii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile average',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('average_ivm',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile average',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('average_ivm_i',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile average',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('average_ivm_ii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric average',
						 	'label'		=> false,
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',	
						 	'size'		=> 10, 
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('average_ivm_iii',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric average',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('average_ivm_tb',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric average',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('average_total',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control averageTotal',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						 	'readonly'	=> true,
						)
            		);  
?> 									
				</td>		
			</tr>
			<tr>
				<td><strong>Previous Keri Count</strong></td>
				<td colspan="7">
					<?php echo $this->Form->input('previous_keri_count',array('type'=>'text','class'=>'form-control mobile','div'=>false,'label'=>false))?>
				</td>
			</tr>
			<tr>
				<td><strong>Today Keri Count</strong></td>
				<td colspan="7">
					<?php echo $this->Form->input('today_keri_count',array('type'=>'text','class'=>'form-control mobile','div'=>false,'label'=>false))?>
				</td>
			</tr>
			<tr>
				<td><strong>Total Keri Count</strong></td>
				<td colspan="7">
					<?php echo $this->Form->input('total_keri_count',array('type'=>'text','class'=>'form-control mobile','div'=>false,'label'=>false))?>
				</td>
			</tr>
			<tr>
				<td><strong>Total Working Days</strong></td>
				<td colspan="7">
					<?php echo $this->Form->input('today_work_days',array('type'=>'text','class'=>'form-control mobile','div'=>false,'label'=>false))?>
				</td>
			</tr>
			<tr>
				<td><strong>Average Working Days</strong></td>
				<td colspan="7">
					<?php echo $this->Form->input('average_work_days',array('type'=>'text','class'=>'form-control mobile','div'=>false,'label'=>false))?>
				</td>
			</tr>																								
	        <tr>
				<td colspan="8" align="center">
<?php
				echo $this->Form->button('Add Report',
					array(
						'type'	=> 'submit',
						'class'	=> 'btn btn-success',
					)
				);
?>
				</td>
	        </tr>  
        </tbody>				
	</table>
<?php echo $this->Form->end()?>
</div>
<script>
	$(document).on('keyup','.previousBundle',function(){
		var totalPreviousBundle = 0;
		$('.previousBundle').each(function(){
			if($(this).val() != ''){
				totalPreviousBundle = parseFloat(totalPreviousBundle) + parseFloat($(this).val());
			}
		});
		if(totalPreviousBundle != 0){
			$('.previousBundleTotal').val(totalPreviousBundle);
		}else{
			$('.previousBundleTotal').val('');
		}
	});
	$(document).on('keyup','.todayBundle',function(){
		var totaltodayBundle = 0;
		$('.todayBundle').each(function(){
			if($(this).val() != ''){
				totaltodayBundle = parseFloat(totaltodayBundle) + parseFloat($(this).val());
			}
		});
		if(totaltodayBundle != 0){
			$('.todayBundleTotal').val(totaltodayBundle);
		}else{
			$('.todayBundleTotal').val('');
		}
	});
	$(document).on('keyup','.totalBundle',function(){
		var totBundle = 0;
		$('.totalBundle').each(function(){
			if($(this).val() != ''){
				totBundle = parseFloat(totBundle) + parseFloat($(this).val());
			}
		});
		if(totBundle != 0){
			$('.totalBundleTotal').val(totBundle);
		}else{
			$('.totalBundleTotal').val('');
		}
	});	
	$(document).on('keyup','.beforeFilledSack',function(){
		var totalbeforeFilledSack = 0;
		$('.beforeFilledSack').each(function(){
			if($(this).val() != ''){
				totalbeforeFilledSack = parseFloat(totalbeforeFilledSack) + parseFloat($(this).val());
			}
		});
		if(totalbeforeFilledSack != 0){
			$('.beforeFilledSackTotal').val(totalbeforeFilledSack);
		}else{
			$('.beforeFilledSackTotal').val('');
		}
	});
	$(document).on('keyup','.todayFilledSack',function(){
		var totaltodayFilledSack = 0;
		$('.todayFilledSack').each(function(){
			if($(this).val() != ''){
				totaltodayFilledSack = parseFloat(totaltodayFilledSack) + parseFloat($(this).val());
			}
		});
		if(totaltodayFilledSack != 0){
			$('.todayFilledSackTotal').val(totaltodayFilledSack);
		}else{
			$('.todayFilledSackTotal').val('');
		}
	});
	$(document).on('keyup','.totalFilledSack',function(){
		var totFilledSack = 0;
		$('.totalFilledSack').each(function(){
			if($(this).val() != ''){
				totFilledSack = parseFloat(totFilledSack) + parseFloat($(this).val());
			}
		});
		if(totFilledSack != 0){
			$('.totalFilledSackTotal').val(totFilledSack);
		}else{
			$('.totalFilledSackTotal').val('');
		}
	});
	$(document).on('keyup','.beforeSacksGodown',function(){
		var totalbeforeSacksGodown = 0;
		$('.beforeSacksGodown').each(function(){
			if($(this).val() != ''){
				totalbeforeSacksGodown = parseFloat(totalbeforeSacksGodown) + parseFloat($(this).val());
			}
		});
		if(totalbeforeSacksGodown != 0){
			$('.beforeSacksGodownTotal').val(totalbeforeSacksGodown);
		}else{
			$('.beforeSacksGodownTotal').val('');
		}
	});
	$(document).on('keyup','.todaySacksGodown',function(){
		var totaltodaySacksGodown = 0;
		$('.todaySacksGodown').each(function(){
			if($(this).val() != ''){
				totaltodaySacksGodown = parseFloat(totaltodaySacksGodown) + parseFloat($(this).val());
			}
		});
		if(totaltodaySacksGodown != 0){
			$('.todaySacksGodownTotal').val(totaltodaySacksGodown);
		}else{
			$('.todaySacksGodownTotal').val('');
		}
	});
	$(document).on('keyup','.totalSacksGodown',function(){
		var totSack = 0;
		$('.totalSacksGodown').each(function(){
			if($(this).val() != ''){
				totSack = parseFloat(totSack) + parseFloat($(this).val());
			}
		});
		if(totSack != 0){
			$('.totalSacksGodownTotal').val(totSack);
		}else{
			$('.totalSacksGodownTotal').val('');
		}
	});	
	$(document).on('keyup','.beforeGradingTest',function(){
		var totalbeforeGradingTest = 0;
		$('.beforeGradingTest').each(function(){
			if($(this).val() != ''){
				totalbeforeGradingTest = parseFloat(totalbeforeGradingTest) + parseFloat($(this).val());
			}
		});
		if(totalbeforeGradingTest != 0){
			$('.beforeGradingTestTotal').val(totalbeforeGradingTest);
		}else{
			$('.beforeGradingTestTotal').val('');
		}
	});
	$(document).on('keyup','.todayGradingTest',function(){
		var totaltodayGradingTest = 0;
		$('.todayGradingTest').each(function(){
			if($(this).val() != ''){
				totaltodayGradingTest = parseFloat(totaltodayGradingTest) + parseFloat($(this).val());
			}
		});
		if(totaltodayGradingTest != 0){
			$('.todayGradingTestTotal').val(totaltodayGradingTest);
		}else{
			$('.todayGradingTestTotal').val('');
		}
	});
	$(document).on('keyup','.totalGradingTest',function(){
		var totGrad = 0;
		$('.totalGradingTest').each(function(){
			if($(this).val() != ''){
				totGrad = parseFloat(totGrad) + parseFloat($(this).val());
			}
		});
		if(totGrad != 0){
			$('.totalGradingTestTotal').val(totGrad);
		}else{
			$('.totalGradingTestTotal').val('');
		}
	});


	$(document).on('keyup','.totalDays',function(){
		var totaltotalDays = 0;
		$('.totalDays').each(function(){
			if($(this).val() != ''){
				totaltotalDays = parseFloat(totaltotalDays) + parseFloat($(this).val());
			}
		});
		if(totaltotalDays != 0){
			$('.totalDaysTotal').val(totaltotalDays);
		}else{
			$('.totalDaysTotal').val('');
		}
	});
	$(document).on('keyup','.average',function(){
		var totalaverage = 0;
		$('.average').each(function(){
			if($(this).val() != ''){
				totalaverage = parseFloat(totalaverage) + parseFloat($(this).val());
			}
		});
		if(totalaverage != 0){
			$('.averageTotal').val(totalaverage);
		}else{
			$('.averageTotal').val('');
		}
	});							
</script>