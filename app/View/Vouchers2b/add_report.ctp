<?php
    if(isset($this->request->data['Vouchers2bReport']['report_date']) && $this->request->data['Vouchers2bReport']['report_date'] != ''){
        $this->request->data['Vouchers2bReport']['report_date'] = $funcall->DB2date($this->request->data['Vouchers2bReport']['report_date']);
    }
?>
<div class="box-body">
<?php echo $this->Form->create('Vouchers2bReport', array('type' => 'file')); ?>
<?php echo $this->Form->input('vouchers2b_id',array('type'=>'hidden','value'=>$id)); ?>
	<table class="table table-bordered">
		<tr>
			<td>
           		<div class="form-group"> 
<?php 
            		echo $this->Form->input('book_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile',
						 	'label'		=> 'Book No.',	
						 	'div'		=> false,
						 	'maxlength'	=> 15,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						)
            		);  
?> 
				</div>				
			</td>
			<td>
           		<div class="form-group"> 
<?php 
            		echo $this->Form->input('page_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile',
						 	'label'		=> 'Page No.',	
						 	'maxlength'	=> 15,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						)
            		);  
?> 
				</div>				
			</td>
			<td>
           		<div class="form-group"> 
<?php 
            		echo $this->Form->input('unit_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> 'Unit No.',	
						 	'autoComplete'=> 'off',	 
						)
            		);  
?> 
				</div>				
			</td>						
		</tr>	
		<tr>
			<td>
           		<div class="form-group"> 
<?php 
            		echo $this->Form->input('phadi_name',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> 'Phadi Name',
						 	'autoComplete'=> 'off',
						 	'required'	=> true,		 
						)
            		);  
?> 
				</div>				
			</td>
			<td>
           		<div class="form-group"> 
<?php 
            		echo $this->Form->input('report_date',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control my_date',
						 	'label'		=> 'Date',		
						 	'autoComplete'=> 'off', 
						 	'readonly'	=> true,
						 	'required'	=> true,
						)
            		);  
?> 
				</div>				
			</td>	
			<td></td>		
		</tr>
		<tr>
			<td colspan="3">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>No. of Collector</th>
							<th>No. of Keries Purchased</th>
							<th>Amount in Rs.</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Before</th>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('before_collector_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile collector',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
								</div>									
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('before_keries_puchased_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile keries',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
								</div>
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('before_amount',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric amt',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
								</div>
							</td>							
						</tr>
						<tr>
							<th>Today</th>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('today_collector_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile collector',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
								</div>									
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('today_keries_puchased_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile keries',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,
						 	'autoComplete'=> 'off',	 
						)
            		);  
?> 
								</div>
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('today_amount',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric amt',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,
						 	'maxlength'	=> 10,	
						 	'autoComplete'=> 'off',	 
						)
            		);  
?> 
								</div>
							</td>							
						</tr>
						<tr>
							<th>Total</th>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('total_collector_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,
						 	'readonly'	=> true,
						 	'id'		=> 'total_collector_no', 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						)
            		);  
?> 
								</div>									
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('total_keries_puchased_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,
						 	'readonly'	=> true,
						 	'id'		=> 'total_keries_no',
						 	'autoComplete'=> 'off',		
						 	'required'	=> true, 
						)
            		);  
?> 
								</div>
							</td>
							<td>
           						<div class="form-group"> 
<?php 
            		echo $this->Form->input('total_amount',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'size'		=> 10,	
						 	'readonly'	=> true,
						 	'id'		=> 'total_amount',	
						 	'autoComplete'=> 'off', 
						 	'required'	=> true,
						)
            		);  
?> 
								</div>
							</td>							
						</tr>												
					</tbody>
				</table>
			</td>
		</tr>
        <tr>
			<td colspan="3" align="center">
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
	</table>
<?php echo $this->Form->end()?>
</div>
<script>
$(document).on('keyup','.collector',function(){
	var totCollector = 0;
	$('.collector').each(function(){
		if($(this).val() != ''){
			totCollector = parseInt(totCollector) + parseInt($(this).val());
		}
	});
	if(totCollector != 0){
		$('#total_collector_no').val(totCollector);
	}else{
		$('#total_collector_no').val('');
	}
});
$(document).on('keyup','.keries',function(){
	var totkeries = 0;
	$('.keries').each(function(){
		if($(this).val() != ''){
			totkeries = parseInt(totkeries) + parseInt($(this).val());
		}
	});
	if(totkeries != 0){
		$('#total_keries_no').val(totkeries);
	}else{
		$('#total_keries_no').val('');
	}
});
$(document).on('keyup','.amt',function(){
	var totAmt = 0;
	$('.amt').each(function(){
		if($(this).val() != ''){
			totAmt = parseFloat(totAmt) + parseFloat($(this).val());
		}
	});
	if(totAmt != 0){
		$('#total_amount').val(totAmt);
	}else{
		$('#total_amount').val('');
	}
});
</script>