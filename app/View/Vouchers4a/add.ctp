<?php
if(isset($this->request->data['Vouchers4a']['edate']) && $this->request->data['Vouchers4a']['edate'] != ''){
    $this->request->data['Vouchers4a']['edate'] = $funcall->DB2date($this->request->data['Vouchers4a']['edate']);
}
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?> 
<div style="float:right;">
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 4a',array('controller'=>'Vouchers4a','action'=>'index'),array('escape'=>false))?>
</div>
<?php
    }
?>
<?php 
echo $this->Form->create('Vouchers4a', array('type' => 'file'));
echo $this->Form->input('id',array('type'=>'hidden','id'=>'vouchers4a_id'))
 ?>
<div class="box-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input("code", array('type'=>'text','label' => 'Code', 'class' => 'form-control', 'div'=>false)); ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input("book_number", array('type'=>'text','label' => 'Book Number', 'class' => 'form-control mobile','div'=>false, 'maxlength'=>10)); ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input("page_number", array('type'=>'text','label' => 'Page Number', 'class' => 'form-control mobile', 'div'=>false,'maxlength'=>70)); ?>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input('edate', array('label' => 'Date', 'class' => 'form-control my_date', 'type' => 'text','value'=>date('d-m-Y'),'readonly'=>true)); ?> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">            
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input('unit_number', array('type'=>'text','label' => 'Unit Number', 'class' => 'form-control','div'=>false,'maxlength'=>100)); ?> 
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input('fadi_name', array('type'=>'text','label' => 'Fadi\'s Name', 'class' => 'form-control', 'div'=>false,'maxlength'=>255)); ?> 
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <div class="form-group">
                    <?php echo $this->Form->input('total_purchase_quantity', array('type'=>'text','label' => 'Total Purchase Quantity', 'class' => 'form-control numeric','div'=>false,'maxlength'=>10)); ?> 
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <table class="table table-bordered"> 
        <tr>
            <th>Khunti Name</th>
            <th>Binding Card No.</th>
            <th colspan="7">Quality Wise Binding Bundle Quantity <br> <span style="font-weight: normal;" >12(Twelve) Full</span></th>
            <th>Test Binding &amp; Test Grading Result</th>
        </tr>
        <tr>
            <th colspan="2">&nbsp;</th>
            <th>Q I </th>
            <th>Q III </th>
            <th>Q IVS </th>
            <th>Q MM </th>
            <th>Q IV </th>
            <th>Q I </th>
            <th>Total</th>
            <th>&nbsp;</th>
        </tr> 
        <tr>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.khunti_name', array('label' => false, 'class' => 'form-control add_more_text', 'type' => 'text','maxlength'=>200,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.binding_card_number', array('label' => false, 'class' => 'form-control add_more_text', 'type' => 'text','maxlength'=>200,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q1', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q2', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q3', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q4', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q5', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q6', array('label' => false, 'class' => 'form-control  add_more_number mobile', 'type' => 'text','maxlength'=>10,'autoComplete'=> 'off')); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.q_total', array('label' => false, 'class' => 'form-control  add_more_text mobile','id'=>'totalCountAdd', 'type' => 'text','readonly'=>true)); ?>
            </td>
            <td>
                <?php echo $this->Form->input('Vouchers4adetail.0.grade', array('label' => false, 'class' => 'form-control add_more_text', 'type' => 'text','maxlength'=>200,'autoComplete'=> 'off')); ?>
            </td>
        </tr>  
    </table>
    <div class="row">
        <div align="center" class="col-lg-12 col-sm-12 col-xs-12">
            <?php echo $this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-success','div'=>false,'label'=>false))?>
        </div>
    </div>
    <?php echo $this->Form->end()?>
    <div class="row">
        <div id="listingDiv" align="center" class="col-lg-12 col-sm-12 col-xs-12">
            
        </div>
    </div>
</div>

<style type="text/css">
    .add_more_text {
        width: 100px;
    }
    .add_more_number {
        width: 80px;
    }
</style>
<?php
    $showDetailsUrl = $this->Html->url(array('controller'=>'Vouchers4a','action'=>'voucher4aDetails'));
    $deleteDetailsUrl = $this->Html->url(array('controller'=>'Vouchers4a','action'=>'voucher4aDetailsDelete'));
    echo $this->Html->scriptBlock("
        $(document).ready(function(){
            if($('#vouchers4a_id').val() != ''){
                showDetails();
            }
            $('.add_more_number').bind('blur', function () {
                var total = 0;
                $('.add_more_number').each(function () { 
                    total = Number(total) + Number($(this).val());
                });
                $('#totalCountAdd').val(total);
            });
        });
        function showDetails(){
            if($('#vouchers4a_id').val() != ''){
                var url = '".$showDetailsUrl."';
                $.post(url,{id:$('#vouchers4a_id').val()},function(res){ 
                    $('#listingDiv').html(res);
                });     
            }
        }
        function deleteDetail(id){
            if(id != ''){
                if(confirm('Are you sure to delete?')){
                    var url = '".$deleteDetailsUrl."';
                    $.post(url,{id:id},function(res){ 
                        if(res == 'SUCC'){
                            $('#tr'+id).hide('slow');
                            $('#tr'+id).remove();
                            showDetails();
                        }
                    });
                }       
            }
        }
    ");
?>