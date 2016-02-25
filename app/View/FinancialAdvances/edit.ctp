<?php  
App::uses('Financialyear','Model');
App::uses('Account','Model');
App::uses('Ro','Model');
App::uses('Vouchersfasdetail','Model');
App::uses('VouchersfasAttachment','Model');

$this->Financialyear=new Financialyear();
$this->Account=new Account();
$this->Ro=new Ro();
$this->Vouchersfasdetail=new Vouchersfasdetail();
$this->VouchersfasAttachment=new VouchersfasAttachment();

//echo $this->Element('form_top');
?>

<?php echo $this->Form->create('Vouchersfa',array('type'=>'file')); ?>
 <div class="box-body">
	    <table width="750" border="0" align="center" cellpadding="2" cellspacing="1">
		<tr>
			<td>
				<?php echo $this->Form->input('id'); ?>
				<div class="form-group">
				<?php echo $this->Form->input('voucher_number',array(
						'class'=>'form-control',
						'readonly'=>true
					)); ?>				</div>			</td>
		</tr>
		<tr>
		  <td><table width="100%" border="1" cellpadding="2" cellspacing="1" style="border:10px; ">
            <tr>
              <td bgcolor="#E9E9E9"><strong>Purpose</strong></td>
              <td bgcolor="#E9E9E9"><strong>Particulars</strong></td>
              <td align="right" bgcolor="#E9E9E9"><strong>Qty.</strong></td>
              <td align="right" bgcolor="#E9E9E9"><strong>Amount</strong></td>
            </tr>
            
            <?php  
            //print_r($this->request->data['Vouchersfa']);
            $vdetails=$this->Vouchersfasdetail->find('all',array(
					'conditions'=>array(
							'voucher_number'=>$this->request->data['Vouchersfa']['voucher_number'],
						),
				));
				
				foreach($vdetails as $vd){
					?>
					 <tr>
              <td align="left" valign="top"><?php echo $this->Form->input('purpose[]',array(
					  	'class'=>'',
						'name'=>'purpose[]',
						'div'=>false,
					  	'label'=>false,
						'rows'=>3,
						'value'=>stripslashes($vd['Vouchersfasdetail']['purpose']),
					  ));  ?></td>
              <td align="left" valign="top"><?php echo $this->Form->input('particular',array(
					  	'class'=>'',
						'name'=>'particular[]',
						'div'=>false,
						'type'=>'text',
						'rows'=>'3',
						'label'=>false,
						'value'=>stripslashes($vd['Vouchersfasdetail']['particular']),
					  ));  ?></td>
              <td align="right" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any',
						'value'=>$vd['Vouchersfasdetail']['quantity'],
					  ));  ?></td>
              <td align="right" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any',
						'value'=>$vd['Vouchersfasdetail']['amount'],
					  ));  ?></td>
            </tr>
					<?php
					
				}	
            ?>
            
            
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
              <td align="right" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
              <td align="right" valign="top"><?php echo $this->Form->input('amount[]',array(
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
              <td align="right" valign="top"><?php echo $this->Form->input('quantity[]',array(
					  	'class'=>'form-control',
						'name'=>'quantity[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
              <td align="right" valign="top"><?php echo $this->Form->input('amount[]',array(
					  	'class'=>'form-control',
						'name'=>'amount[]',
						'type'=>'number',
						'label'=>false,
						'step'=>'any'
					  ));  ?></td>
            </tr>
           <!-- <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td align="right" bgcolor="#E9E9E9"><strong>Total</strong></td>
              <td align="center" bgcolor="#E9E9E9">&nbsp;</td>
           </tr>-->
          </table></td>
		  </tr>
		
		  <td><table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
              <td colspan="3"><strong><u>Attachment(s)</u></strong></td>
            </tr>
            <?php  
            $attachments=$this->VouchersfasAttachment->find('all',array(
					'conditions'=>array(
							'voucher_number'=>$this->request->data['Vouchersfa']['voucher_number'],
						),
				));
			
			$attachments_count=$this->VouchersfasAttachment->find('count',array(
					'conditions'=>array(
							'voucher_number'=>$this->request->data['Vouchersfa']['voucher_number'],
						),
				));	
				
				$aa=0;
				
				if($attachments_count > 0){
					foreach($attachments as $attachment){
				
            ?>
            <tr>
              <td width="3%" align="left" valign="top">
              	<?php echo ++$aa.")";  ?>
              </td>
              <td width="18%" align="left" valign="top">
              	<a href="<?php echo $this->webroot.'uploads/'.$attachment['VouchersfasAttachment']['attachment']; ?>" target="_BLANK">View Attachment</a>
              </td>
              <td width="79%" align="left" valign="top">
              	<?php  
              		echo $this->Html->link('Delete',array(
							'controller'=>'vouchersfas',
							'action'=>'delete_attachment',
							$attachment['VouchersfasAttachment']['id']
						));
              	?>
              </td>
            </tr>
            <?php  
					}
				}
            ?>
          </table></td>
		  </tr>
		<tr>
		  <td><strong><u>Upload New Attachment</u></strong></td>
		  </tr>
		<tr>
		  <td><input type="file" name="file1"></td>
		  </tr>
		<tr>
		  <td align="center"><?php echo $this->Form->end('Modify Voucher Details'); ?>
		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	
		  	<?php  
		  	echo $this->Html->link('Cancel',array(
					'controller'=>'vouchersfas',
					'action'=>'index'
				));
		  	?>
		  	
		  </td>
		  </tr>
		</table>
</div>		

<?php  
//echo $this->Element('form_buttom');
?>