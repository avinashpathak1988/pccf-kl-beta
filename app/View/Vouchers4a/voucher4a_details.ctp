<?php
if(is_array($details) && count($details)>0){
?>				
<table class="table table-bordered">
	<thead>
		<tr>
			<th>S No</th>
            <th>Khunti Name</th>
            <th>Binding Card No.</th>
            <th colspan="7">Quality Wise Binding Bundle Quantity <br> <span style="font-weight: normal;" >12(Twelve) Full</span></th>
            <th>Test Binding &amp; Test Grading Result</th>
            <th>Action</th>
        </tr>
        <tr>
            <th colspan="3">&nbsp;</th>
            <th>Q I </th>
            <th>Q III </th>
            <th>Q IVS </th>
            <th>Q MM </th>
            <th>Q IV </th>
            <th>Q I </th>
            <th>Total</th>
            <th>&nbsp;</th>
        </tr> 						
	</thead>
	<tbody>
<?php
	$total_q1 = 0;
	$total_q2 = 0;
	$total_q3 = 0;
	$total_q4 = 0;
	$total_q5 = 0;
	$total_q6 = 0;
	$total_q_total = 0;
	$cnt = 1;

	foreach($details as $detailKey=>$detailVal){
		$total_q1 += $detailVal['Vouchers4adetail']['q1'];
		$total_q2 += $detailVal['Vouchers4adetail']['q2'];
		$total_q3 += $detailVal['Vouchers4adetail']['q3'];
		$total_q4 += $detailVal['Vouchers4adetail']['q4'];
		$total_q5 += $detailVal['Vouchers4adetail']['q5'];
		$total_q6 += $detailVal['Vouchers4adetail']['q6'];
		$total_q_total += $detailVal['Vouchers4adetail']['q_total'];
?>
		<tr id="tr<?php echo $detailVal['Vouchers4adetail']['id']?>">
			<td align="left"><?php echo $cnt++; ?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['khunti_name'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['binding_card_number'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q1'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q2'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q3'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q4'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q5'])?></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['q6'])?></td>
			<td align="left"><b><?php echo h($detailVal['Vouchers4adetail']['q_total'])?></b></td>
			<td align="left"><?php echo h($detailVal['Vouchers4adetail']['grade'])?></td>
			<td>
				<?php echo $this->Html->link('<i class="fa fa-trash"></i> Delete', "javascript:void(0);", array('escape'=>false,'class'=>"btn btn-danger",'onclick'=>"deleteDetail(".$detailVal['Vouchers4adetail']['id'].")")); ?>	
			</td>
		</tr>	
<?php
	}
?>
		<tr style="font-weight: bold;">
			<td colspan="2">Total</td>
			<td align="left"><?php echo h($total_q1)?></td>
			<td align="left"><?php echo h($total_q2)?></td>
			<td align="left"><?php echo h($total_q3)?></td>
			<td align="left"><?php echo h($total_q4)?></td>
			<td align="left"><?php echo h($total_q5)?></td>
			<td align="left"><?php echo h($total_q6)?></td>
			<td align="left"><?php echo h($total_q_total)?></td>
			<td colspan="2" align="left">&nbsp;</td>
		</tr>
	</tbody>
</table>
<?php
}
?>