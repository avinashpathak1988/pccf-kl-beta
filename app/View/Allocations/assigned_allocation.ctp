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
                <th>Expenditure</th>
                <th>Balance</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
<?php
    $cnt = 0;
    foreach($data as $key=>$val){
        $cnt++;
        $amtArr     = array();
        $totalAmt   = 0;
        $exepAmt    = 0;
        if(is_array($val['AllocationDetail']) && count($val['AllocationDetail'])>0){
            foreach($val['AllocationDetail'] as $allocationKey=>$allocationVal){
                if(isset($allocationVal['amount']) && $allocationVal['amount'] != ''){
                    $amtArr[] = $allocationVal['amount'];
                }else{
                    $amtArr[] = 0;
                }
            }
        }
        $totalAmt = array_sum($amtArr);
        $exepAmt  = $funcall->yearWiseExepAmt($val['Allocation']['fyear']);
        $balAmt   = floatVal($totalAmt) - floatVal($exepAmt);
?>
            <tr id="tr<?php echo $val['Allocation']['id']?>">
                <td><?php echo h($cnt)?></td>
                <td><?php echo h($val['Financialyear']['title'])?></td>
                <td><?php echo h($val['Allocation']['allocation_date'])?></td>
                <td>
<?php 
        if($val['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getPccfName($val['Allocation']['assign_by']));
        }else if($val['Allocation']['usertype_id'] == Configure::read('ROUSERTTYPE')){
            echo h($funcall->getDfoName($val['Allocation']['assign_by']));
        }      
?>
                </td>
                <td>
<?php 
        if($val['Allocation']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
            echo h($funcall->getDfoName($val['Allocation']['assign_to']));
        }else if($val['Allocation']['usertype_id'] == Configure::read('ROUSERTTYPE')){
            echo h($funcall->getRoName($val['Allocation']['assign_to']));
        }       
?>              
                </td>
                <td><?php echo h($val['Allocation']['memo_no'])?></td>
                <td><?php echo h($this->Money->india($totalAmt))?></td>
                <td><?php echo h($this->Money->india($exepAmt))?></td>
                <td><?php echo h($this->Money->india($balAmt))?></td>
                <td>
                    <?php  echo $this->Html->link('View',array('controller'=>'Allocations','action'=>'view',$val['Allocation']['id']),array('class'=>'btn btn-success'));?>            
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
<?php
}
?>

