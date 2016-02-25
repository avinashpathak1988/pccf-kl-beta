<?php
if(isset($this->data['Allocation']['allocation_date']) && $this->data['Allocation']['allocation_date'] != ''){
	$this->request->data['Allocation']['allocation_date'] = $funcall->DB2date($this->data['Allocation']['allocation_date']);
}
?>
<div class="box-body">
<?php echo $this->Form->create('Allocation',array('method'=>'POST','type'=>'file'));?> 
<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'hiddenId'));	?>	
<?php echo $this->Form->input('assign_by',array('type'=>'hidden','id'=>'assign_by','value'=>$userid));	?>
<?php echo $this->Form->input('usertype_id',array('type'=>'hidden','id'=>'usertype_id','value'=>$userTypeId));	?>
<?php echo $this->Form->input('to_usertype_id',array('type'=>'hidden','id'=>'to_usertype_id','value'=>$to_usertype_id));	?>	
<?php echo $this->Form->input('fyear',array('type'=>'hidden','id'=>'fyear','value'=>$fyear_id)); ?>
	<table class="table table-bordered">
		<tr>
			<td>
				<div class='form-group'>
					<label for="fyear">Financial Year</label><br />
					<?php echo $fyear?>
				</div>
			</td>
			<td>
				<div class='form-group'>
					<?php echo $this->Form->input('assign_to',array('label'=>'Assign To','options'=>$userList,'empty'=>'--Select--','id' =>'assign_to','class'=>'form-control','div'=>false,'required'	=> true));?>
				</div>
			</td>
			<td>
				<div class='form-group'>
					<?php echo $this->Form->input('attachment', array('type'=>'file','label'=>'Attachment','div'=>false,'class'=>'form-control'));?>
				</div>
			</td>						
		</tr>
		<tr>
			<td>
				<div class='form-group'>
					<?php echo $this->Form->input('allocation_date',array('type'=>'text','class'=>'form-control my_date','label'=>'Allocation Date','readonly'=>true,'required'	=> true));?>
				</div>
			</td>
			<td>
				<div class='form-group'>
					<?php echo $this->Form->input('memo_no',array('type'=>'text','label'=>'Memo No.','class'=>'form-control','div'=>false));?>
				</div>
			</td>
			<td>
				<div class='form-group'>
					<?php echo $this->Form->input('remark',array('type'=>'textarea','div' => false,'Label'=>'Remark','cols'=>30,'rows'=>1));?>
				</div>
			</td>						
		</tr>
<?php
if(isset($userTypeId) && (int)$userTypeId == Configure::read('DFOUSERTTYPE')){
?>		
		<tr>
			<td colspan="3">
				<div>
					<div style="float:left;font-weight:bold;">Account Balance &nbsp;: &nbsp;</div>
					<a href="javascript:void(0);" onclick="javascript:schemeDetails();">
						<div style="font-weight:bold;" id="schemeValId">0</div>
					</a>
				</div>
			</td>
		</tr>
<?php
	}
?>		
		<tr>
			<td colspan="3">
				<div>
					<table class="table table-bordered" width="100%">
						<thead>
							<tr>
								<th width="20%">Head of Account</th>
								<th width="20%">Sub Account</th>
								<th width="20%">Details</th>
<?php
	if(isset($userTypeId) && (int)$userTypeId == Configure::read('DFOUSERTTYPE')){
?>								
								<th width="20%">Balance</th>
<?php
	}
?>								
								<th width="20%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php echo $this->Form->input('AllocationDetail.0.account_id',array('label'=>false,'div'=>false,'options'=>$accountList,'empty'=>'--Select--','id' =>'account_id','class'=>'form-control subAllocation','required'	=> true));?>
								</td>
								<td id="showSubAcc">
									<?php echo $this->Form->input('AllocationDetail.0.sub_account_id',array('label'=>false,'div'=>false,'options'=>$subAccountList,'empty'=>'--Select--','id' =>'sub_account_id','class'=>'form-control subAllocation','required'	=> true,'onchange'=>'javascript: subheadTotalBal();'));?>
								</td>
								<td>
									<?php  echo $this->Form->input('AllocationDetail.0.detail',array('label'=>false,'div'=>false,'type'=>'textarea','cols'=>15,'rows' => 2,'class'=>'text-input subAllocation','id' =>'detail')); ?>
								</td>
<?php
	if(isset($userTypeId) && (int)$userTypeId == Configure::read('DFOUSERTTYPE')){
?>										
								<td nowrap><div id="balance">0</div></td>
<?php
	}
?>								
								<td>
									<?php echo $this->Form->input('AllocationDetail.0.amount',array('label'=>false,'div'=>false,'type'=>'text','class'=>'form-control subAllocation numeric','id' =>'amount','required'	=> true,'size'=>10,'maxlength'=>10)); ?>
								</td>																							
							</tr>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'bt btn-success','div'=>false,'label'=>false,'onclick'=>'javascript:return validateFrm();'));?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div id="listingDiv"></div>
			</td>
		</tr>		
	</table>
<?php echo $this->Form->end();?>
</div>
<script>
$(document).ready(function(){
	$("#account_id").change(function(){
		subAccount();
	});
	if($('#hiddenId').val() != ''){
		showFundData();
	}
	$('.subAllocation').val('');
	fyearBalance();
	subAccount();
});
function schemeDetails(){
    if($('#schemeValId').text() != 0 && $('#scheme_id').val() != ''){
    	var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'schemeDetails'))?>";
        $.colorbox({ width:"70%", height:"90%", iframe:true,rel:'images', transition:"fade",href:url+"/"+$('#scheme_id').val() });
    }	
}
function fyearBalance(){
	var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'fyearBalance'))?>";
	$.post(url,{fyear:$('#fyear').val()},function(res){
		if(res){
			$('#schemeValId').html(res);
			subheadTotalBal();
		}
	});		
}
function subAccount(){
	var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'subAccount'))?>";
	$.post(url,{id:$("#account_id").val()},function(res){
		if(res){
			$('#showSubAcc').html(res);
			subheadTotalBal();
		}
	});	
}
function subheadTotalBal(){
	if($("#account_id").val() != '' && $("#sub_account_id").val() != '' && $("#fyear").val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'getFundAmount'))?>";
		$.post(url,{fyear:$("#fyear").val(),account_id:$("#account_id").val(),sub_account_id:$("#sub_account_id").val()},function(res){
			if(res){
				$('#balance').html(res);
			}
		});	
	}else{
		$('#balance').html(0);
	}
}
function showFundData(){
	if($('#hiddenId').val() != ''){
		var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'fundAjaxList'))?>";
		$.post(url,{id:$("#hiddenId").val(),'ref':'F'},function(res){
			if(res){
				$('#listingDiv').html(res);
			}
		});
	}
}
function deleteAllocationDetail(DetailId){
	if(DetailId){
		if(confirm('Are you sure to delete?')){
			var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'fundAjaxDelete'))?>";
			$.post(url,{id:DetailId},function(res){
				if(res == 'SUCC'){
					$('#tr'+DetailId).hide('slow');
					showFundData();
					$('.subAllocation').val('');
					schemeBalance();
					subAccount();					
				}
			});
		}		
	}
}
function validateFrm(){
	var userTypeId = <?php echo Configure::read('DFOUSERTTYPE')?>;
	if($('#usertype_id').val() != '' && $('#usertype_id').val() == userTypeId){
		if($('#amount').val() != ''){
			if($('#balance').text() != ''){
				if(parseFloat($('#amount').val()) <= parseFloat($('#balance').text())){
					$('#amount').css('background-color', '#fff');
					return true;
				}else{
					$('#amount').css('background-color', '#FC9F9F');
					return false;
				}
			}else{
				$('#amount').css('background-color', '#FC9F9F');
				return false;
			}
		}else{
			$('#amount').css('background-color', '#FC9F9F');
			return false;
		}
	}else{
		return true;
	}
}
</script>