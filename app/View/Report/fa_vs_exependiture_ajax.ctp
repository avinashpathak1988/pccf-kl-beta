<?php
if(!isset($is_excel)){
?>
<div style="float:right">
<?php
    $exUrl = "faVsExependitureAjax/ro_id:$ro_id/dfo_id:$dfo_id";
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
}
?>
<div id="print_div"> 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="50%" align="center">FA</th>
                <th width="50%" align="center">Expenditures</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
<?php
$faSumArr = array();
if(is_array($faData) && count($faData)>0){
    foreach($faData as $faKey=>$faVal){
        $faSumArr[] = $faVal[0]['famount'];
?>
                    <div>
                        <?php echo h($funcall->DB2date($faVal['FinancialAdvance']['fa_date']))?>&nbsp;&nbsp;-&nbsp;&nbsp;
                        <?php echo h($this->Money->india($faVal[0]['famount']))?>
                    </div>
<?php                    
    }
}
?>                    
                </td>
                <td>
<?php
$expSumArr = array();
if(is_array($expData) && count($expData)>0){
    foreach($expData as $expKey=>$expVal){
        $expSumArr[] = $expVal[0]['expamount'];
?>
                    <div>
                        <?php echo h($funcall->DB2date($expVal['Expenditure']['entry_date']))?>&nbsp;&nbsp;-&nbsp;&nbsp;
                        <?php echo h($this->Money->india($expVal[0]['expamount']))?>
                    </div>
<?php                    
    }
}
    $faTot = array_sum($faSumArr);
    $expTot = array_sum($expSumArr);
    $pendExpTot = ($pendExpData[0][0]['expamount'] != '')?$pendExpData[0][0]['expamount']:0;
    $remaining = $faTot - ($expTot + $pendExpTot);
?>                     
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Total :</strong>&nbsp;<?php echo $this->Money->india($faTot)?>
                    <br /><?php echo ucfirst($this->Money->convert_number_to_words($faTot))?> only
                </td>
                <td>
                    <strong>Total :</strong>&nbsp;
                    <?php echo $this->Money->india($expTot)?>
                    <br /><?php echo ucfirst($this->Money->convert_number_to_words($expTot))?> only.<br />
                    <strong>Pending Voucher :</strong>&nbsp;<?php echo h($this->Money->india($pendExpTot))?>
                </td>
            </tr>
            <tr>
                <td align="right"><strong>Remaining Balance :</strong></td>
                <td>
                    <?php echo h($this->Money->india($remaining))?><br />
                    <?php echo ucfirst($this->Money->convert_number_to_words($remaining))?> only.
                </td>
            </tr>
        </tbody>
    </table>
</div>