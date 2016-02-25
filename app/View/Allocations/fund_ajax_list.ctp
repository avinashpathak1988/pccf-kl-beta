<?php
if(!empty($fundDetailData) && is_array($fundDetailData) && count($fundDetailData)>0){
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Sl. No.</th>
			<th>Account Head</th>
			<th>Sub Account Head</th>
			<th>Detail</th>
			<th>Amount</th>
<?php
	if($ref == 'F'){
?>			
			<th>Action</th>
<?php
	}
?>			
		</tr>
	</thead>
	<tbody>
<?php
	$trCnt = 0;
	foreach($fundDetailData as $key => $val){
		$trCnt++;
		if(isset($val['AllocationDetail']['amount']) && $val['AllocationDetail']['amount'] != ''){
			$amtArr[] = $val['AllocationDetail']['amount'];
		}else{
			$amtArr[] = 0;
		}
?>
		<tr id="tr<?php echo $val['AllocationDetail']['id']?>">
			<td><?php echo $trCnt?></td>
			<td><?php echo $val['Account']['title']?></td>
			<td><?php echo $val['SubAccount']['title']?></td>
			<td><?php echo $val['AllocationDetail']['detail']?></td>
			<td><?php echo $this->Money->india($val['AllocationDetail']['amount'])?></td>
<?php
		if($ref == 'F'){
?>			
			<td>
			<?php  echo $this->Form->button('Remove',array('type'=>'button','class'=>'btn btn-danger','div'=>false,'onclick'=>'javascript: deleteAllocationDetail('.$val['AllocationDetail']['id'].');'));?>
			</td>
<?php
		}
?>			
		</tr>
<?php
	}
?>	
		<tr>
			<td colspan="4" align="right"><strong>Total</strong></td>
			<td><?php echo h($this->Money->india(array_sum($amtArr)))?></td>
<?php
		if($ref == 'F'){
?>			
			<td></td>
<?php
		}
?>			
		</tr>
	</tbody>
</table>
<?php
}else{
	echo "No Data Found";
}
?>