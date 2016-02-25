<?php
    if(isset($this->request->data['FinancialAdvances']['fa_date']) && $this->request->data['FinancialAdvances']['fa_date'] != ''){
        $this->request->data['FinancialAdvances']['fa_date'] = $funcall->DB2date($this->request->data['FinancialAdvances']['fa_date']);
    }
    if($usertype_id == Configure::read('ROUSERTTYPE') || $usertype_id == Configure::read('DFOUSERTTYPE')){
?> 
<div style="position:absolute;right:10px;top:5px;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage FA',array('controller'=>'FinancialAdvances','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>
</div>
<?php
	}
?>
<div class="box-body">
	<div>
		<?php echo $this->Form->create('FinancialAdvance',array('type'=>'file'));  ?>
		<?php echo $this->Form->input('id',array('type'=>'hidden','id'=>'hidden_id'))?>	
		<?php echo $this->Form->input('from_usertype_id',array('type'=>'hidden','id'=>'from_usertype_id','value'=>$fromUserDetails['from_usertype_id']))?>
		<?php echo $this->Form->input('from_user_id',array('type'=>'hidden','id'=>'from_user_id','value'=>$fromUserDetails['from_user_id']))?>
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
					<?php echo $this->Form->input('fa_date',array('class'=>'form-control my_date','id'=>'fa_date','label'=>'Advance Receipt Date','required'=>true,'type'=>'text','value'=>$default_date,'readonly'=>true));  ?>
				</td>
				<td>
<?php
					if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
					<div class="form-group" style="width:48%;float: left;"> 
						<?php echo $this->Form->input('dfobalance',array('type'=>'hidden','class'=>'form-control','label'=>false,'maxlength'=>15,'id'=>"dfoBalance",'value'=>$dfoBalance));  ?> 
						<?php echo $this->Form->input('balance',array('class'=>'form-control','label'=>'DFO Balance','maxlength'=>15,'id'=>"dfoRemBalance",'readonly'=>true,'value'=>$dfoBalance));  ?> 
					</div>
<?php
					}
?>
					<div class="form-group" <?php echo ($usertype_id == Configure::read('ROUSERTTYPE')) ? "style='width:48%;float: left'" :""; ?>> 
						<?php echo $this->Form->input('amount',array('class'=>'form-control numeric','label'=>'Amount','required'=>true,'maxlength'=>15,'onkeyup'=>"checkBlance(this.value)",'id'=>'balance_amount'));  ?> 
					</div>
				</td>			
			</tr>
			<tr>	
				<td>
					<?php echo $this->Form->input('attach_file.',array('class'=>'form-control','label'=>'Upload Attachments','type'=>'file','multiple'=> true,'required'=>false));  ?> 	
					<small>(pdf, doc, excel)</small>
				</td>
				<td>
					<div class="form-group"> 
						<?php echo $this->Form->input('remarks', array( 'type' => 'textarea', 'cols' => 15, 'rows' => 3, 'class' => 'form-control', 'label'		=> "Remarks", 'div'		=> false, 'size' => 10, ));    ?> 
					</div>
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
<script type="text/javascript">
function checkBlance(balance){
	if($('#dfoBalance').val()!='' || $('#dfoBalance').val() !='undefiend'){
		var dfoBalance = parseInt($('#dfoBalance').val());
		var userAmount = parseInt(balance);
		var dfoRemBalance = 0;
		if(dfoBalance < balance){
			alert('Dfo have not balance, Please contact dfo');
			$("#balance_amount").val(0);
			$("#dfoRemBalance").val(dfoBalance);
		}else{			
			var dfoRemBalance = dfoBalance - balance; 
			$('#dfoRemBalance').val(dfoRemBalance);
		}		
	}
}
</script>