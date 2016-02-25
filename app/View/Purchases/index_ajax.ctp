<?php
if(is_array($purchases) && count($purchases)>0){
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
<?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>  

    <div class="box-footer clearfix">
        <div class="paging">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Purchases',
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
    <table border="0" cellspacing="5" cellpadding="5" class="table table-bordered">
		<tr>
			<th>
                <?php echo $this->Paginator->sort('id','SL#'); ?>
                <?php echo $this->Form->input('page',array('type'=>'hidden','id'=>'page','value'=>$page))?>
            </th>
			<th><?php echo $this->Paginator->sort('edate',' Date'); ?></th>
			<th><?php echo $this->Paginator->sort('ro_id',' RO'); ?></th>
			<th><?php echo $this->Paginator->sort('book_number','Book No.'); ?></th>
			<th><?php echo $this->Paginator->sort('page',' Page'); ?></th>
			<th><?php echo $this->Paginator->sort('code','Code'); ?></th>
			<th>Amount</th>
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
<?php 
		$rowCnt = $this->Paginator->counter(array('format' => __('{:start}')));
		foreach($purchases as $purchase){
            $gt = 0;
            if(is_array($purchase['Purchasedetail']) && count($purchase['Purchasedetail'])>0){
                foreach($purchase['Purchasedetail'] as $purKey=>$purVal){
                    $gt = $gt + $purVal['amount'];
                }
            }
?>
		<tr>
			<td><?php echo $rowCnt; ?></td>
			<td><?php echo $funcall->DB2date($purchase['Purchase']['edate']); ?></td>
			<td><?php echo $purchase['Ro']['title']; ?></td>
			<td><?php echo $purchase['Purchase']['book_number']; ?></td>
			<td><?php echo $purchase['Purchase']['page']; ?></td>
			<td><?php echo $purchase['Purchase']['code']; ?></td>
			<td><?php echo $this->Money->india($gt); ?></td>
<?php
    if(!isset($is_excel)){
?>			
			<td>
                <div style="float:left;margin-right:5px;">
<?php  
            echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',array('controller'=>'purchases','action'=>'view',$purchase['Purchase']['id']),array('escape'=>false,'title'=>'View Report'));
?>                     
                </div>
<?php
        if($usertype_id == Configure::read('ROUSERTTYPE')){
            if($purchase['Purchase']['is_approve_accountant'] == 'N' && $purchase['Purchase']['is_approve_dfo'] == 'N'){
?>             
                <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editPurchaseForm',array('url'=>'/purchases/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$purchase['Purchase']['id']));
            echo $this->Form->button('<i class="glyphicon glyphicon-pencil"></i>',array('type'=>'submit','escape'=>false,'div'=>false,'style'=>"border:none;background:transparent;color:#72B3E1;",'title'=>'Edit Report'));
            echo $this->Form->end();
?>                     
                </div> 
                <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>','javascript:void(0);',array('escape'=>false,'title'=>'Delete Report','onclick'=>"javascript:deletePurchase(".$purchase['Purchase']['id'].");")); 
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
        	<td id="td<?php echo $purchase['Purchase']['id']?>">
<?php
        if($usertype_id == Configure::read('DFOUSERTTYPE')){
            if($purchase['Purchase']['is_approve_dfo'] == 'N' && $purchase['Purchase']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
            <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:purchaseklApprove(".$purchase['Purchase']['id'].");")); 
?>
            </div>
            <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:purchaseklReject(".$purchase['Purchase']['id'].");"));     
?>
            </div>
<?php  
                }                     
            }else if($purchase['Purchase']['is_approve_dfo'] == 'Y'){
?>
            <span style="color:green;font-weight:bold;">
                purchase was approved on <?php echo h($funcall->DB2date($purchase['Purchase']['approve_dfo_date']))?> by 
                <?php echo h($funcall->getDfoName($purchase['Purchase']['approve_dfo_by']))?>.
            </span>
<?php
            }else if($purchase['Purchase']['is_reject_dfo'] == 'Y'){
?>
            <span style="color:red;font-weight:bold;">
                purchase was rejected on <?php echo h($funcall->DB2date($purchase['Purchase']['reject_dfo_date']))?> by 
                <?php echo h($funcall->getDfoName($purchase['Purchase']['reject_dfo_by']))?>.
            </span>
<?php
            }
        }else if($usertype_id == Configure::read('ACCOUNTANTUSERTTYPE')){
            if($purchase['Purchase']['is_approve_accountant'] == 'N' && $purchase['Purchase']['is_reject_accountant'] == 'N' && $purchase['Purchase']['is_approve_dfo'] == 'N' && $purchase['Purchase']['is_reject_dfo'] == 'N'){
                if(!isset($is_excel)){
?>
            <div style="float:left;margin-right:6px;">
<?php                
                echo $this->Html->link('Approve','javascript:void(0);',array('class'=>'btn btn-success','onclick'=>"javascript:purchaseklApprove(".$purchase['Purchase']['id'].");")); 
?>
            </div>
            <div>
<?php
                echo $this->Html->link('Reject','javascript:void(0);',array('class'=>'btn btn-warning','onclick'=>"javascript:purchaseklReject(".$purchase['Purchase']['id'].");"));
?>
            </div>
<?php  
                }               
            }else if($purchase['Purchase']['is_approve_accountant'] == 'Y'){
?>
            <span style="color:green;font-weight:bold;">
                purchase was approved on <?php echo h($funcall->DB2date($purchase['Purchase']['approve_accountant_date']))?> by 
                <?php echo h($funcall->getAccountName($purchase['Purchase']['approve_accountant_by']))?>.
            </span>
<?php
            }else if($purchase['Purchase']['is_reject_accountant'] == 'Y'){
?>
            <span style="color:red;font-weight:bold;">
                purchase was rejected on <?php echo h($funcall->DB2date($purchase['Purchase']['reject_accountant_date']))?> by 
                <?php echo h($funcall->getAccountName($purchase['Purchase']['reject_accountant_by']))?>.
            </span>
<?php
            }
        }else{
            if($purchase['Purchase']['is_approve_accountant'] == 'N' && $purchase['Purchase']['is_reject_accountant'] == 'N' && $purchase['Purchase']['is_approve_dfo'] == 'N' && $purchase['Purchase']['is_reject_dfo'] == 'N'){
                echo '<span style="color:red;font-weight:bold">* The purchase was pending</span>';
            }
            if($purchase['Purchase']['is_approve_accountant'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The purchase was approved by '.$funcall->getAccountName($purchase['Purchase']['approve_accountant_by']).' on '.$funcall->DB2date($purchase['Purchase']['approve_accountant_date']).'</span><br />';
            }
            if($purchase['Purchase']['is_reject_accountant'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The purchase was rejected by '.$funcall->getAccountName($purchase['Purchase']['reject_accountant_by']).' on '.$funcall->DB2date($purchase['Purchase']['approve_accountant_date']).'</span><br />';
            }
            if($purchase['Purchase']['is_approve_dfo'] == 'Y'){
                echo '<span style="color:green;font-weight:bold">* The purchase was approved by '.$funcall->getDfoName($purchase['Purchase']['approve_dfo_by']).' on '.$funcall->DB2date($purchase['Purchase']['approve_dfo_date']).'</span><br />';
            }
            if($purchase['Purchase']['is_reject_dfo'] == 'Y'){
                echo '<span style="color:red;font-weight:bold">* The purchase was rejected by '.$funcall->getDfoName($purchase['Purchase']['reject_dfo_by']).' on '.$funcall->DB2date($purchase['Purchase']['reject_dfo_date']).'</span><br />';
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
        echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>  

    <div class="box-footer clearfix">
        <div class="paging">
<?php
    $this->Paginator->options(array(
        'update'                    => '#listingDiv',
        'evalScripts'               => true,
        'before'                    => '$("#lodding_image").show();',
        'complete'                  => '$("#lodding_image").hide();',
        'url'                       => array(
            'controller'            => 'Purchases',
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