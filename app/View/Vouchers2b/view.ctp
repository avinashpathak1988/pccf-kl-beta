<?php
if(is_array($data['Vouchers2b']) && count($data['Vouchers2b'])>0){
?>
<div style="float:right">
<?php
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Voucher 2b',array('controller'=>'Vouchers2b','action'=>'add'),array('escape'=>false))?>&nbsp;&nbsp;
<?php
    }
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 2b',array('controller'=>'Vouchers2b','action'=>'index'),array('escape'=>false))?>&nbsp;&nbsp;
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
		<td><?php echo h($data['Vouchers2b']['voucher_number'])?></td>			
	</tr>
	<tr>
		<th>Voucher Date</th>
		<td><?php echo h($funcall->DB2date($data['Vouchers2b']['voucher_date']))?></td>
		<th>Unit No.</th>
		<td><?php echo h($data['Vouchers2b']['unit_no'])?></td>	
		<th>Payment Method</th>
		<td><?php echo h($data['Vouchers2b']['payment_method'])?></td>			
	</tr>
	<tr>
		<th>Forester</th>
		<td><?php echo h($data['Vouchers2b']['forester'])?></td>
		<th>Forester Section</th>
		<td><?php echo h($data['Vouchers2b']['forester_section'])?></td>	
		<th>Attach Files</th>
		<td>
<?php
	if($data['Vouchers2b']['attach_file'] != ''){
		$fileArr = explode(',',$data['Vouchers2b']['attach_file']);
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
	if(is_array($data['Vouchers2bdetail']) && count($data['Vouchers2bdetail'])>0){
?>
	<tr>
		<td colspan="6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Date of Collection</th>
						<th>Name of Phadi</th>
						<th>Reference to Book No/Page No. Of KL From No.1</th>
						<th>Reference to Book No/Page No. Of KL From No.2</th>
						<th>Number of Keries Purchased</th>
						<th>Amount in Rs.</th>
					</tr>
				</thead>
				<tbody>
<?php
		$purchasedSum 	= array();	
		$amountSum		= array();	
		foreach($data['Vouchers2bdetail'] as $key=>$val){
			if($val['keries_purchased_no'] != ''){
				$purchasedSum[] = $val['keries_purchased_no'];
			}else{
				$purchasedSum[] = 0;
			}
			if($val['amount'] != ''){
				$amountSum[] = $val['amount'];
			}else{
				$amountSum[] = 0;
			}			
?>
					<tr>
						<td><?php echo h($funcall->DB2date($val['collection_date']))?></td>
						<td><?php echo h($val['phadi_name'])?></td>
						<td><?php echo h($val['ref_book_kl1'])?></td>
						<td><?php echo h($val['ref_book_kl2'])?></td>
						<td><?php echo h($this->Money->india($val['keries_purchased_no']))?></td>
						<td><?php echo h($this->Money->india($val['amount']))?></td>
					</tr>
<?php			
		}
?>
					<tr>
						<td colspan="4" align="right"><strong>Total</strong></td>
						<td><?php echo $this->Money->india(array_sum($purchasedSum))?></td>
						<td><?php echo $this->Money->india(array_sum($amountSum))?></td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
<?php		
	}
	if(is_array($data['Vouchers2bReport']) && count($data['Vouchers2bReport'])>0){
		foreach($data['Vouchers2bReport'] as $key=>$val){
?>
	<tr>
		<td colspan="6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Book No.</th>
						<td><?php echo $val['book_no']?></td>
						<th>Page No.</th>
						<td><?php echo $val['page_no']?></td>						
					</tr>
					<tr>
						<td colspan="4" align="center"><strong>Kendu Leaves Form No. 2 Daily Report</strong></td>
					</tr>
					<tr>
						<th>Unit No.</th>
						<td><?php echo $val['unit_no']?></td>
						<th>Phadi Name</th>
						<td><?php echo $val['phadi_name']?></td>						
					</tr>
					<tr>
						<th>Date</th>
						<td colspan="3"><?php echo h($funcall->DB2date($val['report_date']))?></td>		
					</tr>
					<tr>
						<td colspan="4">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th></th>
										<th>No. of Collector</th>
										<th>No. of Keries Purchased</th>
										<th>Amount in Rs.</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Before</th>
										<td><?php echo h($this->Money->india($val['before_collector_no']))?></td>
										<td><?php echo h($this->Money->india($val['before_keries_puchased_no']))?></td>
										<td><?php echo h($this->Money->india($val['before_amount']))?></td>
									</tr>
									<tr>
										<th>Today</th>
										<td><?php echo h($this->Money->india($val['today_collector_no']))?></td>
										<td><?php echo h($this->Money->india($val['today_keries_puchased_no']))?></td>
										<td><?php echo h($this->Money->india($val['today_amount']))?></td>
									</tr>									
									<tr>
										<th>Total</th>
										<td><?php echo h($this->Money->india($val['total_collector_no']))?></td>
										<td><?php echo h($this->Money->india($val['total_keries_puchased_no']))?></td>
										<td><?php echo h($this->Money->india($val['total_amount']))?></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>										
				</thead>
			</table>
		</td>
	</tr>
<?php
		}
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