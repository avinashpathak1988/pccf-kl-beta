

            <?php echo $this->Form->create('Financialyear');  ?>
            
            <?php echo $this->Form->input('id'); ?>
            
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
					 	
					 ));  ?>
					</div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  	<?php echo $this->Form->end('Save'); ?>
                   
                  </div>
                </form>

              

&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
echo $this->Html->link('Cancel',array(
	'controller' => 'financialyears',
	'action' => 'listfy',
));
 ?>