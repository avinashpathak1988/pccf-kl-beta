<div class="box-body">
    <div>
    
        <?php echo $this->Form->create('SearchForm',array('id'=>'searchForm','method'=>'POST'));?>
        <table class="table">
            <tr>
                <td  width="50%">
                    <label for="fyear">Financial Year :</label><br />
                    <strong><?php echo h($finanCial_year)?></strong>
                </td>
                <td>
                    <label for="fyear">Account Type :</label><br />
                    <strong><?php echo h($account_name)?></strong>                    
                </td>
            </tr>
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

            <tr>
                <td colspan="2" class="text-center">
                    <?php echo $this->Form->button('Search',array('type'=>'button','class'=>'btn btn-success','div'=>false,'label'=>false,'onclick'=>'javascript:showData();'))?>
                    <?php echo $this->Form->button('Reset',array('type'=>'reset','class'=>'btn btn-warning','div'=>false,'label'=>false))?>
                </td>
            </tr>
<?php
}
?>              
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
    var url = "<?php echo $this->Html->url(array('controller'=>'Report','action'=>'faVsExependitureAjax'))?>";
    url = url+'/ro_id:'+$('#ro_id').val();
    url = url+'/dfo_id:'+$('#dfo_id').val(); 
    $.post(url,{},function(res){ 
        $('#listingDiv').html(res);
        $('#lodding_image').hide();
    });     
}
function printfunc(){
    var printContents = document.getElementById("print_div").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>