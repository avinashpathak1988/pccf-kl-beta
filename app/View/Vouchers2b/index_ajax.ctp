<?php
if(is_array($vouchers) && count($vouchers)>0){
    if(!isset($is_excel)){
?>
<div style="float:right">
<?php
    $exUrl = "indexAjax/ro_id:$ro_id/dfo_id:$dfo_id/page:$page/fyear:$fyear/account_id:$account_id/start_date:$start_date/end_date:$end_date/voucher_status:$voucher_status";
    $urlExcel = $exUrl.'/reqType:XLS';
    $urlDoc = $exUrl.'/reqType:DOC';
    echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();',"escape" => false));
    echo '&nbsp;&nbsp;';
    echo($this->Html->link($this->Html->image("excel-2012.jpg",array("height" => "20","width" => "20","title"=>"Download Excel")),$urlExcel, array("escape" => false)));
    echo '&nbsp;&nbsp;';
    echo($this->Html->link($this->Html->image("word-2012.png",array("height" => "20","width" => "20","title"=>"Download Doc")),$urlDoc, array("escape" => false)));
?>    
</div>
<?php
    echo $this->Paginator->counter(array(
       'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
?>  
    <div class="box-footer clearfix">
        <div class="paging">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Vouchers2b',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
        )
    ));         
    echo $this->Paginator->prev('Previous', null,null, array('class' => 'disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next('Next', null,null, array('class' => 'disabled'));
    echo $this->Js->writeBuffer();
?>
        </div>
    </div> 
<?php
}
?>    
<div id="print_div">
<table class="table table-bordered">
	<tr>
		<th>
            <?php echo $this->Paginator->sort('id','SL#'); ?>
            <?php echo $this->Form->input('page',array('type'=>'hidden','id'=>'page','value'=>$page))?>
        </th>
		<th><?php echo $this->Paginator->sort('voucher_number',' Voucher No.'); ?></th>
		<th><?php echo $this->Paginator->sort('voucher_date','Voucher Date'); ?></th>
		<th><?php echo $this->Paginator->sort('unit_no','Unit No.'); ?></th>
		<th><?php echo $this->Paginator->sort('user_id',' RO'); ?></th>
		<th><?php echo $this->Paginator->sort('payment_method',' Payment Method'); ?></th>
		<th><?php echo $this->Paginator->sort('forester','Forester'); ?></th>
        <th><?php echo $this->Paginator->sort('forester_section','Forester Section'); ?></th>
<?php
    if(!isset($is_excel)){
?>         
        <th width="12%">
<?php
        if($usertype_id == Configure::read('ROUSERTTYPE')){
            echo 'Action';
        }else{
            echo 'View';
        }
?> 
        </th>
<?php
    }
?>        
        <th width="20%">
<?php
    if($usertype_id == Configure::read('DFOUSERTTYPE') || $usertype_id == Configure::read('ACCOUNTANTUSERTTYPE')){
        echo 'Action';
    }else{
        echo 'Status';
    }
?>      
        </th>
	</tr>
<?php  
    $rowCnt = $this->Paginator->counter(array('format' => __('{:start}')));
    foreach($vouchers as $voucher){
?>
    <tr id="tr<?php echo $voucher['Vouchers2b']['id']?>">
        <td><?php echo $rowCnt; ?></td>
        <td><?php echo $voucher['Vouchers2b']['voucher_number']; ?></td>
        <td><?php echo $funcall->DB2date($voucher['Vouchers2b']['voucher_date']); ?></td>
        <td><?php echo $voucher['Vouchers2b']['unit_no']; ?></td>
        <td><?php echo h($funcall->getUserIdRoName($voucher['Vouchers2b']['user_id']))?></td>
        <td><?php echo $voucher['Vouchers2b']['payment_method']; ?></td>
        <td><?php echo $voucher['Vouchers2b']['forester']; ?></td>
        <td><?php echo $voucher['Vouchers2b']['forester_section']; ?></td>
<?php
    if(!isset($is_excel)){
?>         
        <td>
            <div style="float:left;margin-right:5px;">
<?php  
            echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',array('controller'=>'Vouchers2b','action'=>'view',$voucher['Vouchers2b']['id']),array('escape'=>false,'title'=>'View Report'));
?>            
            </div>
<?php 
        if($usertype_id == Configure::read('ROUSERTTYPE')){
            if($voucher['Vouchers2b']['is_approve_accountant'] == 'N' && $voucher['Vouchers2b']['is_approve_dfo'] == 'N'){ 
?>            
            <div style="float:left;margin-right:5px;">
<?php  
            echo $this->Html->link('<i class="glyphicon glyphicon-modal-window"></i>',array('controller'=>'Vouchers2b','action'=>'addReport',$voucher['Vouchers2b']['id']),array('escape'=>false,'title'=>'Add Report'));
?>            
            </div>
            <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editVoucher2bForm',array('url'=>'/vouchers2b/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$voucher['Vouchers2b']['id']));
            echo $this->Form->button('<i class="glyphicon glyphicon-pencil"></i>',array('type'=>'submit','escape'=>false,'div'=>false,'style'=>"border:none;background:transparent;color:#72B3E1;",'title'=>'Edit Report'));
            echo $this->Form->end();
?>                     
            </div>
            <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>','javascript:void(0);',array('escape'=>false,'title'=>'Delete','onclick'=>"javascript:deleteVoucher2b(".$voucher['Vouchers2b']['id'].");")); 
?>
            </div>
<?php
            }
        }
?>            
        </td>
<?php
    }
?>        
        <td id="td<?php echo $voucher['Vouchers2b']['id']?>">
<?php
        if($usertype_id == Configure::read('DFOUSERTTYPE')){
            if($voucher['Vouchers2b']['is_approve_dfo'] == 'N' && $voucher['Vouchers2b']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
            <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:approveVoucher2b(".$voucher['Vouchers2b']['id'].");")); 
?>
            </div>
            <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:rejectVoucher2b(".$voucher['Vouchers2b']['id'].");"));     
?>
            </div>
<?php
                }                       
            }else if($voucher['Vouchers2b']['is_approve_dfo'] == 'Y'){
?>
            <span style="color:green;font-weight:bold;">
                Voucher was approved on <?php echo h($funcall->DB2date($voucher['Vouchers2b']['approve_dfo_date']))?> by 
                <?php echo h($funcall->getDfoName($voucher['Vouchers2b']['approve_dfo_by']))?>.
            </span>
<?php
            }else if($voucher['Vouchers2b']['is_reject_dfo'] == 'Y'){
?>
            <span style="color:red;font-weight:bold;">
                Voucher was rejected on <?php echo h($funcall->DB2date($voucher['Vouchers2b']['reject_dfo_date']))?> by 
                <?php echo h($funcall->getDfoName($voucher['Vouchers2b']['reject_dfo_by']))?>.
            </span>
<?php
            }
        }else if($usertype_id == Configure::read('ACCOUNTANTUSERTTYPE')){
            if($voucher['Vouchers2b']['is_approve_accountant'] == 'N' && $voucher['Vouchers2b']['is_reject_accountant'] == 'N' && $voucher['Vouchers2b']['is_approve_dfo'] == 'N' && $voucher['Vouchers2b']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
            <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:approveVoucher2b(".$voucher['Vouchers2b']['id'].");")); 
?>
            </div>
            <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:rejectVoucher2b(".$voucher['Vouchers2b']['id'].");"));
?>
            </div>
<?php
                }                 
            }else if($voucher['Vouchers2b']['is_approve_accountant'] == 'Y'){
?>
            <span style="color:green;font-weight:bold;">
                Voucher was approved on <?php echo h($funcall->DB2date($voucher['Vouchers2b']['approve_accountant_date']))?> by 
                <?php echo h($funcall->getAccountName($voucher['Vouchers2b']['approve_accountant_by']))?>.
            </span>
<?php
            }else if($voucher['Vouchers2b']['is_reject_accountant'] == 'Y'){
?>
            <span style="color:red;font-weight:bold;">
                Voucher was rejected on <?php echo h($funcall->DB2date($voucher['Vouchers2b']['reject_accountant_date']))?> by 
                <?php echo h($funcall->getAccountName($voucher['Vouchers2b']['reject_accountant_by']))?>.
            </span>
<?php
            }
        }else{
            if($voucher['Vouchers2b']['is_approve_accountant'] == 'N' && $voucher['Vouchers2b']['is_reject_accountant'] == 'N' && $voucher['Vouchers2b']['is_approve_dfo'] == 'N' && $voucher['Vouchers2b']['is_reject_dfo'] == 'N'){
                echo '<span style="color:red;font-weight:bold">* The voucher was pending</span>';
            }
            if($voucher['Vouchers2b']['is_approve_accountant'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The voucher was approved by '.$funcall->getAccountName($voucher['Vouchers2b']['approve_accountant_by']).' on '.$funcall->DB2date($voucher['Vouchers2b']['approve_accountant_date']).'</span><br />';
            }
            if($voucher['Vouchers2b']['is_reject_accountant'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The voucher was rejected by '.$funcall->getAccountName($voucher['Vouchers2b']['reject_accountant_by']).' on '.$funcall->DB2date($voucher['Vouchers2b']['approve_accountant_date']).'</span><br />';
            }
            if($voucher['Vouchers2b']['is_approve_dfo'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The voucher was approved by '.$funcall->getDfoName($voucher['Vouchers2b']['approve_dfo_by']).' on '.$funcall->DB2date($voucher['Vouchers2b']['approve_dfo_date']).'</span><br />';
            }
            if($voucher['Vouchers2b']['is_reject_dfo'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The voucher was rejected by '.$funcall->getDfoName($voucher['Vouchers2b']['reject_dfo_by']).' on '.$funcall->DB2date($voucher['Vouchers2b']['reject_dfo_date']).'</span><br />';
            }
        }
?>       
        </td>       
    </tr>
<?php 
        $rowCnt++; 
    }
?>
</table>
</div>
<?php
    if(!isset($is_excel)){
    echo $this->Paginator->counter(array(
       'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
?>  
    <div class="box-footer clearfix">
        <div class="paging">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Vouchers2b',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
        )
    ));         
    echo $this->Paginator->prev('Previous', null,null, array('class' => 'disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next('Next', null,null, array('class' => 'disabled'));
    echo $this->Js->writeBuffer();
?>
        </div>
    </div> 
<?php
    }
}else{
?>
<span style="color:red;font-weight:bold;">No records found!!</span>
<?php    
}
?>