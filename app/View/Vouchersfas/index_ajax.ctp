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
<div class="clearfix">
    <ul class="pagination">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Vouchersfas',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
            'fyear'                 => $fyear, 
            'account_id'            => $account_id,  
            'start_date'            => $start_date, 
            'end_date'              => $end_date, 
            'voucher_status'        => $voucher_status,             
        )
    ));         
    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Js->writeBuffer();
?>
    </ul>
</div>
<?php
    }
?>
<div id="print_div"> 
    <table class="table table-bordered">
        <thead>
        	<tr>
        		<th>
                    <?php echo $this->Paginator->sort('id','SL#'); ?>
                    <?php echo $this->Form->input('page',array('type'=>'hidden','id'=>'page','value'=>$page))?>
                </th>
        		<th><?php echo $this->Paginator->sort('voucher_number','Voucher Number'); ?></th>
        		<th><?php echo $this->Paginator->sort('voucher_date','Voucher Date'); ?></th>
        		<th>Amount</th>
        		<th>Head Of Service</th>
<?php
    if(!isset($is_excel)){
?>                
                <th width="10%">
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
        </thead>
        <tbody>
	
<?php 
	$rowCnt = $this->Paginator->counter(array('format' => __('{:start}')));
	foreach($vouchers as $voucher){
        $amt = 0;
        if(is_array($voucher['Vouchersfasdetail']) && count($voucher['Vouchersfasdetail'])>0){
            foreach($voucher['Vouchersfasdetail'] as $faKey=>$faVal){
                $amt = $amt + $faVal['amount'];
            }
        }
?>
    		<tr>
    			<td><?php echo $rowCnt; ?></td>
    			<td><?php echo $voucher['Vouchersfa']['voucher_number']; ?></td>
    			<td><?php echo $funcall->DB2date($voucher['Vouchersfa']['voucher_date']); ?></td>
    			<td><?php echo h($this->Money->india($amt))?></td>
    			<td><?php echo $voucher['Account']['title'];?></td>	
<?php
    if(!isset($is_excel)){
?>                
    			<td>
                    <div style="float:left;margin-right:5px;">
<?php  
                echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',array('controller'=>'vouchersfas','action'=>'view',$voucher['Vouchersfa']['id']),array('escape'=>false,'title'=>'View Report'));
?>            
                    </div>            
<?php
        if($usertype_id == Configure::read('ROUSERTTYPE')){
            if($voucher['Vouchersfa']['is_approve_accountant'] == 'N' && $voucher['Vouchersfa']['is_approve_dfo'] == 'N'){ 
?>            
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editVoucherfaForm',array('url'=>'/vouchersfas/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$voucher['Vouchersfa']['id']));
            echo $this->Form->button('<i class="glyphicon glyphicon-pencil"></i>',array('type'=>'submit','escape'=>false,'div'=>false,'style'=>"border:none;background:transparent;color:#72B3E1;",'title'=>'Edit Report'));
            echo $this->Form->end();
?>                     
                    </div>
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>','javascript:void(0);',array('title'=>'Delete','escape'=>false,'onclick'=>"javascript:deleteVoucherfa(".$voucher['Vouchersfa']['id'].");"));
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
                <td id="td<?php echo $voucher['Vouchersfa']['id']?>">
<?php
        if($usertype_id == Configure::read('DFOUSERTTYPE')){
            if($voucher['Vouchersfa']['is_approve_dfo'] == 'N' && $voucher['Vouchersfa']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
                    <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:approveVoucherfas(".$voucher['Vouchersfa']['id'].");")); 
?>
                    </div>
                    <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:rejectVoucherfas(".$voucher['Vouchersfa']['id'].");"));     
?>
                    </div>
<?php
                }                       
            }else if($voucher['Vouchersfa']['is_approve_dfo'] == 'Y'){
?>
                    <span style="color:green;font-weight:bold;">
                        Voucher was approved on <?php echo h($funcall->DB2date($voucher['Vouchersfa']['approve_dfo_date']))?> by 
                        <?php echo h($funcall->getDfoName($voucher['Vouchersfa']['approve_dfo_by']))?>.
                    </span>
<?php
            }else if($voucher['Vouchersfa']['is_reject_dfo'] == 'Y'){
?>
                    <span style="color:red;font-weight:bold;">
                        Voucher was rejected on <?php echo h($funcall->DB2date($voucher['Vouchersfa']['reject_dfo_date']))?> by 
                        <?php echo h($funcall->getDfoName($voucher['Vouchersfa']['reject_dfo_by']))?>.
                    </span>
<?php
            }
        }else if($usertype_id == Configure::read('ACCOUNTANTUSERTTYPE')){
            if($voucher['Vouchersfa']['is_approve_accountant'] == 'N' && $voucher['Vouchersfa']['is_reject_accountant'] == 'N' && $voucher['Vouchersfa']['is_approve_dfo'] == 'N' && $voucher['Vouchersfa']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
                    <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:approveVoucherfas(".$voucher['Vouchersfa']['id'].");")); 
?>
                    </div>
                    <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:rejectVoucherfas(".$voucher['Vouchersfa']['id'].");"));
?>
                    </div>
<?php 
                }                
            }else if($voucher['Vouchersfa']['is_approve_accountant'] == 'Y'){
?>
                    <span style="color:green;font-weight:bold;">
                        Voucher was approved on <?php echo h($funcall->DB2date($voucher['Vouchersfa']['approve_accountant_date']))?> by 
                        <?php echo h($funcall->getAccountName($voucher['Vouchersfa']['approve_accountant_by']))?>.
                    </span>
<?php
            }else if($voucher['Vouchersfa']['is_reject_accountant'] == 'Y'){
?>
                    <span style="color:red;font-weight:bold;">
                        Voucher was rejected on <?php echo h($funcall->DB2date($voucher['Vouchersfa']['reject_accountant_date']))?> by 
                        <?php echo h($funcall->getAccountName($voucher['Vouchersfa']['reject_accountant_by']))?>.
                    </span>
<?php
            }
        }else{
            if($voucher['Vouchersfa']['is_approve_accountant'] == 'N' && $voucher['Vouchersfa']['is_reject_accountant'] == 'N' && $voucher['Vouchersfa']['is_approve_dfo'] == 'N' && $voucher['Vouchersfa']['is_reject_dfo'] == 'N'){
                echo '<span style="color:red;font-weight:bold">* The voucher was pending</span>';
            }
            if($voucher['Vouchersfa']['is_approve_accountant'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The voucher was approved by '.$funcall->getAccountName($voucher['Vouchersfa']['approve_accountant_by']).' on '.$funcall->DB2date($voucher['Vouchersfa']['approve_accountant_date']).'</span><br />';
            }
            if($voucher['Vouchersfa']['is_reject_accountant'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The voucher was rejected by '.$funcall->getAccountName($voucher['Vouchersfa']['reject_accountant_by']).' on '.$funcall->DB2date($voucher['Vouchersfa']['approve_accountant_date']).'</span><br />';
            }
            if($voucher['Vouchersfa']['is_approve_dfo'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The voucher was approved by '.$funcall->getDfoName($voucher['Vouchersfa']['approve_dfo_by']).' on '.$funcall->DB2date($voucher['Vouchersfa']['approve_dfo_date']).'</span><br />';
            }
            if($voucher['Vouchersfa']['is_reject_dfo'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The voucher was rejected by '.$funcall->getDfoName($voucher['Vouchersfa']['reject_dfo_by']).' on '.$funcall->DB2date($voucher['Vouchersfa']['reject_dfo_date']).'</span><br />';
            }
        }
?>       
                </td>			
    		</tr>	
<?php
        $rowCnt++;
	}
?>
        </tbody>
    </table>
</div>
<?php
    if(!isset($is_excel)){
    echo $this->Paginator->counter(array(
       'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
?>  
<div class="clearfix">
    <ul class="pagination">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Vouchersfas',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
            'fyear'                 => $fyear, 
            'account_id'            => $account_id,  
            'start_date'            => $start_date, 
            'end_date'              => $end_date, 
            'voucher_status'        => $voucher_status,             
        )
    ));         
    echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
    echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
    echo $this->Js->writeBuffer();
?>
    </ul>
</div> 
<?php
    }
}else{
?>
<span style="color:red;font-weight:bold;">No records found!!</span>
<?php    
}
?>