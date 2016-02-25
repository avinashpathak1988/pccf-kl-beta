<?php echo $this->Form->create('Vouchers4a',array('type'=>'file'));  ?>

<div class="box-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
            </div>
        </div>
    </div>
          <table width="950" border="0" align="center" cellpadding="2" cellspacing="1" >
            <tr>
                <td> <div class="form-group">
                        <?php echo $this->Form->input("code",array(
                            'label'=>'Code',
                            'class'=>'form-control',
                        )); ?> 
                    </div>  </td>
                <td>
                   <div class="form-group">
                        <?php echo $this->Form->input("book_number",array(
                            'label'=>'Book Number',
                            'class'=>'form-control',
                        )); ?>                    </div>                </td>
                <td> <div class="form-group">
                        <?php echo $this->Form->input("page_number",array(
                            'label'=>'Page Number',
                            'class'=>'form-control',
                        )); ?> 
                    </div></td>
            </tr>  
            
            <tr>
                <td>
                <div class="form-group">
                <?php echo $this->Form->input('edate',array(
                    'label'=>'Date',
                    'placeholder'=>'dd/mm/yyyy',
                    'class'=>'form-control',
                    'value'=>date("d/m/Y"),
                    'type'=>'text'
                )); ?>                </div>                </td>
                <td>
                <div class="form-group">
                <?php echo $this->Form->input('unit_number',array(
                    'label'=>'Unit Number',
                    'class'=>'form-control'
                )); ?>                </div>                </td>
                <td>
                <div class="form-group">
                <?php echo $this->Form->input('fadi_name',array(
                    'label'=>'Fadi\'s Name',
                    'class'=>'form-control',
                )); ?>                </div>                </td>
            </tr>
            
            <tr>
                <td>
                <div class="form-group">
                <?php echo $this->Form->input('total_purchase_quantity',array(
                    'label'=>'Total Purchase Quantity',
                    'class'=>'form-control'
                )); ?>                </div>                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
              <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E5E5E5">
                <tr>
                  <td width="5%" rowspan="2" align="left" valign="top" bgcolor="#C4C4C4"><strong>SL#</strong></td>
                  <td width="10%" rowspan="2" align="left" valign="top" bgcolor="#C4C4C4"><strong>Khunti Name </strong></td>
                  <td width="13%" rowspan="2" align="left" valign="top" bgcolor="#C4C4C4"><strong>Binding Card No. </strong></td>
                  <td  colspan="7" align="center" valign="top" bgcolor="#C4C4C4"><strong>Quality Wise Binding Bundle Quantity </strong></td>
                  <td width="19%" rowspan="2" align="center" valign="top" bgcolor="#C4C4C4"><strong>Test Binding &amp; Test Grading Result</strong> <br>
                    <a href="#" id="addrows" onClick="return addMore()">Add More Rows</a> </td>
                </tr>
                <tr>
                  <td colspan="7" align="left" valign="top" bgcolor="#C4C4C4"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E8E8E8">
                      <tr>
                        <td colspan="7" align="center">12(Twelve) Full </td>
                      </tr>
                      <tr>
                        <td width="11%">Q I </td>
                        <td width="14%">Q III </td>
                        <td width="10%">Q IVS </td>
                        <td width="13%">Q MM </td>
                        <td width="11%">Q IV </td>
                        <td width="15%">Q I </td>
                        <td width="26%">Total</td>
                      </tr>
                    </table></td>
                </tr>
               
                 <tr>
				 <td colspan="11">
				
				   <table width="100%" border="1" id="mytable">
                    <?php  
                 for($i=0;$i<1;$i++){
                 ?>   
				 
                <tr>
                  <td width="6%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="sl_no[]" type="number" class="form-control" style="width:50px" />                  </td>
                  <td width="11%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="khunti_name[]" type="text" class="form-control" style="width:100px" />                  </td>
                  <td width="11%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="binding_card_number[]" type="text" class="form-control" style="width:100px" />                  </td>
                  <td width="6%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q1[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="6%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q2[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="7%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q3[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="7%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q4[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="7%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q5[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="6%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q6[]" type="number" step="any" class="form-control" style="width:50px" />                  </td>
                  <td width="20%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="q_total[]" type="number" step="any" class="form-control" style="width:100px" />                  </td>
                  <td width="13%" align="left" valign="top" bgcolor="#FFFFFF">
                  <input name="grade[]" type="text" class="form-control" style="width:100px" />                  </td>
                </tr>
                <?php  
                }
                ?>
                   </table>				 </td>
				 </tr>
             
                
                <tr>
                  <td colspan="3" align="right" valign="top"><strong>Total&nbsp;&nbsp;</strong></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q1_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q2_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q3_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q4_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q5_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="q6_total" type="number" step="any" class="form-control" style="width:50px" /></td>
                  <td align="left" valign="top" bgcolor="#C4C4C4"><input name="total_q_total" type="number" step="any" class="form-control" style="width:100px" /></td>
                  <td align="left" valign="top"><input name="grand_total" type="text" class="form-control" style="width:100px" /></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td colspan="3" align="center"><div class="form-group"> <?php echo $this->Form->end('Save',array(
                                 'class'=>'form-control'
                )); ?> </div></td>
            </tr>
          </table>
</div>
      
<?php  
//echo $this->Element('form_buttom');
?>          

<script>
function addMore(){
  $("#addrows").click(function () {
     $("#mytable").each(function () {
         var tds = '<tr>';
         jQuery.each($('tr:last td', this), function () {
             tds += '<td>' + $(this).html() + '</td>';
         });
         tds += '</tr>';
         if ($('tbody', this).length > 0) {
             $('tbody', this).append(tds);
         } else {
             $(this).append(tds);
         }
     });
});
    return false;
}    
</script>