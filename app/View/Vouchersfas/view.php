<?php  
App::uses('Financialyear','Model');
App::uses('Account','Model');
App::uses('Ro','Model');
App::uses('Vouchersfasdetail','Model');

$this->Financialyear=new Financialyear();
$this->Account=new Account();
$this->Ro=new Ro();
$this->Vouchersfasdetail=new Vouchersfasdetail();

//echo $this->Element('form_top');
foreach($voucher as $v){
?>
<div id="print_div">
 <div class="box-body">
	    <table width="750" border="0" align="center" cellpadding="2" cellspacing="1">
	    	<tr>
	    		<td width="140"><strong>
    			  Voucher Number :	    		</strong></td>
	    		<td width="124">
	    			<?php echo $v['voucher_number']; ?>	    		</td>
	    		<td width="110"><strong>
    			  Voucher Date :	    		</strong></td>
	    		<td width="147">
	    			<?php echo date("d/m/Y",strtotime($v['voucher_date'])); ?>	    		</td>
	    		<td width="109">
	    			<strong>Financial Year :	    		</strong></td>
	    		<td width="89">
	    			<?php 
	    			$fyear=$this->Financialyear->find('first',array(
							'conditions'=>array(
								'id'=>$v['fyear'],
							),
						));
					echo $fyear['Financialyear']['title'];	
	    			?>	    		</td>
	    	<tr>
    			<td><strong>
   			 	  Head Of Service :	    			</strong></td>
	    		<td>
	    			<?php 
	    			$hos=$this->Account->find('first',array(
							'conditions'=>array(
								'Account.id'=>$v['account_id'],
							),
						));
					echo $hos['Account']['title'];	
	    				?>		    		</td>
	    		<td><strong>
    			  Entered By		    		</strong></td>
	    		<td>
    			 	<?php 
		    				$ro=$this->Ro->findByUserId($v['user_id']);
							echo $ro['Ro']['title'];
		    			 ?>	    			</td>
	    		<td>		    		</td>
	    		<td>		    		</td>		    			
	    		</tr>
	    		<tr>
	    		  <td colspan="6" align="center"><hr></td>
   		  </tr>
	    		<tr>
	    		  <td colspan="6"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#EDEDED">
                    <tr>
                      <td width="17%" bgcolor="#D6D6D6"><strong>SL#</strong></td>
                      <td width="27%" bgcolor="#D6D6D6"><strong>Purpose</strong></td>
                      <td width="25%" bgcolor="#D6D6D6"><strong>Particular</strong></td>
                      <td width="15%" align="right" bgcolor="#D6D6D6"><strong>Quantity.</strong></td>
                      <td width="16%" align="right" bgcolor="#D6D6D6"><strong>Amount</strong></td>
                    </tr>
                    <?php  
                   $vdetails=$this->Vouchersfasdetail->find('all',array(
							'conditions'=>array(
								'voucher_number'=>$v['voucher_number'],
							),
							'order'=>array(
								'id'=>'asc'
							),
						));
					$j=0;	
					$total_amount=0;
					foreach($vdetails as $vd){
						$total_amount=$total_amount + $vd['Vouchersfasdetail']['amount'];
                    ?>
                    <tr style="background-color:<?php if((integer)($j%2) == 0){echo "#F2F2F2";}else{echo "white";} ?>">
                      <td ><?php echo ++$j; ?></td>
                      <td ><?php echo stripslashes($vd['Vouchersfasdetail']['purpose']); ?></td>
                      <td ><?php echo stripslashes($vd['Vouchersfasdetail']['particular']); ?></td>
                      <td align="right" ><?php echo $vd['Vouchersfasdetail']['quantity']; ?>&nbsp;&nbsp;</td>
                      <td align="right"><?php echo $this->Money->india($vd['Vouchersfasdetail']['amount']); ?>&nbsp;&nbsp;</td>
                    </tr>
                    <?php  
						}
                    ?>
                    <tr>
                      <td colspan="5" align="right" bgcolor="#FFFFFF"><hr></td>
                    </tr>
                    <tr>
                      <td colspan="4" align="right" bgcolor="#FFFFFF"><strong>Total&nbsp;&nbsp;</strong></td>
                      <td align="right"><b><?php echo $this->Money->india($total_amount); ?></b>&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" bgcolor="#FFFFFF"><strong>Attachments:</strong> Download </td>
                      <td colspan="4" align="right" valign="top" bgcolor="#FFFFFF"><em>(
                   	  <?php 
                      		echo "Rupees ".$this->Money->speak((integer)$total_amount); 
                      		$paisa=0;
							$paisa=explode(".",$total_amount);
							
							if(count($paisa) > 0){
								echo " and ".$this->Money->speak((integer)$paisa[1])." paisa ";
							}
							echo " Only ";
                      	?>)&nbsp;&nbsp;</em></td>
                    </tr>
                  </table></td>
   		  </tr>
	    		<tr>
	    		  <td colspan="6" align="center"><a href="#" onclick="printfunc()">Print</a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;<a href="">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp; <a href="">Add New Voucher</a></td>
   		  </tr>
	    </table>
</div>	 
</div>   	
<?php  
}
//echo $this->Element('form_buttom');
?>
<script>
	function printfunc(){
	 var printContents = document.getElementById("print_div").innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	}	
</script>