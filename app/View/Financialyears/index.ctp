

            <?php echo $this->Form->create('Financialyear');  ?>
                  <div class="box-body">
                    
                    <div class="form-group">                     
                     <?php echo $this->Form->input('from_year',array(
					 	'class'=>'form-control'
					 ));  ?>
					</div>
                    
                    <div class="form-group">                     
                     <?php echo $this->Form->input('to_year',array(
					 	'class'=>'form-control'
					 ));  ?>
					</div>
                    
                     <div class="form-group">                     
                     <?php echo $this->Form->input('is_enable',array(
					 	'class'=>'form-control',
					 	'options'=>$options_is_enable,
					 ));  ?>
					</div>
                    
					<div class="form-group">                     
                     <?php echo $this->Form->input('is_default',array(
					 	'class'=>'form-control',
					 	'options'=>$options_is_default,
					 	'default'=>0,
					 ));  ?>
					</div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<?php echo $this->Form->end('Save'); ?>
                   
                  </div>
                </form>

