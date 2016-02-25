<?php
if(is_array($data) && count($data)>0){
?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name of Coolies</th>
				<th>Residence</th>
				<th>Total No. of days</th>
				<th>Rate</th>
				<th>Amount Due</th>
				<th>Net Amount Paid</th>
				<th>Remarks</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
<?php
	$daySum = array();
	$dueSum = array();
	$paidSum = array();
	foreach($data as $key=>$val){
		if(isset($val['vouchers10Report']['days_no']) && (int)$val['vouchers10Report']['days_no'] != 0){
			$daySum[] = $val['vouchers10Report']['days_no'];
		}else{
			$daySum[] = 0;
		}
		if(isset($val['vouchers10Report']['amount_due']) && $val['vouchers10Report']['amount_due'] != ''){
			$dueSum[] = $val['vouchers10Report']['amount_due'];
		}else{
			$dueSum[] = 0;
		}
		if(isset($val['vouchers10Report']['net_amount_paid']) && $val['vouchers10Report']['net_amount_paid'] != ''){
			$paidSum[] = $val['vouchers10Report']['net_amount_paid'];
		}else{
			$paidSum[] = 0;
		}				
?>		
			<tr id="tr<?php echo $val['vouchers10Report']['id']?>">
				<td><?php echo h($val['vouchers10Report']['coolie_name'])?></td>
				<td><?php echo h($val['vouchers10Report']['residence'])?></td>				
				<td align="right"><?php echo h($this->Money->india($val['vouchers10Report']['days_no']))?></td>
				<td align="right"><?php echo h($this->Money->india($val['vouchers10Report']['rate']))?></td>
				<td align="right"><?php echo h($this->Money->india($val['vouchers10Report']['amount_due']))?></td>
				<td align="right"><?php echo h($this->Money->india($val['vouchers10Report']['net_amount_paid']))?></td>	
				<td><?php echo h($val['vouchers10Report']['remarks'])?></td>
				<td>
					<?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteReportDetail(".$val['vouchers10Report']['id'].")"));?>					
				</td>		
			</tr>
<?php
	}
?> 
			<tr>
				<td colspan="2" align="right"><strong>Total</strong></td>
				<td align="right"><strong><?php echo h($this->Money->india(array_sum($daySum)))?></strong></td>
				<td></td>
				<td align="right"><strong><?php echo h($this->Money->india(array_sum($dueSum)))?></strong></td>
				<td align="right"><strong><?php echo h($this->Money->india(array_sum($paidSum)))?></strong></td>
				<td colspan="2"></td>
			</tr> 
        </tbody>				
	</table>
<?php	
}
?>