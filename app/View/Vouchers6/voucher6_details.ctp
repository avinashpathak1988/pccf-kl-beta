<?php
if(is_array($details) && count($details)>0){
?>				
<table class="table table-bordered">
	<thead>
		<tr>
			<th align="center">Means of Transport</th>
			<th align="center">Name of the Driver/Carter</th>
			<th align="center" colspan="2">Quantity of processed/Phal Kendu Leaves bags</th>
			<th>Action</th>					
		</tr>						
	</thead>
	<tbody>
<?php
	$quantitySum = array();
	$bagSum		 = array();
	foreach($details as $detailKey=>$detailVal){
		if($detailVal['Vouchers6detail']['quantity_processed'] != ''){
			$quantitySum[] = $detailVal['Vouchers6detail']['quantity_processed'];
		}else{
			$quantitySum[] = 0;
		}
		if($detailVal['Vouchers6detail']['kendu_leaves_bags'] != ''){
			$bagSum[] = $detailVal['Vouchers6detail']['kendu_leaves_bags'];
		}else{
			$bagSum[] = 0;
		}		
?>
		<tr id="tr<?php echo $detailVal['Vouchers6detail']['id']?>">
			<td align="left"><?php echo h($detailVal['Vouchers6detail']['means_transport'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers6detail']['driver_name'])?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers6detail']['quantity_processed']))?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers6detail']['kendu_leaves_bags']))?></td>
			<td>
<?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteDetail(".$detailVal['Vouchers6detail']['id'].")"));?>								
			</td>
		</tr>	
<?php
	}
?>
		<tr>
			<td colspan="2" align="right"><strong>Total:</strong></td>
			<td align="right"><?php echo h($this->Money->india(array_sum($quantitySum)))?></td>
			<td align="right"><?php echo h($this->Money->india(array_sum($bagSum)))?></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
}
?>