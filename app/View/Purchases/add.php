

      <?php echo $this->Form->create('Purchase',array('type'=>'file'));  ?>
	  <div class="box-body">
	    <table width="800" border="0" cellpadding="2" cellspacing="1">
                <tr>
                  <td width="227" align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('book_number',array(
						'class'=>'form-control',
					)); ?> </div></td>
                  <td width="286" align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('page',array(
						'class'=>'form-control',
						'label'=>'Page Number',
					)); ?> </div></td>
                  <td width="271" align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('code',array(
						'class'=>'form-control',
						'label'=>'Code',
					)); ?> </div></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('fadi_name',array(
						'class'=>'form-control',
						'label'=>'Fadi\'s Name',
					)); ?> </div></td>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('edate',array(
						'class'=>'form-control',
						'label'=>'Entry Date',
						'type'=>'text',
						'placeholder'=>'dd/mm/yyyy',
						'value'=>date('d/m/Y')
					)); ?> </div></td>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('unit_number',array(
						'class'=>'form-control',
						'label'=>'Unit Number',
					)); ?> </div></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('ro_id',array(
						'class'=>'form-control',
						'label'=>'RO',
						'disable'=>true,
						'readonly'=>true,
						'options'=>$ros,
					)); ?> </div></td>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('entered_by',array(
						'class'=>'form-control',
						'label'=>'Entered By',
					)); ?> </div></td>
                  <td align="left" valign="top"><div class="form-group"> <?php echo $this->Form->input('verified_by',array(
						'class'=>'form-control',
						'label'=>'Verified By',
					)); ?> </div></td>
                </tr>
                <tr>
                  <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#F1F1F1">
                    <tr>
                      <td align="left" valign="top" bgcolor="#DEDEDE"><strong>Collector's Name </strong></td>
                      <td align="left" valign="top" bgcolor="#DEDEDE"><strong>Card Number </strong></td>
                      <td align="left" valign="top" bgcolor="#DEDEDE"><strong>Quantity</strong></td>
                      <td align="left" valign="top" bgcolor="#DEDEDE"><strong>Unit Price </strong></td>
                      <td align="left" valign="top" bgcolor="#DEDEDE"><strong>Total Price </strong></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><div class="form-group"> <?php echo $this->Form->input('worker_id',array(
						'class'=>'form-control',
						'label'=>false,
						'options'=>$workers,
						'empty'=>'--Select Collector--',
						'onChange'=>'showCard(this.value)',
					)); ?> </div></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><div class="form-group"> <?php echo $this->Form->input('card_number',array(
						'class'=>'form-control',
						'label'=>false
					)); ?> </div></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><div class="form-group"> <?php echo $this->Form->input('quantity',array(
						'class'=>'form-control',
						'label'=>false,
						'onKeyup'=>'calctotal()'
					)); ?> </div></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><div class="form-group"> <?php echo $this->Form->input('unit_price',array(
						'class'=>'form-control',
						'step'=>'any',
						'type'=>'number',
						'label'=>false,
						'onKeyup'=>'calctotal()'
					)); ?> </div></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><div class="form-group"> <?php echo $this->Form->input('amount',array(
						'class'=>'form-control',
						'step'=>'any',
						'type'=>'number',
						'label'=>false
					)); ?> </div></td>
                    </tr>

                    <tr>
                      <td colspan="5" align="left" valign="top" bgcolor="#FFFFFF"><input type="file" name="file1"></td>
                    </tr>
                  </table></td>
                </tr>

                <tr>
                  <td colspan="3" align="center" valign="top">
                  	<div class="form-group"> 
                  	<?php  
echo $this->Form->end('Save');
?>
</div>
</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="top">
				  <div id="loaditems">
				  <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#F1F1F1">
                    <tr>
                      <td width="7%" align="left" valign="top" bgcolor="#DEDEDE"><strong>SL#</strong></td>
                      <td width="22%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Collector's Name </strong></td>
                      <td width="25%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Card No. </strong></td>
                      <td width="16%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Quantity</strong></td>
                      <td width="11%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Unit Price </strong></td>
                      <td width="13%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Total Price </strong></td>
                      <td width="6%" align="left" valign="top" bgcolor="#DEDEDE"><strong>Action</strong></td>
                    </tr>
                    <?php  
                    $j=0;
					$gt=0;
					//echo "<pre>";
					//print_r($data);
                   foreach($data as $d){
                   	$j++;
                    ?>
                    <tr id="<?php echo "div".$j; ?>">
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $j; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Worker']['title']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Worker']['card_number']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Purchasedetail']['quantity']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Purchasedetail']['unit_price']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $this->Money->india($d['Purchasedetail']['amount']); 
					  $gt=$gt + $d['Purchasedetail']['amount'];
					  ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><a href="#" onclick="deletediv(<?php echo $d['Purchasedetail']['id']; ?>)">Delete</a></td>
                    </tr>
                    <?php  
				   }
                    ?>
                    <tr>
                      <td colspan="7" align="center" valign="top" bgcolor="#FFFFFF"><strong>Grand Total: &nbsp;&nbsp;<font color=green><?php echo $this->Money->india($gt); ?></font></strong></td>
                    </tr>
                  </table>
				  </div>
				  </td>
                </tr>
        </table>
  	  </div>
	 <script>
	 	function showCard(str){
	 		if(str != ''){
	 			var url="<?php echo $this->webroot; ?>workers/fetchcard/"+str;
	 			$.get(url, function(data, status){
		        document.getElementById("PurchaseCardNumber").value=data;
		   		 });
	 		}else{
	 			document.getElementById("PurchaseCardNumber").value="";
	 		}
	 	}
		
		function calctotal(){
			var quantity=document.getElementById("PurchaseQuantity").value;
			var unit_price=document.getElementById("PurchaseUnitPrice").value;
			var amount=0;

			
			if(isNaN(quantity) || isNaN(unit_price)){
				amount=0;
			}else{
				amount=parseFloat(quantity) * parseFloat(unit_price);
				amount=amount.toFixed(2);
				
			}
			document.getElementById("PurchaseAmount").value=amount;
			
		}
		
		function deletediv(str){
			alert(str);
			var url="<?php echo $this->webroot; ?>Purchases/deleteitem/"+str;
			$.get(url, function(data, status){
		           document.getElementById("loaditems").innerHtml=<?php echo $this->Element("Ajax/purchases"); ?>;
		   		 });
			//var divid=str.id;
			//document.getElementById(str.id).style.display="none";
		}
	 </script>
		        