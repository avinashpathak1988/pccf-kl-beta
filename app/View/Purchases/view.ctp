<?php
if(is_array($data['Purchase']) && count($data['Purchase'])>0){
?>
<div style="float:right">
<?php
	if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Purchase KL',array('controller'=>'Purchases','action'=>'add'),array('escape'=>false))?>&nbsp;&nbsp;
<?php
	}
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Purchase KL',array('controller'=>'Purchases','action'=>'index'),array('escape'=>false))?>&nbsp;&nbsp;
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
		<td><?php echo h($data['Purchase']['book_number'])?></td>			
	</tr>
	<tr>
		<th>Page No.</th>
		<td><?php echo h($data['Purchase']['page'])?></td>	
		<th>Code</th>
		<td><?php echo h($data['Purchase']['code'])?></td>
		<th>Fadi's Name</th>
		<td><?php echo h($data['Purchase']['fadi_name'])?></td>					
	</tr>
	<tr>
		<th>Entry Date</th>
		<td><?php echo h($funcall->DB2date($data['Purchase']['edate']))?></td>		
		<th>Unit No.</th>
		<td><?php echo h($data['Purchase']['unit_number'])?></td>
		<th>Entry By</th>
		<td><?php echo h($data['Purchase']['entered_by'])?></td>
	</tr>
	<tr>
		<th>Verified By</th>
		<td><?php echo h($data['Purchase']['verified_by'])?></td>							
		<th>Attach Files</th>
		<td colspan="3">
<?php
	if($data['Purchase']['attach_file'] != ''){
		$fileArr = explode(',',$data['Purchase']['attach_file']);
		if(is_array($fileArr) && count($fileArr)>0){
			foreach($fileArr as $fileKey=>$fileVal){
	            echo $this->Form->create('Download',array('url'=>'/vouchers2b/download')); 
	            echo $this->Form->input('file_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$fileVal));
	            echo $this->Form->input('folder_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>'V'));
	            echo $this->Form->end(array('label'=>'Download','class'=>'btn btn-transparent','div'=>false));
        	}
        }
    }
?>			
		</td>			
	</tr>
<?php
	if(is_array($data['Purchasedetail']) && count($data['Purchasedetail'])>0){
?>
	<tr>
		<td colspan="6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Collector's Name </th>
						<th>Card Number </th>
						<th>Quantity</th>
						<th>Unit Price </th>
						<th>Total Price </th>
					</tr>
				</thead>
				<tbody>
<?php
		$amountSum		= array();	
		foreach($data['Purchasedetail'] as $key=>$val){
			if($val['amount'] != ''){
				$amountSum[] = $val['amount'];
			}else{
				$amountSum[] = 0;
			}			
?>
					<tr>
						<td><?php echo h($val['Worker']['title'])?></td>
						<td><?php echo h($val['card_number'])?></td>
						<td><?php echo h($val['quantity'])?></td>
						<td><?php echo h($this->Money->india($val['unit_price']))?></td>
						<td><?php echo h($this->Money->india($val['amount']))?></td>
					</tr>
<?php			
		}
?>
					<tr>
						<td colspan="4" align="right"><strong>Total</strong></td>
						<td><?php echo $this->Money->india(array_sum($amountSum))?></td>
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