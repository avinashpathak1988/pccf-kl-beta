<?php
    if(isset($this->request->data['Vouchersfa']['voucher_date']) && $this->request->data['Vouchersfa']['voucher_date'] != ''){
        $this->request->data['Vouchersfa']['voucher_date'] = $funcall->DB2date($this->request->data['Vouchersfa']['voucher_date']);
    }
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="position:absolute;right:10px;top:5px;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher Fa',array('controller'=>'Vouchersfas','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>
</div>
<?php
	}
?>
<div class="box-body">
	<div>
		<?php echo $this->Form->create('Vouchersfa',array('type'=>'file'));  ?>
		<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'hidden_id'))?>	
		<div class="form-group"><?php echo "Financial Year: ".$fyear;  ?> </div>
		<table class="table table-bordered">
			<tr>
				<td>
					<div class="form-group"> 
						<?php echo $this->Form->input('account_id',array('class'=>'form-control','label'=>'Head Of Service','options'=>$account_id,'default'=>$this->Session->read('hos'),));  ?>
					</div>
				</td>
				<td>
					<div class="form-group"> 
						<?php echo $this->Form->input('voucher_number',array('class'=>'form-control','label'=>'Voucher Number','required'=>true,'maxlength'=>15));  ?> 
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $this->Form->input('voucher_date',array('class'=>'form-control my_date','id'=>'voucher_date','label'=>'Voucher Date','required'=>true,'type'=>'text','value'=>$default_date));  ?>
				</td>
				<td>
					<?php echo $this->Form->input('attach_file.',array('class'=>'form-control','label'=>'Upload Attachments','type'=>'file','multiple'=> true,'required'=>false));  ?> 				
				</td>
			</tr>
		</table>
		<table class="table table-bordered">
			<tr>
				<th>Purpose</th>
				<th>Particulars</th>
				<th>Qty.</th>
				<th>Amount</th>
			</tr>
			<tr>
				<td align="left" valign="top">
					<?php echo $this->Form->input('Vouchersfasdetail.0.purpose',array('type'=>'textarea','class'=>'form-control','div'=>false,'label'=>false,'cols'=>15,'rows'=>3,'required'=>true));  ?>
				</td>
				<td align="left" valign="top">
					<?php echo $this->Form->input('Vouchersfasdetail.0.particular',array('class'=>'form-control','div'=>false,'type'=>'textarea','rows'=>3,'cols'	=> 15,'label'=>false));  ?>
				</td>
				<td align="left" valign="top">
					<?php echo $this->Form->input('Vouchersfasdetail.0.quantity',array('type'=>'text','class'=>'form-control numeric','label'=>false,'maxlength'=>10,'required'=>true));  ?>
				</td>
				<td align="left" valign="top">
					<?php echo $this->Form->input('Vouchersfasdetail.0.amount',array('type'=>'text','class'=>'form-control numeric','label'=>false,'maxlength'=>10,'required'=>true));  ?>
				</td>
			</tr>
		</table>
		<div class="text-center"> 
			<?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-success'));  ?> 
		</div>
		<?php echo $this->Form->end();?>
	</div>
	<div id="listingDiv">

	</div>
</div>
<script>
$(document).ready(function(){
	if($('#hidden_id').val() != ''){
		showDetails();
	}
});
function showDetails(){
	if($('#hidden_id').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Vouchersfas','action'=>'vouchersfaDetails'))?>";
		$.post(url,{id:$('#hidden_id').val()},function(res){ 
			$('#listingDiv').html(res);
		});		
	}
}
function deleteDetail(id){
	if(id != ''){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Vouchersfas','action'=>'vouchersfaDetailsDelete'))?>";
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