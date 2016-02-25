<?php
    if(isset($this->request->data['Vouchers10']['voucher_date']) && $this->request->data['Vouchers10']['voucher_date'] != ''){
        $this->request->data['Vouchers10']['voucher_date'] = $funcall->DB2date($this->request->data['Vouchers10']['voucher_date']);
    }
    if(isset($this->data['Vouchers10']['from_date']) && $this->data['Vouchers10']['from_date'] != ''){
        $this->request->data['Vouchers10']['from_date'] = $funcall->DB2date($this->data['Vouchers10']['from_date']);
    }
    if(isset($this->data['Vouchers10']['to_date']) && $this->data['Vouchers10']['to_date'] != ''){
        $this->request->data['Vouchers10']['to_date'] = $funcall->DB2date($this->data['Vouchers10']['to_date']);
    }      
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 10',array('controller'=>'Vouchers10','action'=>'index'),array('escape'=>false))?>
</div>
<?php
    }
?>
<div class="box-body">
	<div>
	<?php echo $this->Form->create('Vouchers10', array('type' => 'file')); ?>
	<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'vouchers10_id')); ?>
	<?php echo $this->Form->input('fyear',array('type'=>'hidden','value'=>$fyear_id)); ?>
	<?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_id)); ?>
    <table class="table table-bordered table-responsive">
        <tr>
            <td>
            	<div class="form-group">
					<div class="input text">
						<label for="Vouchers10VoucherNumber">Financial Year</label><br />
						<?php echo $fyear?>
					</div>
				</div>
            </td>
            <td>
            	<div class="form-group"> 
<?php 
            		echo $this->Form->input('account_id',
            			array(
            				'type'		=> 'select',
            				'class'		=> 'form-control',
						 	'label'		=> 'Head Of Service',
						 	'options'	=> $accountList,
						 	'default'	=> $this->Session->read('hos'),			 
						)
            		);  
?> 
				</div>
			</td>
            <td>
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('voucher_number',
	            		array(
	            			'type'		=> 'text',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Voucher Number',
						 	'required'	=> true,
						 	'maxlength'	=> 100,	
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
            		echo $this->Form->input('voucher_date',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control my_date',
						 	'label'		=> 'Voucher Date',
						 	'required'	=> true,
						 	'readonly'	=> true,
						 	'value'		=> $default_date,
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
				</div>
            </td>
            <td>
            	<div class="form-group"> 
<?php 
            		echo $this->Form->input('from_date',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
            				'id'		=> 'start_date',
						 	'label'		=> 'From Date',
						 	'required'	=> true,
						 	'readonly'	=> true,						 	
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
				</div>
			</td>
            <td>
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('to_date',
	            		array(
	            			'type'		=> 'text',
						 	'class'		=> 'form-control',
						 	'id'		=> 'end_date',
						 	'label'		=> 'To Date',
						 	'required'	=> true,
						 	'readonly'	=> true,						 	
						 	'autoComplete'=> 'off',		 
						)
	            	);  
?> 
				</div>
			</td>
        </tr>
        <tr>
            <td colspan="3">
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('attach_file.',
	            		array(
	            			'type'		=> 'file',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Upload Attachment',
						 	'multiple'	=> true,
						 	'required'	=> false,
						)
	            	);  
?> 
				</div>
			</td>
        </tr>
        <tr>
			<td colspan="3">
				<div style="max-width:1000px;overflow: scroll;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th rowspan="2">Particulars of work</th>
							<th colspan="3">Progress</th>
							<th rowspan="2">Description of labour and materials</th>
							<th rowspan="2">No.</th>
							<th colspan="2">Rate</th>
							<th colspan="2">Amount</th>
							<th rowspan="2">Remarks</th>
						</tr>
						<tr>
							<th>Previous</th>
							<th>Now exhibited</th>
							<th>Total</th>
							<th>At</th>
							<th>Per Item</th>
							<th>Per Item</th>
							<th>Per Work</th>
						</tr>
						<tr>
							<td align="center">1</td>
							<td align="center">2</td>
							<td align="center">3</td>
							<td align="center">4</td>
							<td align="center">5</td>
							<td align="center">6</td>
							<td align="center">7</td>
							<td align="center">8</td>
							<td align="center">9</td>
							<td align="center">10</td>
							<td align="center">11</td>							
						</tr>
						<tr>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.particulars_wok',
			            			array(
			            				'type'		=> 'textarea',
			            				'cols'		=> 15,
			            				'rows'		=> 3,
			            				'class'		=> 'form-control',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.previous_progress',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.now_progress',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.total_progress',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.labour_materials_desc',
			            			array(
			            				'type'		=> 'textarea',
			            				'cols'		=> 15,
			            				'rows'		=> 3,
			            				'class'		=> 'form-control',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.no',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control mobile',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.rate_at',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.rate_per_item',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.amount_per_item',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.amount_per_work',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control numeric',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'maxlength'	=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers10detail.0.remarks',
			            			array(
			            				'type'		=> 'textarea',
			            				'cols'		=> 15,
			            				'rows'		=> 3,
			            				'class'		=> 'form-control',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>																																			
						</tr>
					</thead>
				</table>
				</div>
			</td>
        </tr> 
        <tr>
			<td colspan="3" align="center">
<?php
				echo $this->Form->button('Save',
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
	<div id="listingDiv">

	</div>				    
</div>
<script>
$(document).ready(function(){
	if($('#vouchers10_id').val() != ''){
		showDetails();
	}
});
function showDetails(){
	if($('#vouchers10_id').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers10','action'=>'voucher10Details'))?>";
		$.post(url,{id:$('#vouchers10_id').val()},function(res){ 
			$('#listingDiv').html(res);
		});		
	}
}
function deleteDetail(id){
	if(id != ''){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers10','action'=>'voucher10DetailsDelete'))?>";
			$.post(url,{id:id},function(res){ 
				if(res.trim() == 'SUCC'){
					$('#tr'+id).hide('slow');
					$('#tr'+id).remove();
					showDetails();
				}
			});
		}		
	}
}
</script>