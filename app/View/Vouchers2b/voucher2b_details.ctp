<?php
if(is_array($details) && count($details)>0){
?>				
<table class="table table-bordered">
	<thead>
		<tr>
			<th width="15%">Date of Collection</th>
			<th width="15%">Name of Phadi</th>
			<th width="20%">Reference to Book No/Page No. Of KL From No.1</th>
			<th width="15%">Reference to Book No/Page No. Of KL From No.2</th>
			<th width="15%">Number of Keries Purchased</th>
			<th width="20%">Amount in Rs.</th>	
			<th>Action</th>					
		</tr>
		<tr>
			<td align="center">1</td>
			<td align="center">2</td>
			<td align="center">3</td>
			<td align="center">4</td>
			<td align="center">5</td>
			<td align="center">6</td>
			<td></td>
		</tr>						
	</thead>
	<tbody>
<?php
	foreach($details as $detailKey=>$detailVal){
		if($detailVal['Vouchers2bdetail']['keries_purchased_no'] != ''){
			$purchasedSum[] = $detailVal['Vouchers2bdetail']['keries_purchased_no'];
		}else{
			$purchasedSum[] = 0;
		}
		if($detailVal['Vouchers2bdetail']['amount'] != ''){
			$amountSum[] = $detailVal['Vouchers2bdetail']['amount'];
		}else{
			$amountSum[] = 0;
		}		
?>
		<tr id="tr<?php echo $detailVal['Vouchers2bdetail']['id']?>">
			<td align="left"><?php echo h($funcall->DB2date($detailVal['Vouchers2bdetail']['collection_date']))?></td>
			<td align="left"><?php echo h($detailVal['Vouchers2bdetail']['phadi_name'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers2bdetail']['ref_book_kl1'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers2bdetail']['ref_book_kl2'])?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers2bdetail']['keries_purchased_no']))?></td>
			<td align="right"><?php echo h($this->Money->india($detailVal['Vouchers2bdetail']['amount']))?></td>
			<td>
<?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteDetail(".$detailVal['Vouchers2bdetail']['id'].")"));?>								
			</td>
		</tr>	
<?php
	}
?>
		<tr>
			<td colspan="4" align="right"><strong>Total:</strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($purchasedSum))?></strong></td>
			<td align="right"><strong><?php echo $this->Money->india(array_sum($amountSum))?></strong></td>
			<td></td>
		</tr>
	</tbody>
</table>
<?php
}
?>