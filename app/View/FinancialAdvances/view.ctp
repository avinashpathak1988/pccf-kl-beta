<?php 
if(is_array($financial_advance) && count($financial_advance)>0){
?>
<div style="position:absolute;right:10px;top:5px;">
<?php
	if($usertype_id != Configure::read('PCCFUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Financial Advance',array('controller'=>'FinancialAdvances','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success btn-sm'))?>&nbsp;&nbsp;
<?php

	}
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Financial Advance',array('controller'=>'FinancialAdvances','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
	<table class="table table-bordered">
		<tr>
			<th>
				<div class="form-group"><?php echo "Financial Year:"  ?> </div>
			</th>
			<td>
				<div class="form-group"><?php echo $financial_advance['Financialyear']['title'];  ?> </div>
			</td>
			<th>
				<div class="form-group"><?php echo "Account Type:"  ?> </div>
			</th>
			<td>
				<div class="form-group"><?php echo $financial_advance['Account']['title'];  ?> </div>
			</td>
		</tr>
		<tr>			
			<th>
				<div class="form-group"><?php echo "From: ";  ?> </div>
			</th>
			<td>
				<div class="form-group">
					<?php 
	                    if($financial_advance['FinancialAdvance']['from_usertype_id'] == Configure::read('DFOUSERTTYPE')){
	                        echo $funcall->getDfoName($financial_advance['FinancialAdvance']['from_user_id']);
	                    }
	                    if($financial_advance['FinancialAdvance']['from_usertype_id'] == Configure::read('PCCFUSERTTYPE')){
	                        echo $funcall->getPccfName($financial_advance['FinancialAdvance']['from_user_id']);
	                    }
	                 ?>
				 </div>
			</td>			
			<th>
				<div class="form-group"><?php echo "To: ";  ?> </div>
			</th>
			<td>
				<div class="form-group">
					<?php 
	                    if($financial_advance['FinancialAdvance']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
	                        echo $funcall->getDfoName($financial_advance['FinancialAdvance']['created_by']);
	                    }
	                    if($financial_advance['FinancialAdvance']['usertype_id'] == Configure::read('ROUSERTTYPE')){
	                        echo $funcall->getRoName($financial_advance['FinancialAdvance']['created_by']);
	                    }
	                 ?>
				 </div>
			</td>
		</tr>
		<tr>
			<th>
				<div class="form-group"><?php echo "Advance Date: ";  ?> </div>
			</th>
			<td>
				<div class="form-group"><?php echo $funcall->DB2date($financial_advance['FinancialAdvance']['fa_date']);  ?> </div>
			</td>
			<th>
				<div class="form-group"><?php echo "Amount:"  ?> </div>
			</th>
			<td>
				<div class="form-group"><?php echo $this->Money->india($financial_advance['FinancialAdvance']['amount']);  ?> </div>
			</td>			
		</tr>
		<tr>
			<th>
				<div class="form-group"><?php echo "Attachments: ";  ?> </div>
			</th>
			<td>
				<div class="form-group">
					<?php 
					if($financial_advance['FinancialAdvance']['attach_file']!=''){
						$cnt = 1;
					    foreach (explode(",", $financial_advance['FinancialAdvance']['attach_file']) as $key => $value) {
					    	?>
					    	<div class="pull-left">
					    	<?php
					    	echo "Attachment ".$cnt;
					    	?>
					    	</div>
					    	<div class="pull-left">
					    	<?php
					        echo $this->Form->create('Download',array('url'=>'/vouchers2b/download')); 
					        echo $this->Form->input('file_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$value));
					        echo $this->Form->input('folder_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>'V'));
					        echo $this->Form->end(array('label'=>" Attachment ".$cnt,'class'=>'btn btn-success btn-sm','div'=>false,'escape'=>false));						          
					        ?>
					        </div>
					        <div class="pull-left">
					        <?php 
					         echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i> View ',"javascript:;",array('escape'=>false,'class'=>'btn btn-success btn-sm',"onclick"=>"showImage('".$funcall->base."/files/voucher/".$value."')"));
					         ?>
					         </div>
					         <?php
					        $cnt++;                 
					    }
					}
					?>					
				</div>
			</td>
			<th>
				<div class="form-group"><?php echo "Remarks:"  ?> </div>
			</th>
			<td>
				<div class="form-group"><?php echo $financial_advance['FinancialAdvance']['remarks'];  ?> </div>
			</td>
		</tr>
	</table>
	<img src="" id="image" style="display: none;" />
</div>	
<?php  
}
?>
<script>
	function printfunc(){
		var printContents = document.getElementById("print_div").innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}	

	function showImage(value){
		$("#image").show();
		$("#image").attr("src",value);
	}
</script>