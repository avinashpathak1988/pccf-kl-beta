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
                    <tr>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $j; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Worker']['title']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Worker']['card_number']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Purchasedetail']['quantity']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $d['Purchasedetail']['unit_price']; ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $this->Money->india($d['Purchasedetail']['amount']); 
					  $gt=$gt + $d['Purchasedetail']['amount'];
					  ?></td>
                      <td align="left" valign="top" bgcolor="#FFFFFF"><a href="#" onclick="deletediv(<?php echo 'div'.$j; ?>)">Delete</a></td>
                    </tr>
                    <?php  
				   }
                    ?>
                    <tr>
                      <td colspan="7" align="center" valign="top" bgcolor="#FFFFFF"><strong>Grand Total: &nbsp;&nbsp;<font color=green><?php echo $this->Money->india($gt); ?></font></strong></td>
                    </tr>
                  </table>