<?php 
if(is_array($voucher) && count($voucher)>0){
?>
<div style="position:absolute;right:10px;top:5px;">
<?php
	if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Voucher Fa',array('controller'=>'Vouchersfas','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success btn-sm'))?>&nbsp;&nbsp;
<?php
	}
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher Fa',array('controller'=>'Vouchersfas','action'=>'index'),array('escape'=>false,'class'=>'btn btn-primary btn-sm'))?>&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
	<table class="table table-bordered">
		<tr>
			<td><strong>Voucher Number :</strong></td>
			<td><?php echo $voucher['Vouchersfa']['voucher_number']; ?></td>
			<td><strong>Voucher Date :</strong></td>
			<td><?php echo $funcall->DB2date($voucher['Vouchersfa']['voucher_date']); ?></td>
			<td><strong>Financial Year :</strong></td>
			<td><?php echo $voucher['Financialyear']['title']; ?></td>
		</tr>
	    <tr>
    		<td><strong>Head Of Service :</strong></td>
	    	<td><?php echo $voucher['Account']['title'];	?></td>
	    	<td><strong>Entered By :</strong></td>
	    	<td><?php echo $funcall->getUserIdRoName($voucher['Vouchersfa']['user_id'])?></td>
    		
    		<td colspan="2">
<?php
	if($voucher['Vouchersfa']['attach_file'] != ''){
		$fileArr = explode(',',$voucher['Vouchersfa']['attach_file']);
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
	    	<td colspan="6" align="center"><hr></td>
   		</tr>
	    <tr>
	    	<td colspan="6">
<?php
	if(is_array($voucher['Vouchersfasdetail']) && count($voucher['Vouchersfasdetail'])>0){
?>				
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Purpose</th>
						<th>Particulars</th>
						<th>Qty.</th>
						<th>Amount</th>			
					</tr>		
				</thead>
				<tbody>
<?php
	$cnt = 0;
	$qtySum = array();
	$amountSum = array();
	foreach($voucher['Vouchersfasdetail'] as $detailKey=>$detailVal){
		$cnt++;
		if($detailVal['quantity'] != ''){
			$qtySum[] = $detailVal['quantity'];
		}else{
			$qtySum[] = 0;
		}
		if($detailVal['amount'] != ''){
			$amountSum[] = $detailVal['amount'];
		}else{
			$amountSum[] = 0;
		}		
?>
						<tr id="tr<?php echo $detailVal['id']?>">
							<td><?php echo h($cnt)?></td>
							<td align="left"><?php echo h($detailVal['purpose'])?></td>
							<td align="left"><?php echo h($detailVal['particular'])?></td>
							<td align="right"><?php echo h($this->Money->india($detailVal['quantity']))?></td>
							<td align="right"><?php echo h($this->Money->india($detailVal['amount']))?></td>
						</tr>	
<?php
	}
?>
						<tr>
							<td colspan="3" align="right"><strong>Total:</strong></td>
							<td align="right"><strong><?php echo $this->Money->india(array_sum($qtySum))?></strong></td>
							<td align="right"><strong><?php echo $this->Money->india(array_sum($amountSum))?></strong></td>
							
						</tr>
						<tr>
							<td colspan="5" align="right">
								<strong>
									<?php echo ucfirst($this->Money->convert_number_to_words(array_sum($amountSum)))?> only
								</strong>
							</td>
						</tr>
					</tbody>
				</table>
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