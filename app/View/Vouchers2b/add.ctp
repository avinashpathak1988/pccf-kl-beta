<?php
    if(isset($this->request->data['Vouchers2b']['voucher_date']) && $this->request->data['Vouchers2b']['voucher_date'] != ''){
        $this->request->data['Vouchers2b']['voucher_date'] = $funcall->DB2date($this->request->data['Vouchers2b']['voucher_date']);
    }
    if(isset($this->data['Vouchers2bdetail'][0]['collection_date']) && $this->data['Vouchers2bdetail'][0]['collection_date'] != ''){
        $this->request->data['Vouchers2bdetail'][0]['collection_date'] = $funcall->DB2date($this->data['Vouchers2bdetail'][0]['collection_date']);
    }      
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 2b',array('controller'=>'Vouchers2b','action'=>'index'),array('escape'=>false))?>
</div>
<?php
    }
?>
<div class="box-body">
	<div>
	<?php echo $this->Form->create('Vouchers2b', array('type' => 'file')); ?>
	<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'vouchers2b_id')); ?>
	<?php echo $this->Form->input('fyear',array('type'=>'hidden','value'=>$fyear_id)); ?>
	<?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_id)); ?>
    <table class="table table-bordered">
        <tr>
            <td>
            	<div class="form-group">
					<div class="input text">
						<label for="Vouchers2bVoucherNumber">Financial Year</label><br />
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
            <td>
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('payment_method',
	            		array(
	            			'type'		=> 'select',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Payment Method',
							'options'	=> array('NEFT'=>'NEFT','Cheque'=>'Cheque','DD'=>'DD','Cash'=>'Cash'),
						 	'default'	=> 'NEFT',			 
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
            		echo $this->Form->input('forester',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> 'Forester',
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
				</div>
            </td>
            <td>
            	<div class="form-group"> 
<?php 
            		echo $this->Form->input('forester_section',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> 'Forester Section',
						 	'autoComplete'=> 'off',
						)
            		);  
?> 
				</div>
			</td>
            <td>
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
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="15%">Date of Collection</th>
							<th width="15%">Name of Phadi</th>
							<th width="20%">Reference to Book No/Page No. Of KL From No.1</th>
							<th width="15%">Reference to Book No/Page No. Of KL From No.2</th>
							<th width="15%">Number of Keries Purchased</th>
							<th width="20%">Amount in Rs.</th>
						</tr>
						<tr>
							<td align="center">1</td>
							<td align="center">2</td>
							<td align="center">3</td>
							<td align="center">4</td>
							<td align="center">5</td>
							<td align="center">6</td>
						</tr>
						<tr>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers2bdetail.0.collection_date',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control my_date',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'size'		=> 10,
									 	'readonly'	=> true,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers2bdetail.0.phadi_name',
			            			array(
			            				'type'		=> 'text',
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
			            		echo $this->Form->input('Vouchers2bdetail.0.ref_book_kl1',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control',
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
			            		echo $this->Form->input('Vouchers2bdetail.0.ref_book_kl2',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control',
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
			            		echo $this->Form->input('Vouchers2bdetail.0.keries_purchased_no',
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
			            		echo $this->Form->input('Vouchers2bdetail.0.amount',
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
						</tr>
						
					</thead>
				</table>
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
	if($('#vouchers2b_id').val() != ''){
		showDetails();
	}
});
function showDetails(){
	if($('#vouchers2b_id').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers2b','action'=>'voucher2bDetails'))?>";
		$.post(url,{id:$('#vouchers2b_id').val()},function(res){ 
			$('#listingDiv').html(res);
		});		
	}
}
function deleteDetail(id){
	if(id != ''){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers2b','action'=>'voucher2bDetailsDelete'))?>";
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