<?php
if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Purchase KL',array('controller'=>'Purchases','action'=>'add'),array('escape'=>false))?>
</div>
<?php
}
?>
<div class="box-body">
    <div>
        <?php echo $this->Form->create('SearchForm',array('method'=>'POST'));?> 
        <table class="table table-bordered">
<?php
    if($usertype_id != Configure::read('ROUSERTTYPE')){
?>         
            <tr>
                <td>
                    <?php echo $this->Form->input('dfo_id',array('type'=>'select','label'=>'DFO','id'=>'dfo_id','options'=>$dfoList,'class'=>'form-control','div'=>false))?>
                </td>
                <td id="rotdId">
                    <?php echo $this->Form->input('ro_id',array('type'=>'select','label'=>'Range Officer','id'=>'ro_id','options'=>$roList,'class'=>'form-control','div'=>false))?>
                </td>
            </tr>
<?php
    }
?>
            <tr>
                <td>
                    <?php echo $this->Form->input('fyear',array('type'=>'select','label'=>'Financial Year','id'=>'fyear','options'=>$fyear,'class'=>'form-control','div'=>false))?>
                </td>  
                <td id="rotdId">
                    <?php echo $this->Form->input('account_id',array('type'=>'select','label'=>'Head of Service','id'=>'account_id','options'=>$hos,'empty'=>'--All--','class'=>'form-control','div'=>false))?>
                </td>
            </tr>             
            <tr>
                <td>
                    <?php echo $this->Form->input('start_date',array('type'=>'text','label'=>'Start Date','id'=>'start_date','class'=>'form-control','div'=>false,'readonly'=>true))?>
                </td>  
                <td id="rotdId">
                    <?php echo $this->Form->input('end_date',array('type'=>'text','label'=>'End Date','id'=>'end_date','class'=>'form-control','div'=>false,'readonly'=>true))?>
                </td>
            </tr>  
            <tr>
                <td>
                    <?php echo $this->Form->input('voucher_status',array('type'=>'select','label'=>'Status','id'=>'voucher_status','class'=>'form-control','div'=>false,'options'=>array('P'=>'Pending','A'=>'Approved','R'=>'Rejected'),'empty'=>'--All--'))?>
                </td>            
                <td>
                    <?php echo $this->Form->button('Search',array('type'=>'button','class'=>'btn btn-success','div'=>false,'label'=>false,'onclick'=>'javascript:showData();'))?>
                    <?php echo $this->Form->button('Reset',array('type'=>'reset','class'=>'btn btn-warning','div'=>false,'label'=>false))?>
                </td>            
            </tr>            
        </table>
        <?php echo $this->Form->end();?>
    </div>
    <div id="listingDiv">
        
    </div>
</div>	
<script>
$(document).ready(function(){
    showData();
    $('#dfo_id').change(function(){
        var url = "<?php echo $this->Html->url(array('controller'=>'Common','action'=>'getRo'))?>";
        $.post(url,{'dfo_id':$('#dfo_id').val()},function(res){
            $('#rotdId').html(res);
        });
    });
});
function showData(){
    $('#lodding_image').show();
    var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'indexAjax'))?>";
    url = url+'/ro_id:'+$('#ro_id').val();
    url = url+'/dfo_id:'+$('#dfo_id').val();
    url = url+'/fyear:'+$('#fyear').val();
    url = url+'/account_id:'+$('#account_id').val();
    url = url+'/start_date:'+$('#start_date').val();
    url = url+'/end_date:'+$('#end_date').val();
    url = url+'/voucher_status:'+$('#voucher_status').val();    
    url = url+'/page:'+$('#page').val();
    $.post(url,{},function(res){ 
        $('#listingDiv').html(res);
        $('#lodding_image').hide();
    });     
}
function deletePurchase(PurchaseId){
    if(PurchaseId){
        if(confirm('Are you sure to delete?')){
            var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'delete'))?>";
            $.post(url,{id:PurchaseId},function(res){ 
                if(res.trim() == 'SUCC'){
                    showData();
                }
            }); 
        }
    }
}
function purchaseklApprove(purchaseklId){
    if(purchaseklId != ''){
        if(confirm('Are you sure to approve?')){
            var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'purchaseklApprove'))?>";
            $.post(url,{id:purchaseklId},function(res){ 
                if(res.trim() == 'SUCC'){
                    $('#td'+purchaseklId).html('<span style="color:green;font-weight:bold;">Approved Successfully</span>');
                }
            }); 
        }
    }    
}
function purchaseklReject(purchaseklId){
    if(purchaseklId != ''){
        var remarks=prompt("Enter Remarks");
        if(remarks){        
            if(confirm('Are you sure to reject?')){
                var url = "<?php echo $this->Html->url(array('controller'=>'Purchases','action'=>'purchaseklReject'))?>";
                $.post(url,{id:purchaseklId,'remarks':remarks},function(res){ 
                    if(res.trim() == 'SUCC'){
                        $('#td'+purchaseklId).html('<span style="color:red;font-weight:bold;">Rejected Successfully</span>');
                    }
                }); 
            }
        }
    }    
}
function printfunc(){
    var printContents = document.getElementById("print_div").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>