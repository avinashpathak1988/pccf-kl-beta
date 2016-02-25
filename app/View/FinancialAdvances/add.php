<style>
.box-primary{
	width:1050px !important;
}
</style>
<?php echo $this->Element('zebra'); ?>
<?php  
//echo $this->Element('form_top');
?>

      <?php echo $this->Form->create('Vouchersfa',array('type'=>'file'));  ?>
	  <div class="box-body">
	    <table width="750" border="0" align="center" cellpadding="2" cellspacing="1">
            <tr>
              <td width="253"><div class="form-group"> <?php echo "Financial Year: ".$fyear;  ?> </div></td>
              <td width="322"><div class="form-group"> <?php echo $this->Form->input('account_id',array(
					 	'class'=>'form-control',
					 	'label'=>'Head Of Service',
					 	'options'=>$account_id,
					 	'default'=>$this->Session->read('hos'),			 
					 ));  ?> </div></td>
              <td width="159"><div class="form-group"> <?php echo $this->Form->input('voucher_number',array(
					 	'class'=>'form-control',
					 	'label'=>'Voucher Number',
					 	'required'=>true			 
					 ));  ?> </div></td>
            </tr>
            <tr>
              <td><div class="form-group"> <?php echo $this->Form->input('voucher_date',array(
					 	'class'=>'form-control',
					 	'id'=>'voucher_date',
					 	'label'=>'Voucher Date',
					 	'required'=>true,
					 	'type'=>'text',
					 	'value'=>$default_date
				 
					 ));  ?> </div></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><table width="100%" border="0" cellpadding="2" cellspacing="1">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><table width="100%" border="1" cellpadding="2" cellspacing="1" style="border:10px; ">
                    <tr>
                      <td bgcolor="#E9E9E9"><strong>Purpose</strong></td>
                      <td bgcolor="#E9E9E9"><strong>Particulars</strong></td>
                      <td bgcolor="#E9E9E9"><strong>Qty.</strong></td>
                      <td align="center" bgcolor="#E9E9E9"><strong>Amount</strong></td>
                    </tr>
                    
                    <tr>
                      <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                      <td align="left" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td align="right" bgcolor="#E9E9E9"><strong>Total</strong></td>
                      <td align="center" bgcolor="#E9E9E9">&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            
            <tr>
              <td>Upload Attachments </td>
              <td colspan="2"><input type="file" id="file1" name="file1"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" align="center"><div class="form-group"> <?php echo $this->Form->end('Save',array('class'=>'form-control'));  ?> </div></td>
            </tr>
          </table>
	  </div>

<?php  
//echo $this->Element('form_buttom');
?>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"voucher_date",
			dateFormat:"%d-%m-%Y"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>

