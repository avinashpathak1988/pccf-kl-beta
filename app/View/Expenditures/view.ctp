<?php 
if(is_array($voucher) && count($voucher)>0){
?>
<div style="position:absolute;right:10px;top:5px;">
<?php
	if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Expenditure',array('controller'=>'Expenditures','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success btn-sm'))?>&nbsp;&nbsp;
<?php
	}
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Expenditure',array('controller'=>'Expenditures','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
	<table class="table table-bordered">
		<tr>
			<td><strong>Financial Year :</strong></td>
			<td><?php echo $voucher['Financialyear']['title']; ?></td>
    		<td><strong>Account Type :</strong></td>
	    	<td><?php echo $voucher['Account']['title'];	?></td>			
		</tr>
		<tr>
			<td><strong>Voucher Number :</strong></td>
			<td><?php echo $voucher['Expenditure']['voucher_no']; ?></td>
			<td><strong>Voucher Date :</strong></td>
			<td><?php echo $funcall->DB2date($voucher['Expenditure']['voucher_date']); ?></td>
		</tr>
		<tr>
			<td><strong>Head of Service :</strong></td>
			<td><?php echo $funcall->getHOSName($voucher['Expenditure']['hos_id']); ?></td>
			<td><strong>Entry Date :</strong></td>
			<td><?php echo $funcall->DB2date($voucher['Expenditure']['entry_date']); ?></td>
		</tr>
		<tr>
			<td><strong>Amount :</strong></td>
			<td><?php echo $voucher['Expenditure']['amount']; ?></td>
			<td><strong>Remarks :</strong></td>
			<td><?php echo ($voucher['Expenditure']['remarks'] != '')?$voucher['Expenditure']['remarks']:'NA'; ?></td>
		</tr>
	    <tr>
	    	<td><strong>Entered By :</strong></td>
	    	<td><?php echo $funcall->getUserIdRoName($voucher['Expenditure']['user_id'])?></td>
    		
    		<td colspan="2">
<?php
	if($voucher['Expenditure']['attach_file'] != ''){
		$fileArr = explode(',',$voucher['Expenditure']['attach_file']);
		if(is_array($fileArr) && count($fileArr)>0){
			foreach($fileArr as $fileKey=>$fileVal){
?>
			<div style="float:left;margin-right:5px;">
<?php				
	            echo $this->Form->create('Download',array('url'=>'/vouchers2b/download')); 
	            echo $this->Form->input('file_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$fileVal));
	            echo $this->Form->input('folder_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>'V'));
	            echo $this->Form->end(array('label'=>'Download','class'=>'btn btn-transparent','div'=>false));
?>
			</div>
<?php        	
        	}
        }
    }
?>    			
    		</td>		    			
	    </tr>
	    <tr>
	    	<td><strong>Accountant Remarks :</strong></td>
	    	<td colspan="3"><?php echo ($voucher['Expenditure']['acc_remarks'] != '')?$voucher['Expenditure']['acc_remarks']:'NA'?></td>
	    </tr>
	    <tr>
	    	<td colspan="4">
<?php
	if($voucher['Expenditure']['is_approved_dfo'] == 'Y'){
?>
                <span style="color:green;font-weight:bold;">
                    Expenditure was approved on <?php echo h($funcall->DB2date($voucher['Expenditure']['approved_dfo_date']))?> by 
                    <?php echo h($funcall->getDfoName($voucher['Expenditure']['action_dfo_by']))?>.
                </span>
<?php
	}else if($voucher['Expenditure']['is_rejected_dfo'] == 'Y'){
?>
                <span style="color:red;font-weight:bold;">
                    Expenditure was rejected on <?php echo h($funcall->DB2date($voucher['Expenditure']['rejected_dfo_date']))?> by 
                    <?php echo h($funcall->getDfoName($voucher['Expenditure']['action_dfo_by']))?>.
                </span>
<?php
	}else{
?>
                <span style="color:red;font-weight:bold;">
                    Expenditure was pending.
                </span>
<?php
	}
?>
	    	</td>
	    </tr>
	</table>
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
</script>