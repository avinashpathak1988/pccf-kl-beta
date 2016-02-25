<?php    
    if(isset($this->data['Purchase']['edate']) && $this->data['Purchase']['edate'] != ''){
        $this->request->data['Purchase']['edate'] = $funcall->DB2date($this->data['Purchase']['edate']);
    }
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Purchase KL',array('controller'=>'Purchases','action'=>'index'),array('escape'=>false))?>
</div>
<?php
	}    
?>            
<div class="box-body">
	<div>
  		<?php echo $this->Form->create('Purchase',array('type'=>'file'));  ?>
		<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'hidden_id'))?>
		<?php echo $this->Form->input('ro_id',array('type'=>'hidden','value'=>$ro_id)); ?> 
		<?php echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user_id)); ?>
		<?php echo $this->Form->input('financialyear_id',array('type'=>'hidden','value'=>$financialyear_id)); ?> 
		<?php echo $this->Form->input('account_id',array('type'=>'hidden','value'=>$account_id)); ?>		
    	<table class="table table-bordered">
            <tr>
	            <td width="227" align="left" valign="top">
	              	<div class="form-group"> 
	              		<?php echo $this->Form->input('book_number',array('class'=>'form-control',)); ?> 
	              	</div>
	            </td>
              	<td width="286" align="left" valign="top">
	              	<div class="form-group"> 
	              		<?php echo $this->Form->input('page',array('class'=>'form-control','label'=>'Page Number',)); ?> 
					</div>
				</td>
              	<td width="271" align="left" valign="top">
              		<div class="form-group"> 
              			<?php echo $this->Form->input('code',array('class'=>'form-control','label'=>'Code',)); ?> 
					</div>
				</td>
            </tr>
			<tr>
				<td align="left" valign="top">
					<div class="form-group"> 
						<?php echo $this->Form->input('fadi_name',array('class'=>'form-control','label'=>'Fadi\'s Name',)); ?> 
					</div>
				</td>
				<td align="left" valign="top">
					<div class="form-group"> 
						<?php echo $this->Form->input('edate',array('class'=>'form-control my_date','label'=>'Entry Date','type'=>'text','placeholder'=>'dd-mm-yyyy','value'=>date('d-m-Y'),'readonly'=>true)); ?> 
					</div>
				</td>
				<td align="left" valign="top">
					<div class="form-group"> 
						<?php echo $this->Form->input('unit_number',array('class'=>'form-control','label'=>'Unit Number',)); ?> 
					</div>
				</td>
			</tr>
            <tr>
              	<td align="left" valign="top">
	              	<div class="form-group"> 
	              		<?php echo $this->Form->input('entered_by',array('class'=>'form-control','label'=>'Entered By',)); ?> 
					</div>
				</td>
              	<td align="left" valign="top">
              		<div class="form-group"> 
              			<?php echo $this->Form->input('verified_by',array('class'=>'form-control','label'=>'Verified By')); ?> 
					</div>
				</td>
              	<td align="left" valign="top">
	              	<div class="form-group"> 
		              	<?php echo $this->Form->input('attach_file.',array('type'=>'file','label'=>'Add Attachment','div'=>false,'multiple'=>true,'required'=>false))?>
					</div>
				</td>				
            </tr>
            <tr>
                <td colspan="3" align="left" valign="top">
                	<table class="table table-bordered">
	                    <tr>
							<th>Collector's Name </th>
							<th>Card Number </th>
							<th>Quantity</th>
							<th>Unit Price </th>
							<th>Total Price </th>
	                    </tr>
						<tr>
							<td>
								<div class="form-group"> 
									<?php echo $this->Form->input('Purchasedetail.0.worker_id',array('class'=>'form-control','label'=>false,'options'=>$workers,'empty'=>'--Select Collector--','onChange'=>'showCard(this.value)')); ?> 
								</div>
							</td>
							<td>
								<div class="form-group"> 
									<?php echo $this->Form->input('Purchasedetail.0.card_number',array('type'=>'text','id'=>'card_number','class'=>'form-control','label'=>false,'readonly'=>true)); ?> 
								</div>
							</td>
							<td>
								<div class="form-group"> 
									<?php echo $this->Form->input('Purchasedetail.0.quantity',array('type'=>'text','id'=>'quantity','class'=>'form-control numeric','maxlength'=>8,'label'=>false,'onKeyup'=>'calctotal()')); ?> 
								</div>
							</td>
							<td>
								<div class="form-group"> 
									<?php echo $this->Form->input('Purchasedetail.0.unit_price',array('id'=>'unit_price','class'=>'form-control numeric','step'=>'any','type'=>'text','label'=>false,'onKeyup'=>'calctotal()')); ?> 
								</div>
							</td>
							<td>
								<div class="form-group"> 
									<?php echo $this->Form->input('Purchasedetail.0.amount',array('type'=>'text','id'=>'amount','class'=>'form-control','step'=>'any','label'=>false,'readonly'=>true)); ?> 
								</div>
							</td>
						</tr>
                  	</table> 
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center" valign="top">
                  	<div class="form-group"> 
						<?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-success','div'=>false))?>
					</div>
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
	if($('#hidden_id').val() != ''){
		showDetails();
	}
});
function showDetails(){
	if($('#hidden_id').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'purchaseDetails'))?>";
		$.post(url,{id:$('#hidden_id').val()},function(res){ 
			$('#listingDiv').html(res);
		});		
	}
}
function showCard(str){
	if(str != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Workers','action'=>'fetchcard'))?>";
		url = url+'/'+str;
		$.get(url, function(data, status){
			$('#card_number').val(data);
		});
	}else{
		$('#card_number').val('');
	}
}
function calctotal(){
	var amount = 0;
	var quantity = 0;
	var unit_price = 0;
	if($('#quantity').val() != ''){
	 	quantity = $('#quantity').val();
	}
	if($('#unit_price').val() != ''){
	 	unit_price = $('#unit_price').val();
	}
	amount = parseFloat(quantity) * parseFloat(unit_price);
	if(amount != 0){SUCC
		$('#amount').val(amount.toFixed(2));
	}else{
		$('#amount').val('');
	}
}
function deleteDetail(detailId){
	if(detailId){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'deleteitem'))?>";
			$.post(url,{id:detailId},function(res){ 
				if(res.trim() == 'SUCC'){
					showDetails();
				}
			});		
		}
	}	
}
</script>
		        