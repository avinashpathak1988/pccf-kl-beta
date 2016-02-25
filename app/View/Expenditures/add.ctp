<?php
	if(isset($this->data['Expenditure']['entry_date']) && $this->data['Expenditure']['entry_date'] != ''){
		$this->request->data['Expenditure']['entry_date'] = $funcall->DB2date($this->data['Expenditure']['entry_date']);
	}
	if(isset($this->data['Expenditure']['voucher_date']) && $this->data['Expenditure']['voucher_date'] != ''){
		$this->request->data['Expenditure']['voucher_date'] = $funcall->DB2date($this->data['Expenditure']['voucher_date']);
	} 
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="position:absolute;right:10px;top:5px;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Expenditure',array('controller'=>'Expenditures','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>
</div>
<?php
	}
?>
<div class="box-body">
	<div>
		<?php echo $this->Form->create('Expenditure',array('type'=>'file'));  ?>
		<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'hidden_id'))?>
		<?php echo $this->Form->input('fyear',array('type'=>'hidden','id'=>'fyear','value'=>$fyear))?>
		<?php echo $this->Form->input('account_id',array('type'=>'hidden','id'=>'account_id','value'=>$account_id))?>
		<?php echo $this->Form->input('user_id',array('type'=>'hidden','id'=>'user_id','value'=>$user_id))?>
		<?php echo $this->Form->input('usertype_id',array('type'=>'hidden','id'=>'usertype_id','value'=>$usertype_id))?>
		<?php echo $this->Form->input('created_by',array('type'=>'hidden','id'=>'created_by','value'=>$created_by))?>		
		<table class="table table-bordered">
			<tr>
				<td>
					<div class="form-group"> 
						<label for="VouchersfaAccountId">Financial Year :</label><br />
						<strong><?php echo h($financialYear)?></strong>
					</div>
				</td>
				<td>
					<div class="form-group"> 
						<label for="VouchersfaAccountId">Account Type :</label><br />
						<strong><?php echo h($account)?></strong> 
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('hos_id',array('class'=>'form-control','id'=>'hos_id','label'=>'Head of Service','required'=>true,'type'=>'select','options'=>$hosList,'empty'=>'--Select--'));  ?>
					</div>
				</td>
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('entry_date',array('class'=>'form-control my_date','id'=>'entry_date','label'=>'Entry Date','required'=>true,'type'=>'text','value'=>$default_date,'readonly'=>true));  ?>
					</div>
				</td>				
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('voucher_no',array('class'=>'form-control','id'=>'voucher_no','label'=>'Voucher No.','required'=>true,'type'=>'text','maxlength'=>20));  ?>
					</div>
				</td>			
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('voucher_date',array('class'=>'form-control my_date','id'=>'voucher_date','label'=>'Voucher Date','required'=>true,'type'=>'text','value'=>$default_date,'readonly'=>true));  ?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('amount',array('class'=>'form-control numeric','label'=>'Amount','type'=>'text','maxlength'=> 10,'required'=>true));  ?> 
					</div>				
				</td>			
				<td>
					<div class="form-group">
						<?php echo $this->Form->input('attach_file.',array('class'=>'form-control','label'=>'Upload Attachments(Voucher)','type'=>'file','multiple'=> true,'required'=>false));  ?> 
						<span style="font-size:9px;">(Please upload only jpg,jpeg,png,pdf files)</span>
					</div>				
				</td>				
			</tr>
			<tr>
				<td colspan="2">
					<div class="form-group">
						<?php echo $this->Form->input('remarks',array('class'=>'form-control','label'=>'Particulars/Remarks','type'=>'textarea','required'=>false));  ?> 
					</div>					
				</td>
			</tr>
		</table>
		<div class="text-center"> 
			<?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-success'));  ?> 
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>