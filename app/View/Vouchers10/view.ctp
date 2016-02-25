<?php
if(is_array($data['Vouchers10']) && count($data['Vouchers10'])>0){
?>
<div style="float:right">
<?php
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Voucher 10',array('controller'=>'Vouchers10','action'=>'add'),array('escape'=>false))?>&nbsp;&nbsp;
<?php
    }
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 10',array('controller'=>'Vouchers10','action'=>'index'),array('escape'=>false))?>&nbsp;&nbsp;
    <?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
<table class="table table-bordered">
	<tr>
		<th>Financial Year</th>
		<td><?php echo h($data['Financialyear']['title'])?></td>
		<th>Account Head</th>
		<td><?php echo h($data['Account']['title'])?></td>	
		<th>Voucher No.</th>
		<td><?php echo h($data['Vouchers10']['voucher_number'])?></td>			
	</tr>
	<tr>
		<th>Voucher Date</th>
		<td><?php echo h($funcall->DB2date($data['Vouchers10']['voucher_date']))?></td>
		<th>From Date</th>
		<td><?php echo h($funcall->DB2date($data['Vouchers10']['from_date']))?></td>	
		<th>To Date</th>
		<td><?php echo h($funcall->DB2date($data['Vouchers10']['to_date']))?></td>			
	</tr>
	<tr>
		<th>Attach Files</th>
		<td colspan="5">
<?php
	if($data['Vouchers10']['attach_file'] != ''){
		$fileArr = explode(',',$data['Vouchers10']['attach_file']);
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
<?php
	if(is_array($data['Vouchers10detail']) && count($data['Vouchers10detail'])>0){
?>
	<tr>
		<td colspan="6">
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
		$itemSum 	= array();	
		$workSum		= array();	
		foreach($data['Vouchers10detail'] as $key=>$val){
			if($val['amount_per_item'] != ''){
				$itemSum[] = $val['amount_per_item'];
			}else{
				$itemSum[] = 0;
			}
			if($val['amount_per_work'] != ''){
				$workSum[] = $val['amount_per_work'];
			}else{
				$workSum[] = 0;
			}		
?>
					<tr id="tr<?php echo $val['id']?>">
						<td align="left"><?php echo h($val['particulars_wok'])?></td>
						<td align="left"><?php echo h($val['previous_progress'])?></td>
						<td align="left"><?php echo h($val['now_progress'])?></td>
						<td align="left"><?php echo h($val['total_progress'])?></td>
						<td align="left"><?php echo h($val['labour_materials_desc'])?></td>
						<td align="left"><?php echo h($val['no'])?></td>		
						<td align="left"><?php echo h($val['rate_at'])?></td>
						<td align="left"><?php echo h($val['rate_per_item'])?></td>	
						<td align="right"><?php echo h($this->Money->india($val['amount_per_item']))?></td>
						<td align="right"><?php echo h($this->Money->india($val['amount_per_work']))?></td>
						<td align="left"><?php echo h($val['remarks'])?></td>
					</tr>	
<?php
	}
?>
					<tr>
						<td colspan="8" align="right"><strong>Total:</strong></td>
						<td align="right"><strong><?php echo $this->Money->india(array_sum($itemSum))?></strong></td>
						<td align="right"><strong><?php echo $this->Money->india(array_sum($workSum))?></strong></td>			
						<td></td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
<?php		
	}
?>			
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