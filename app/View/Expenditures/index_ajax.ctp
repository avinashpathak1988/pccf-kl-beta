<?php
if(is_array($data) && count($data)>0){
    if(!isset($is_excel)){
?>
<div style="float:right">
<?php
    $exUrl = "indexAjax/ro_id:$ro_id/dfo_id:$dfo_id/page:$page/start_date:$start_date/end_date:$end_date/voucher_status:$voucher_status";
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
            'controller'            => 'Expenditures',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'fyear'                 => $fyear,
            'account_id'            => $account_id,             
            'page'                  => $page, 
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
                <th><?php echo $this->Paginator->sort('fyear','Financial Year'); ?></th>
                <th><?php echo $this->Paginator->sort('account_id','Account Type'); ?></th>
        		<th><?php echo $this->Paginator->sort('voucher_no','Voucher No.'); ?></th>
        		<th><?php echo $this->Paginator->sort('voucher_date','Voucher Date'); ?></th>
                <th><?php echo $this->Paginator->sort('hos_id','Head of Service'); ?></th>
                <th><?php echo $this->Paginator->sort('entry_date','Entry Date'); ?></th>
        		<th><?php echo $this->Paginator->sort('amount','Amount'); ?></th>
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
	foreach($data as $voucher){
?>
    		<tr>
    			<td><?php echo $rowCnt; ?></td>
                <td><?php echo $voucher['Financialyear']['title'];?></td> 
                <td><?php echo $voucher['Account']['title'];?></td> 
    			<td><?php echo $voucher['Expenditure']['voucher_no']; ?></td>
    			<td><?php echo $funcall->DB2date($voucher['Expenditure']['voucher_date']); ?></td>
                <td><?php echo $funcall->getHOSName($voucher['Expenditure']['hos_id']); ?></td>
                <td><?php echo $funcall->DB2date($voucher['Expenditure']['entry_date']); ?></td>
    			<td><?php echo h($this->Money->india($voucher['Expenditure']['amount']))?></td>
<?php
        if(!isset($is_excel)){
?>                
    			<td>
                    <div style="float:left;margin-right:5px;">
<?php  
                echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',array('controller'=>'Expenditures','action'=>'view',$voucher['Expenditure']['id']),array('escape'=>false,'title'=>'View Report'));
?>            
                    </div>            
<?php
            if($usertype_id == Configure::read('ROUSERTTYPE')){
                if($voucher['Expenditure']['is_approved_dfo'] == 'N' && $voucher['Expenditure']['is_rejected_dfo'] == 'N'){ 
?>            
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editExpForm',array('url'=>'/Expenditures/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$voucher['Expenditure']['id']));
            echo $this->Form->button('<i class="glyphicon glyphicon-pencil"></i>',array('type'=>'submit','escape'=>false,'div'=>false,'style'=>"border:none;background:transparent;color:#72B3E1;",'title'=>'Edit Report'));
            echo $this->Form->end();
?>                     
                    </div>
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>','javascript:void(0);',array('title'=>'Delete','escape'=>false,'onclick'=>"javascript:deleteExpenditure(".$voucher['Expenditure']['id'].");"));
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
                <td>
<?php

        if($voucher['Expenditure']['is_approved_dfo'] == 'N' && $voucher['Expenditure']['is_rejected_dfo'] == 'N'){
            if(!isset($is_excel)){
                if($usertype_id == Configure::read('DFOUSERTTYPE')){
?>
                    <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:approveExpenditures(".$voucher['Expenditure']['id'].");")); 
?>
                    </div>
                    <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:rejectExpenditures(".$voucher['Expenditure']['id'].");"));     
?>
                    </div>
<?php
                }else if($usertype_id == Configure::read('ACCOUNTANTUSERTTYPE')){
                    echo $this->Html->link('Remarks','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:remarksExpenditure(".$voucher['Expenditure']['id'].");")); 
                }else{
?>
                    <span style="color:red;font-weight:bold;">
                        Expenditure was pending.
                    </span>
<?php                    
                }
            }                       
        }else if($voucher['Expenditure']['is_approved_dfo'] == 'Y'){
?>
                    <span style="color:green;font-weight:bold;">
                        Expenditure was approved on <?php echo h($funcall->DB2date($voucher['Expenditure']['approved_dfo_date']))?> by 
                        <?php echo h($funcall->getDfoName($voucher['Expenditure']['action_dfo_by']))?>.
                    </span>
<?php
        }else if($voucher['Expenditure']['is_rejected_dfo'] == 'Y'){
?>
                    <span style="color:red;font-weight:bold;">
                        Expenditure was rejected on <?php echo h($funcall->DB2date($voucher['Expenditure']['rejected_dfo_date']))?> by 
                        <?php echo h($funcall->getDfoName($voucher['Expenditure']['action_dfo_by']))?>.
                    </span>
<?php
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
            'controller'            => 'Expenditures',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'fyear'                 => $fyear,
            'account_id'            => $account_id,              
            'page'                  => $page,
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