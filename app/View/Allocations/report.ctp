<div class="table-responsive">
    <?php
if(is_array($data) && count($data)>0){
?>
<ul class="pagination">
<?php
    $this->Paginator->options(array(
        'update'    => '#listingDiv',
        'evalScripts'   => true,
        'before'    => '$("#lodding_image").show();',
        'complete'  => '$("#lodding_image").hide();',
        'url'=> array(
            'controller'            => 'Admin',
            'action'                => 'reportAjax',
        )
    ));
    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Js->writeBuffer();
?>
</ul>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Desig</th>
            <th>Allot Date</th> 
            <th>Remark</th>
            <th>Assign To</th>  
            <th>Assign By</th>  
            <th>Action</th>         
    

            
        </tr>
    </thead>
    <tbody>
<?php
    $cnt = $this->Paginator->counter(array('format' => ('{:start}')));
    foreach($data as $key=>$val){
?>            
        <tr>
            <td><?php echo ($cnt)?></td>
            <td><?php echo ($val['Allocation']['user_id'])?></td>
            <td><?php //echo $funcall->DB2date(h($val['Allocation']['allocation_date']))?></td> 
            <td><?php echo ($val['Allocation']['remark'])?></td>
            <td><?php echo ($val['Allocation']['assign_to'])?></td>
            <td><?php echo ($val['Allocation']['assign_by'])?></td>
            <td>
                <?php echo $this->Form->create('MasterDelete',array('url'=>'/Allocation')); ?>
                <?php echo $this->Form->input('id',array('type'=>'hidden','value'=> $val['Allocation']['id'])); ?>
                <?php echo $this->Form->end(array('label'=>'Delete','class'=>'btn btn-danger','div'=>false));?>                        
            </td>
            <td>
                View                     
            </td>
        <td>


    
        </tr>
<?php
        $cnt++;
    }
}
?>            
    </tbody>
</table>
  
    
</div>

