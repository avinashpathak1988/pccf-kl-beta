<div class="box-body">
<?php echo $this->Form->create('Vouchers10Report', array('type' => 'file')); ?>
<?php echo $this->Form->input('vouchers10_id',array('type'=>'hidden','id'=>'vouchers10_id','value'=>$id)); ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name of Coolies</th>
				<th>Residence</th>
				<th>Total No. of days</th>
				<th>Rate</th>
				<th>Amount Due</th>
				<th>Net Amount Paid</th>
				<th>Remarks</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
<?php 
            		echo $this->Form->input('coolie_name',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 255,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('residence',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'maxlength'	=> 255,	 
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						)
            		);  
?> 			
				</td>				
				<td>
<?php 
            		echo $this->Form->input('days_no',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control mobile',
						 	'label'		=> false,	
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 		
				</td>
				<td>
<?php 
            		echo $this->Form->input('rate',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric',
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
            		echo $this->Form->input('amount_due',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric',
						 	'label'		=> false,
						 	'div'		=> false,
						 	'autoComplete'=> 'off',
						 	'required'	=> true,
						 	'size'		=> 10,	
						 	'maxlength'	=> 10,	 
						)
            		);  
?> 				
				</td>
				<td>
<?php 
            		echo $this->Form->input('net_amount_paid',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control numeric',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off', 
						 	'required'	=> true,
						 	'size'		=> 10,
						 	'maxlength'	=> 10,
						)
            		);  
?> 				
				</td>	
				<td>
<?php 
            		echo $this->Form->input('remarks',
            			array(
            				'type'		=> 'text',
            				'class'		=> 'form-control',
						 	'label'		=> false,	
						 	'div'		=> false,	
						 	'autoComplete'=> 'off',
						 	'size'		=> 10,
						)
            		);  
?> 									
				</td>		
			</tr>
			
	        <tr>
				<td colspan="7" align="center">
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
<div id="listingDiv">

</div>
<script>
$(document).ready(function(){
	if($('#vouchers10_id').val() != ''){
		showReports();
	}
});
function showReports(){
	var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers10','action'=>'voucher10ReportDetails'))?>";
	$.post(url,{vouchers10_id:$('#vouchers10_id').val()},function(res){ 
		$('#listingDiv').html(res);
	});		
}
function deleteReportDetail(reportId){
	if(reportId){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Vouchers10','action'=>'voucher10ReportDelete'))?>";
			$.post(url,{id:reportId},function(res){ 
				if(res == 'SUCC'){
					$('#tr'+reportId).hide();
					$('#tr'+reportId).remove();
				}
			});	
		}
	}
}
</script>