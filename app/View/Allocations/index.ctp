<?php
if(is_array($data) && count($data)>0){
?>
<div class="box-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
                <th><?php echo $this->Paginator->sort('fyear',' Financial Year'); ?></th>
                <th><?php echo $this->Paginator->sort('allocation_date','Allot Date'); ?></th>
                <th><?php echo $this->Paginator->sort('assign_by','Assign By'); ?></th>
                <th><?php echo $this->Paginator->sort('assign_to',' Assign To'); ?></th>
                <th><?php echo $this->Paginator->sort('memo_no',' Memo No.'); ?></th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
    $cnt = 0;
    foreach($data as $key=>$val){
        $cnt++;
        $amtArr = array();
        if(is_array($val['AllocationDetail']) && count($val['AllocationDetail'])>0){
            foreach($val['AllocationDetail'] as $allocationKey=>$allocationVal){
                if(isset($allocationVal['amount']) && $allocationVal['amount'] != ''){
                    $amtArr[] = $allocationVal['amount'];
                }else{
                    $amtArr[] = 0;
                }
            }
        }        
?>
            <tr id="tr<?php echo $val['Allocation']['id']?>">
                <td><?php echo h($cnt)?></td>
                <td><?php echo h($val['Financialyear']['title'])?></td>
                <td><?php echo h($val['Allocation']['allocation_date'])?></td>
                <td>
<?php 
        if($val['Allocation']['usertype_id'] == Configure::read('PCCFUSERTTYPE')){
            echo h($funcall->getPccfName($val['Allocation']['assign_by']));
        }else if($val['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getDfoName($val['Allocation']['assign_by']));
        }      
?>
                </td>
                <td>
<?php 
        if($val['Allocation']['usertype_id'] == Configure::read('PCCFUSERTTYPE')){
            echo h($funcall->getDfoName($val['Allocation']['assign_to']));
        }else if($val['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getRoName($val['Allocation']['assign_to']));
        }       
?>              
                </td>
                <td><?php echo h($val['Allocation']['memo_no'])?></td>
                <td><?php echo h($this->Money->india(array_sum($amtArr)))?></td>
                <td>
                    <div style="float:left;margin-right:5px;">
                        <?php  echo $this->Html->link('View',array('controller'=>'Allocations','action'=>'view',$val['Allocation']['id']),array('class'=>'btn btn-success'));?>            
                    </div> 
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editFundForm',array('url'=>'/Allocations/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$val['Allocation']['id']));
            echo $this->Form->end(array('label'=>'Edit','class'=>'btn btn-primary','div'=>false));
?>                     
                    </div>
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('Delete','javascript:void(0);',array('class'=>'btn btn-danger','onclick'=>"javascript:deleteFund(".$val['Allocation']['id'].");")); 
?>
                    </div>                                       
                </td>
            </tr>
<?php
    }
?>    
        </tbody>
    </table>
<?php
    echo $this->Paginator->counter(array(
       'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
?>  
    </p>
    <div class="box-footer clearfix">
        <div class="paging">
        <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ' '))."&nbsp;&nbsp;&nbsp;&nbsp;";
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
        </div>
    </div> 
</div>
<script>
    function deleteFund(fundId){
        if(fundId){
            if(confirm('Are you sure to delete?')){
                var url = "<?php echo $this->Html->url(array('controller'=>'Allocations','action'=>'fundDelete'))?>";
                $.post(url,{id:fundId},function(res){
                    if(res == 'SUCC'){
                        $('#tr'+fundId).hide('slow');
                    }
                });
            }       
        }
    }
</script>   
<?php
}
?>

