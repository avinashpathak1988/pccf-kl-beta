<?php
if($usertype_id != Configure::read('PCCFUSERTTYPE')){
?>
<div style="position:absolute;right:10px;top:5px;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New FA',array('controller'=>'FinancialAdvances','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success btn-sm'))?>
</div>
<?php
}
?>
<div class="box-body">
    <div class="box box-solid bg-green-gradient collapsed-box">
        <div class="box-header">
            <i class="fa fa-search"></i> <h3 class="box-title">Advance Search</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /. tools -->
        </div><!-- /.box-header -->       
        <div class="box-footer text-black" style="display: none;">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $this->Form->create('SearchForm',array('id'=>'searchForm','method'=>'POST'));?>
                        <table class="table">
                <?php
                if($usertype_id != Configure::read('ROUSERTTYPE')){
                ?>        
                            <tr>
                                <td width="50%">
                                    <?php echo $this->Form->input('dfo_id',array('type'=>'select','label'=>'DFO','id'=>'dfo_id','options'=>$dfoList,'class'=>'form-control','div'=>false))?>
                                </td>  
                                 <td width="50%">
                                    <?php 
                                    if(!in_array($usertype_id, array(Configure::read('PCCFUSERTTYPE'),Configure::read('ACCOUNTANTUSERTTYPE')))){
                                        echo $this->Form->input('advance_status',array('type'=>'select','label'=>'Advance Status','id'=>'advance_status','options'=>array("Taken"=>"Allocated","Given"=>"Given"),'class'=>'form-control','div'=>false,'onchange'=>"showRoList(this.value)"));
                                    }
                                    ?>
                                </td>  
                            </tr>
                            <tr>
                                 <td id="rotdId" style="display: <?php echo (!in_array($usertype_id, array(Configure::read('PCCFUSERTTYPE'),Configure::read('ACCOUNTANTUSERTTYPE')))) ? 'none' : 'display'; ?>;">
                                    <?php echo $this->Form->input('ro_id',array('type'=>'select','label'=>'Range Officer','id'=>'ro_id','options'=>$roList,'class'=>'form-control','div'=>false))?>
                                </td>
                            </tr>
                <?php
                }
                ?>            
                            <tr>
                                <td width="50%">
                                    <?php echo $this->Form->input('fyear',array('type'=>'select','label'=>'Financial Year','id'=>'fyear','options'=>$fyear,'class'=>'form-control','div'=>false,'default'=>$fyear_id))?>
                                </td>  
                                <td id="rotdId">
                                    <?php echo $this->Form->input('account_id',array('type'=>'select','label'=>'Account Type','id'=>'account_id','options'=>$hos,'empty'=>'--All--','class'=>'form-control','div'=>false,'default'=>$account_id))?>
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
                                <td colspan="2" class="text-center">
                                    <?php echo $this->Form->button('Search',array('type'=>'button','class'=>'btn btn-success','div'=>false,'label'=>false,'onclick'=>'javascript:showData();'))?>
                                    <?php echo $this->Form->button('Reset',array('type'=>'reset','class'=>'btn btn-warning','div'=>false,'label'=>false))?>
                                </td>
                            </tr>
                        </table>
                        <?php echo $this->Form->end();?>
                </div>
            </div>
        </div><!-- /.box -->
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
    var url = "<?php echo $this->Html->url(array('controller'=>'FinancialAdvances','action'=>'indexAjax'))?>";
    url = url+'/ro_id:'+$('#ro_id').val();
    url = url+'/dfo_id:'+$('#dfo_id').val();  
    url = url+'/fyear:'+$('#fyear').val();
    url = url+'/account_id:'+$('#account_id').val();
    url = url+'/start_date:'+$('#start_date').val();
    url = url+'/end_date:'+$('#end_date').val();
    url = url+'/advance_status:'+$('#advance_status').val();
    url = url+'/page:'+$('#page').val();
    $.post(url,{},function(res){ 
        $('#listingDiv').html(res);
        $('#lodding_image').hide();
    });     
}

function deleteFinacialAdvance(financialAdvancesId){
    if(financialAdvancesId != ''){
        if(confirm('Are you sure to delete?')){
            var url = "<?php echo $this->Html->url(array('controller'=>'FinancialAdvances','action'=>'financialAdvancesDelete'))?>";
            $.post(url,{id:financialAdvancesId},function(res){ 
                if(res.trim() == 'SUCC'){
                    showData();
                }
            }); 
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
function showRoList(status){
    if(status == 'Given'){
        $('#rotdId').show();
    }else{
        $('#rotdId').hide();
    }
}
</script>