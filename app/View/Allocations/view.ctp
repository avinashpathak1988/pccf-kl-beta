<?php
if(is_array($data['Allocation']) && count($data['Allocation'])>0){
?>
<div class="box-body">
<table class="table table-bordered">
	<tr>
		<th>Scheme</th>
		<td><?php echo h($data['Scheme']['title'])?></td>
		<th>Assigned By</th>
		<td>
<?php		
        if($data['Allocation']['usertype_id'] == Configure::read('PCCFUSERTTYPE')){
            echo h($funcall->getPccfName($data['Allocation']['assign_by']));
        }else if($data['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getDfoName($data['Allocation']['assign_by']));
        }
?>        
		</td>	
		<th>Assigned To</th>
		<td>
<?php
        if($data['Allocation']['usertype_id'] == Configure::read('PCCFUSERTTYPE')){
            echo h($funcall->getDfoName($data['Allocation']['assign_to']));
        }else if($data['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getRoName($data['Allocation']['assign_to']));
        } 
?>
		</td>			
	</tr>
	<tr>
		<th>Allocation Date</th>
		<td><?php echo h($funcall->DB2date($data['Allocation']['allocation_date']))?></td>
		<th>Memo No.</th>
		<td><?php echo h($data['Allocation']['memo_no'])?></td>	
		<th>Remarks</th>
		<td><?php echo h($data['Allocation']['remark'])?></td>			
	</tr>
	<tr>
		<th>Attach Files</th>
		<td colspan="5">
<?php
	if($data['Allocation']['attachment'] != ''){
        echo $this->Form->create('Download',array('url'=>'/vouchers2b/download')); 
        echo $this->Form->input('file_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$data['Allocation']['attachment']));
        echo $this->Form->input('folder_name',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>'F'));
        echo $this->Form->end(array('label'=>'Download','class'=>'btn btn-transparent','div'=>false));
    }
?>			
		</td>			
	</tr>
<?php
	if(is_array($data['AllocationDetail']) && count($data['AllocationDetail'])>0){
?>
	<tr>
		<td colspan="6">
			<div id="listingDiv"></div>
		</td>
	</tr>
<?php		
	}
?>		
</table>
</div>
<script>
	$(document).ready(function(){
		var allocationId = <?php echo $data['Allocation']['id']?>;
		showFundData(allocationId);
	});
	function showFundData(allocationId){
		if(allocationId){
			var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'fundAjaxList'))?>";
			$.post(url,{id:allocationId,'ref':'V'},function(res){
				if(res){
					$('#listingDiv').html(res);
				}
			});
		}
	}
</script>
<?php
}
?>