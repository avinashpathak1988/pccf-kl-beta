<?php
if(is_array($details) && count($details)>0){
?>				
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2">Particulars of work</th>
			<th colspan="3">Progress</th>
			<th rowspan="2">Description of labour and materials</th>
			<th rowspan="2">No.</th>
			<th colspan="2">Rate</th>
			<th colspan="2">Amount</th>
			<th rowspan="2">Remarks</th>
		</tr>
		<tr>
			<th>Previous</th>
			<th>Now exhibited</th>
			<th>Total</th>
			<th>At</th>
			<th>Per Item</th>
			<th>Per Item</th>
			<th>Per Work</th>
		</tr>
		<tr>
			<td align="center">1</td>
			<td align="center">2</td>
			<td align="center">3</td>
			<td align="center">4</td>
			<td align="center">5</td>
			<td align="center">6</td>
			<td align="center">7</td>
			<td align="center">8</td>
			<td align="center">9</td>
			<td align="center">10</td>
			<td align="center">11</td>							
		</tr>					
	</thead>
	<tbody>
<?php
	$itemSum = array();
	$workSum = array();
	foreach($details as $detailKey=>$detailVal){
		if($detailVal['Vouchers10detail']['amount_per_item'] != ''){
			$itemSum[] = $detailVal['Vouchers10detail']['amount_per_item'];
		}else{
			$itemSum[] = 0;
		}
		if($detailVal['Vouchers10detail']['amount_per_work'] != ''){
			$workSum[] = $detailVal['Vouchers10detail']['amount_per_work'];
		}else{
			$workSum[] = 0;
		}		
?>
		<tr id="tr<?php echo $detailVal['Vouchers10detail']['id']?>">
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['particulars_wok'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['previous_progress'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['now_progress'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['total_progress'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['labour_materials_desc'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['no'])?></td>		
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['rate_at'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['rate_per_item'])?></td>	
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers10detail']['amount_per_item']))?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers10detail']['amount_per_work']))?></td>
			<td align="left"><?php echo h($detailVal['Vouchers10detail']['remarks'])?></td>
			<td>
<?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteDetail(".$detailVal['Vouchers10detail']['id'].")"));?>								
			</td>
		</tr>	
<?php
	}
?>
		<tr>
			<td colspan="8" align="right"><strong>Total:</strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($itemSum))?></strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($workSum))?></strong></td>			
			<td colspan="2"></td>
		</tr>
	</tbody>
</table>
<?php
}
?>