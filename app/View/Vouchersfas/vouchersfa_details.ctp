<?php
if(is_array($details) && count($details)>0){
?>				
<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Purpose</th>
			<th>Particulars</th>
			<th>Qty.</th>
			<th>Amount</th>
			<th>Action</th>					
		</tr>		
	</thead>
	<tbody>
<?php
	$cnt = 0;
	$qtySum = array();
	$amountSum = array();
	foreach($details as $detailKey=>$detailVal){
		$cnt++;
		if($detailVal['Vouchersfasdetail']['quantity'] != ''){
			$qtySum[] = $detailVal['Vouchersfasdetail']['quantity'];
		}else{
			$qtySum[] = 0;
		}
		if($detailVal['Vouchersfasdetail']['amount'] != ''){
			$amountSum[] = $detailVal['Vouchersfasdetail']['amount'];
		}else{
			$amountSum[] = 0;
		}		
?>
		<tr id="tr<?php echo $detailVal['Vouchersfasdetail']['id']?>">
			<td><?php echo h($cnt)?></td>
			<td align="left"><?php echo h($detailVal['Vouchersfasdetail']['purpose'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchersfasdetail']['particular'])?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchersfasdetail']['quantity']))?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchersfasdetail']['amount']))?></td>
			<td>
<?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteDetail(".$detailVal['Vouchersfasdetail']['id'].")"));?>								
			</td>
		</tr>	
<?php
	}
?>
		<tr>
			<td colspan="3" align="right"><strong>Total:</strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($qtySum))?></strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($amountSum))?></strong></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
}
?>