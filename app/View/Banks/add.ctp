
            <?php echo $this->Form->create('Bank');  ?>
                  <div class="box-body">
                    
                   <div class="form-group">                     
                     <?php echo $this->Form->input('title',array(
					 	'class'=>'form-control'					 
					 ));  ?>
					</div>
                    
					<div class="form-group">                     
                     <?php echo $this->Form->input('is_enable',array(
					 	'class'=>'form-control',
					 	'options'=>$options_is_enable				 
					 ));  ?>
					</div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<?php echo $this->Form->end('Save'); ?>
                      
                       
                  </div>
                </form>