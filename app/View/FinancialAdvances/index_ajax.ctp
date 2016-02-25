<?php
if(is_array($financial_advance) && count($financial_advance)>0){
    if(!isset($is_excel)){
        if($usertype_id != Configure::read('ACCOUNTANTUSERTTYPE')){
?>
<table class="table table-border bg-yellow">
    <tr>
        <?php
        $faDetails = $funcall->getFaDetails();
        if($usertype_id != Configure::read('PCCFUSERTTYPE')){
            ?>
            <td><b>Total Advance Received : </b> <?php echo $this->Money->india($faDetails['advance_taken']); ?></td>
            <?php
        }       
        if($usertype_id != Configure::read('ROUSERTTYPE')){
            ?>
            <td><b>Total Advance Given : </b> <?php echo $this->Money->india($faDetails['advance_given']); ?></td>
            <?php
        }
        if($usertype_id == Configure::read('DFOUSERTTYPE')){
            ?>
            <td><b>Total Remaining Balance : </b> <?php echo $this->Money->india($faDetails['balance']); ?></td>
            <?php
        }
        ?> 
    </tr>
</table>
<?php
}
?>
<div style="float:right">
<?php
    $exUrl = "indexAjax/ro_id:$ro_id/dfo_id:$dfo_id/page:$page/fyear:$fyear/account_id:$account_id/start_date:$start_date/end_date:$end_date";
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
            'controller'            => 'FinancialAdvances',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
            'fyear'                 => $fyear, 
            'account_id'            => $account_id,  
            'start_date'            => $start_date, 
            'end_date'              => $end_date,       
            'advance_status'        => $advance_status,   
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
                <th><?php echo $this->Paginator->sort('account_id','Account Type'); ?> </th>
                <th><?php echo $this->Paginator->sort('from_user_id','From'); ?> </th>
                <th><?php echo $this->Paginator->sort('Created_by','To'); ?> </th>
        		<th><?php echo $this->Paginator->sort('fa_date','Advance Receipt Date'); ?> </th>
        		<th><?php echo $this->Paginator->sort('amount','Amount'); ?></th>
                <th><?php echo $this->Paginator->sort('remarks','Remarks'); ?></th>
<?php
    if(!isset($is_excel)){
?>                
            <th width="20%">Action</th>    
<?php
    }
?>                
                
        	</tr>
        </thead>
        <tbody>
	
<?php 
	$rowCnt = $this->Paginator->counter(array('format' => __('{:start}')));
	foreach($financial_advance as $advance){       
?>
    		<tr>
    			<td><?php echo $rowCnt; ?></td>
                <td><?php echo h($advance['Account']['title'])?></td>
                <td>
                <?php 
                    if($advance['FinancialAdvance']['from_usertype_id'] == Configure::read('DFOUSERTTYPE')){
                        echo $funcall->getDfoName($advance['FinancialAdvance']['from_user_id']);
                    }
                    if($advance['FinancialAdvance']['from_usertype_id'] == Configure::read('PCCFUSERTTYPE')){
                        echo $funcall->getPccfName($advance['FinancialAdvance']['from_user_id']);
                    }
                 ?>
                </td>
                <td>
                <?php 
                    if($advance['FinancialAdvance']['usertype_id'] == Configure::read('DFOUSERTTYPE')){
                        echo $funcall->getDfoName($advance['FinancialAdvance']['created_by']);
                    }
                    if($advance['FinancialAdvance']['usertype_id'] == Configure::read('ROUSERTTYPE')){
                        echo $funcall->getRoName($advance['FinancialAdvance']['created_by']);
                    }
                 ?>
                </td>
    			<td><?php echo $funcall->DB2date($advance['FinancialAdvance']['fa_date']); ?></td>
    			<td align="right"><?php echo h($this->Money->india($advance['FinancialAdvance']['amount']))?></td>
                <td><?php echo h(substr($advance['FinancialAdvance']['remarks'], 0, 150)); ?></td>
<?php
    if(!isset($is_excel)){
?>                
    			<td>
                <div style="float:left;margin-right:5px;">
<?php
                 echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>',array('controller'=>'FinancialAdvances','action'=>'view',$advance['FinancialAdvance']['id']),array('title'=>'View','escape'=>false));
                 ?>
                 </div>
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Form->create('editFinancialAdvanceForm',array('url'=>'/FinancialAdvances/add')); 
            echo $this->Form->input('id',array('type'=>'hidden','label '=>false,'div'=>false,'value'=>$advance['FinancialAdvance']['id']));
            echo $this->Form->button('<i class="glyphicon glyphicon-pencil"></i>',array('type'=>'submit','escape'=>false,'div'=>false,'style'=>"border:none;background:transparent;color:#72B3E1;",'title'=>'Edit'));
            echo $this->Form->end();
?>                     
                    </div>
                    <div style="float:left;margin-right:5px;">
<?php
            echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>','javascript:void(0);',array('title'=>'Delete','escape'=>false,'onclick'=>"javascript:deleteFinacialAdvance(".$advance['FinancialAdvance']['id'].");"));
?>
                    </div>
        		</td>
<?php
    }
?>                
              		
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
            'controller'            => 'FinancialAdvances',
            'action'                => 'indexAjax',
            'ro_id'                 => $ro_id,
            'dfo_id'                => $dfo_id,
            'page'                  => $page,
            'fyear'                 => $fyear, 
            'account_id'            => $account_id,  
            'start_date'            => $start_date, 
            'end_date'              => $end_date,     
            'advance_status'        => $advance_status,      
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