<?php
    if(isset($this->request->data['Vouchers6']['issue_date']) && $this->request->data['Vouchers6']['issue_date'] != ''){
        $this->request->data['Vouchers6']['issue_date'] = $funcall->DB2date($this->request->data['Vouchers6']['issue_date']);
    }     
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 6',array('controller'=>'Vouchers6','action'=>'index'),array('escape'=>false))?>
</div>
<?php
    }
?>
<div class="box-body">
	<div>
	<?php echo $this->Form->create('Vouchers6', array('type' => 'file')); ?>
	<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'vouchers6_id')); ?>
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
						 	'div'		=> false,		 
						)
            		);  
?> 
				</div>
			</td>
            <td>
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('book_number',
	            		array(
	            			'type'		=> 'text',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Book Number',
						 	'required'	=> true,
						 	'maxlength'	=> 100,	
						 	'autoComplete'=> 'off',	
						 	'div'		=> false,	 
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
	            	echo $this->Form->input('page_number',
	            		array(
	            			'type'		=> 'text',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Page Number',
						 	'required'	=> true,
						 	'maxlength'	=> 100,	
						 	'autoComplete'=> 'off',
						 	'div'		=> false,							 	
										 
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
						 	'maxlength'	=> 100,
						 	'div'		=> false,
						)
            		);  
?> 
				</div>
			</td>
            <td>
            	<div class="form-group">
<?php 
            		echo $this->Form->input('issue_date',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control my_date',
						 	'label'		=> 'Issue Date',
						 	'required'	=> true,
						 	'readonly'	=> true,
						 	'value'		=> $default_date,
						 	'autoComplete'=> 'off',
						 	'div'		=> false,
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
            		echo $this->Form->input('Phadi_name',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> 'Name of Phadi or Binding Center',
						 	'autoComplete'=> 'off',
						 	'div'		=> false,
						 	'maxlength'	=> 250,
						)
            		);  
?> 
				</div>
            </td>
            <td colspan="2">
            	<div class="form-group"> 
<?php 
	            	echo $this->Form->input('attach_file.',
	            		array(
	            			'type'		=> 'file',
						 	'class'		=> 'form-control',
						 	'label'		=> 'Upload Attachment',
						 	'multiple'	=> true,
						 	'required'	=> false,
						 	'div'		=> false,
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
							<th align="center">Means of Transport</th>
							<th align="center">Name of the Driver/Carter</th>
							<th align="center" colspan="2">Quantity of processed/Phal Kendu Leaves bags</th>
						</tr>
						<tr>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers6detail.0.means_transport',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									 	'maxlength'	=> 255,
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers6detail.0.driver_name',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'required'	=> true,
									 	'autoComplete'=> 'off',
									 	'maxlength'	=> 255,
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers6detail.0.quantity_processed',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control mobile',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'autoComplete'=> 'off',
									 	'maxlength'	=> 10,
									)
			            		);  
?> 								
							</td>
							<td>
<?php 
			            		echo $this->Form->input('Vouchers6detail.0.kendu_leaves_bags',
			            			array(
			            				'type'		=> 'text',
			            				'class'		=> 'form-control mobile',
									 	'label'		=> false,
									 	'div'		=> false,
									 	'autoComplete'=> 'off',
									 	'maxlength'	=> 10,
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
	if($('#vouchers6_id').val() != ''){
		showDetails();
	}
});
function showDetails(){
	if($('#vouchers6_id').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers6','action'=>'voucher6Details'))?>";
		$.post(url,{id:$('#vouchers6_id').val()},function(res){ 
			$('#listingDiv').html(res);
		});		
	}
}
function deleteDetail(id){
	if(id != ''){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers6','action'=>'voucher6DetailsDelete'))?>";
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