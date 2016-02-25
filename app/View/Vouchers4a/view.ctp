<div style="float:right">
<?php
    if($usertype_id == Configure::read('ROUSERTTYPE')){
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Add New Voucher 4a',array('controller'=>'Vouchers4a','action'=>'add'),array('escape'=>false))?>&nbsp;&nbsp;
<?php
    }
?>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-list-alt"></i> Manage Voucher 4a',array('controller'=>'Vouchers4a','action'=>'index'),array('escape'=>false))?>&nbsp;&nbsp;
    <?php echo $this->Html->link($this->Html->image("print-icon.png",array("height" => "20","width" => "20","title"=>"Print Report")),'javascript:void(0);',array('onclick'=>'javascript:printfunc();','escape'=>false))?>
</div>
<div class="box-body" id="print_div">
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
        <tr>
            <td>
                <div class="form-group">
                    <?php echo "Code: ".$this->request->data['Vouchers4a']['code']; ?>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php echo "Book Number: ".$this->request->data['Vouchers4a']['book_number']; ?>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php echo "Page Number: ".$this->request->data['Vouchers4a']['page_number']; ?>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="form-group">
                    <?php echo "Date: ".date("d/m/Y",strtotime($this->request->data['Vouchers4a']['edate'])); ?> 
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php echo "Unit Number: ".$this->request->data['Vouchers4a']['unit_number']; ?> 
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?php echo "Fadi's Name: ".$this->request->data['Vouchers4a']['fadi_name']; ?> 
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <div class="form-group">
                <?php echo "Total Purchase Quantity: ".$this->Money->india($this->request->data['Vouchers4a']['total_purchase_quantity']); ?> </div>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
           <td colspan="4">
                <?php
                    if(is_array($this->data['Vouchers4adetail']) && count($this->data['Vouchers4adetail'])>0){
                    ?>              
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Khunti Name</th>
                                <th>Binding Card No.</th>
                                <th colspan="7">Quality Wise Binding Bundle Quantity <br> <span style="font-weight: normal;" >12(Twelve) Full</span></th>
                                <th>Test Binding &amp; Test Grading Result</th>
                            </tr>
                            <tr>
                                <th colspan="3">&nbsp;</th>
                                <th>Q I </th>
                                <th>Q III </th>
                                <th>Q IVS </th>
                                <th>Q MM </th>
                                <th>Q IV </th>
                                <th>Q I </th>
                                <th>Total</th>
                            </tr>                       
                        </thead>
                        <tbody>
                    <?php
                        $total_q1 = 0;
                        $total_q2 = 0;
                        $total_q3 = 0;
                        $total_q4 = 0;
                        $total_q5 = 0;
                        $total_q6 = 0;
                        $total_q_total = 0;
                        $cnt = 1;

                        foreach($this->data['Vouchers4adetail'] as $detailKey => $detailVal){
                            $total_q1 += $detailVal['q1'];
                            $total_q2 += $detailVal['q2'];
                            $total_q3 += $detailVal['q3'];
                            $total_q4 += $detailVal['q4'];
                            $total_q5 += $detailVal['q5'];
                            $total_q6 += $detailVal['q6'];
                            $total_q_total += $detailVal['q_total'];
                    ?>
                            <tr id="tr<?php echo $detailVal['id']?>">
                                <td align="left"><?php echo $cnt++; ?></td>
                                <td align="left"><?php echo h($detailVal['khunti_name'])?></td>
                                <td align="left"><?php echo h($detailVal['binding_card_number'])?></td>
                                <td align="left"><?php echo h($detailVal['q1'])?></td>
                                <td align="left"><?php echo h($detailVal['q2'])?></td>
                                <td align="left"><?php echo h($detailVal['q3'])?></td>
                                <td align="left"><?php echo h($detailVal['q4'])?></td>
                                <td align="left"><?php echo h($detailVal['q5'])?></td>
                                <td align="left"><?php echo h($detailVal['q6'])?></td>
                                <td align="left"><b><?php echo h($detailVal['q_total'])?></b></td>
                                <td align="left"><?php echo h($detailVal['grade'])?></td>
                            </tr>   
                    <?php
                        }
                    ?>
                            <tr style="font-weight: bold;">
                                <td colspan="2">Total</td>
                                <td align="left"><?php echo h($total_q1)?></td>
                                <td align="left"><?php echo h($total_q2)?></td>
                                <td align="left"><?php echo h($total_q3)?></td>
                                <td align="left"><?php echo h($total_q4)?></td>
                                <td align="left"><?php echo h($total_q5)?></td>
                                <td align="left"><?php echo h($total_q6)?></td>
                                <td align="left"><?php echo h($total_q_total)?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    }
                    ?>
           </td>
        </tr>
        <tr>
            <td colspan="4">
                <?php
                    if(is_array($this->data['Vouchers4aReport']) && count($this->data['Vouchers4aReport'])>0){
                    ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2"></th>
                            <th rowspan="2">MIII</th>
                            <th rowspan="2">IVM</th>
                            <th colspan="4">IVM</th>
                            <th rowspan="2">Total</th>
                        </tr>
                        <tr>
                            <th>I</th>
                            <th>II</th>
                            <th>III</th>
                            <th>TB</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($this->data['Vouchers4aReport'] as $reportKey => $reportVal){
                    ?>
                        <tr>
                            <td><strong>Previous Bundle</strong></td>
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['previous_bundle_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Today Bundle</strong></td>
                            <td>
            <?php 
                                echo $reportVal['today_bundle_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_bundle_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['today_bundle_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_bundle_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_bundle_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_bundle_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['today_bundle_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Total Bundle</strong></td>
                            <td>
            <?php 
                                echo $reportVal['total_bundle_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_bundle_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['total_bundle_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_bundle_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_bundle_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_bundle_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['total_bundle_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Before Filled Sack</strong></td>
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['before_filled_sack_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Today Filled Sack</strong></td>
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['today_filled_sack_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Total Filled Sack</strong></td>
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['total_filled_sack_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>No. of Sacks before godown storage</strong></td>
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['before_sacks_godown_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>No. of sacks to store today in godown </strong></td>
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['today_sacks_godown_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Total No. of sacks to be stored in godown </strong></td>
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['total_sacks_godown_total'];  
            ?>                                  
                            </td>       
                        </tr>   
                        <tr>
                            <td><strong>Before Grading Test </strong></td>
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['before_grading_test_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Today Grading Test </strong></td>
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['today_grading_test_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Total Grading Test </strong></td>
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['total_grading_test_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Total Days </strong></td>
                            <td>
            <?php 
                                echo $reportVal['total_days_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_days_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['total_days_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_days_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_days_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['total_days_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['total_days_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Average </strong></td>
                            <td>
            <?php 
                                echo $reportVal['average_miii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['average_ivm'];  
            ?>          
                            </td>               
                            <td>
            <?php 
                                echo $reportVal['average_ivm_i'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['average_ivm_ii'];  
            ?>      
                            </td>
                            <td>
            <?php 
                                echo $reportVal['average_ivm_iii'];  
            ?>              
                            </td>
                            <td>
            <?php 
                                echo $reportVal['average_ivm_tb'];  
            ?>              
                            </td>   
                            <td>
            <?php 
                                echo $reportVal['average_total'];  
            ?>                                  
                            </td>       
                        </tr>
                        <tr>
                            <td><strong>Previous Keri Count</strong></td>
                            <td colspan="7">
                                <?php echo $reportVal['previous_keri_count']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Today Keri Count</strong></td>
                            <td colspan="7">
                                <?php echo $reportVal['today_keri_count']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Total Keri Count</strong></td>
                            <td colspan="7">
                                <?php echo $reportVal['total_keri_count']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Total Working Days</strong></td>
                            <td colspan="7">
                                <?php echo $reportVal['today_work_days']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Average Working Days</strong></td>
                            <td colspan="7">
                                <?php echo $reportVal['average_work_days']; ?>
                            </td>
                        </tr> 
                        <?php
                    }
                ?>
                    </tbody>                
                </table>
                <?php
                    }
                ?>
            </td>
        </tr>
    </table>
</div>
<script>
function printfunc(){
    var printContents = document.getElementById("print_div").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}	
</script>