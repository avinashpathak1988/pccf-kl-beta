<?php
if(is_array($data['Vouchers6']) && count($data['Vouchers6'])>0){
?>
<div style="float:right">
<?php
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Voucher 6',array('controller'=>'Vouchers6','action'=>'add'),array('escape'=>false))?>&nbsp;&nbsp;
<?php
    }
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 6',array('controller'=>'Vouchers6','action'=>'index'),array('escape'=>false))?>&nbsp;&nbsp;
    <?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
<table class="table table-bordered">
	<tr>
		<th>Financial Year</th>
		<td><?php echo h($data['Financialyear']['title'])?></td>
		<th>Account Head</th>
		<td><?php echo h($data['Account']['title'])?></td>	
		<th>Book No.</th>
		<td><?php echo h($data['Vouchers6']['book_number'])?></td>			
	</tr>
	<tr>
		<th>Page No.</th>
		<td><?php echo h($data['Vouchers6']['page_number'])?></td>
		<th>Unit No.</th>
		<td><?php echo h($data['Vouchers6']['unit_no'])?></td>	
		<th>Issue Date</th>
		<td><?php echo h($funcall->DB2date($data['Vouchers6']['issue_date']))?></td>			
	</tr>
	<tr>
		<th>Attach Files</th>
		<td colspan="6">
<?php
	if($data['Vouchers6']['attach_file'] != ''){
		$fileArr = explode(',',$data['Vouchers6']['attach_file']);
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
	if(is_array($data['Vouchers6detail']) && count($data['Vouchers6detail'])>0){
?>
	<tr>
		<td colspan="6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th align="center">Means of Transport</th>
						<th align="center">Name of the Driver/Carter</th>
						<th align="center" colspan="2">Quantity of processed/Phal Kendu Leaves bags</th>
					</tr>
				</thead>
				<tbody>
<?php
		$quantitySum = array();
		$bagSum		 = array();
		foreach($data['Vouchers6detail'] as $key=>$val){
			if($val['quantity_processed'] != ''){
				$quantitySum[] = $val['quantity_processed'];
			}else{
				$quantitySum[] = 0;
			}
			if($val['kendu_leaves_bags'] != ''){
				$bagSum[] = $val['kendu_leaves_bags'];
			}else{
				$bagSum[] = 0;
			}				
?>
					<tr>
						<td><?php echo h($val['means_transport'])?></td>
						<td><?php echo h($val['driver_name'])?></td>
						<td><?php echo h($this->Money->india($val['quantity_processed']))?></td>
						<td><?php echo h($this->Money->india($val['kendu_leaves_bags']))?></td>
					</tr>
<?php			
		}
?>
					<tr>
						<td colspan="2" align="right"><strong>Total:</strong></td>
						<td><?php echo h($this->Money->india(array_sum($quantitySum)))?></td>
						<td><?php echo h($this->Money->india(array_sum($bagSum)))?></td>
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