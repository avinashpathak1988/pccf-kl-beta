

      <?php echo $this->Form->create('Dfo');  ?>
	  <div class="box-body">
	  <table width="750" border="0" align="center" cellpadding="2" cellspacing="1">
        <tr>
          <td width="318">  <div class="form-group">                     
                     <?php echo $this->Form->input('title',array(
					 	'class'=>'form-control',
					 	'label'=>'Full Name'				 
					 ));  ?>
		</div></td>
          <td width="421"><div class="form-group"> <?php echo $this->Form->input('contact_number',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('email',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
          <td><div class="form-group"> <?php echo $this->Form->input('fax',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('postal_code',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><strong>Bank Details </strong><hr></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('bank_id',array(
					 	'class'=>'form-control',
					 	'options'=>$bank_id			 
					 ));  ?> </div></td>
          <td><div class="form-group"> <?php echo $this->Form->input('branch_name',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('branch_code',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
          <td><div class="form-group"> <?php echo $this->Form->input('account_holder_name',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('account_number',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
          <td><div class="form-group"> <?php echo $this->Form->input('ifsc',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><strong>Login Details </strong>
            <hr /></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('usertype_id',array(
					 	'class'=>'form-control',
					 	'label'=>'User Type',
					 	'options'=>$usertype_id			 
					 ));  ?> </div></td>
          <td><div class="form-group"> <?php echo $this->Form->input('user_id',array(
					 	'class'=>'form-control',
					 	'type'=>'text',
					 	'label'=>'User ID'				 
					 ));  ?> </div></td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('password',array(
					 	'class'=>'form-control'				 
					 ));  ?> </div></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><div class="form-group"> <?php echo $this->Form->input('is_enable',array(
					 	'class'=>'form-control',
					 	'options'=>$options_is_enable				 
					 ));  ?> </div></td>
          <td><div class="box-footer"> <?php echo $this->Form->end('Save'); ?> </div></td>
        </tr>
      </table>
      
                    
                 
                    
	  </div>
	  <!-- /.box-body -->
	  </form>

