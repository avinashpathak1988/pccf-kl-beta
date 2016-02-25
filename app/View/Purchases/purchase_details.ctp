<?php
if(is_array($details) && count($details)>0){
?>              
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Collector's Name</th>
            <th>Card No.</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Amount</th>  
            <th>Action</th>                 
        </tr>                      
    </thead>
    <tbody>
<?php
    $cnt = 0;
    $amountSum = array();
    foreach($details as $detailKey=>$detailVal){
        $cnt++;
        if($detailVal['Purchasedetail']['amount'] != ''){
            $amountSum[] = $detailVal['Purchasedetail']['amount'];
        }else{
            $amountSum[] = 0;
        }       
?>
        <tr>
            <td align="left"><?php echo $cnt?></td>
            <td align="left"><?php echo h($detailVal['Worker']['title'])?></td>
            <td align="left"><?php echo h($detailVal['Purchasedetail']['card_number'])?></td>
            <td align="left"><?php echo h($detailVal['Purchasedetail']['quantity'])?></td>
            <td align="right"><?php echo h($this->Money->india($detailVal['Purchasedetail']['unit_price']))?></td>
            <td align="right"><?php echo h($this->Money->india($detailVal['Purchasedetail']['amount']))?></td>
            <td>
                <?php echo $this->Form->button('Delete',array('label'=>false,'class'=>'btn btn-danger','div'=>false,'onclick'=>"deleteDetail(".$detailVal['Purchasedetail']['id'].")"));?>                                
            </td>
        </tr>   
<?php
    }
?>
        <tr>
            <td colspan="5" align="right"><strong>Total:</strong></td>
            <td align="right"><strong><?php echo $this->Money->india(array_sum($amountSum))?></strong></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php
}
?>