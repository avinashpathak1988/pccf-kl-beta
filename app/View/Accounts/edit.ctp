 <div class="box-body">
<?php echo $this->Form->create('Account'); ?>
	<fieldset>

	<?php
		echo $this->Form->input('id');
		echo "<div class='form-group'>";
		echo $this->Form->input('title',array('label'=>'Head Of Service','class'=>'form-control'));
		echo "</div>";

		echo "<div class='form-group'>";
		echo $this->Form->input('parent_id',array('label'=>'Account Type','options'=>$parentAccounts,'class'=>'form-control'));
		echo "</div>";

		echo "<div class='form-group'>";
		echo $this->Form->input('detail',array('type'=>'text','class'=>'form-control'));
		echo "</div>";

		echo "<div class='form-group'>";
		echo $this->Form->input('is_enable',array('options'=>$options,'default'=>'1','class'=>'form-control','width'=>'100px'));
		echo "</div>";
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
