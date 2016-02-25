<div class="row">
            <div class="col-md-6">
              <div class="box" style="width:850px">
                <div class="box-header with-border">
                  <h3 class="box-title">
                  	<?php echo $title; ?>
                  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
	<table class="table table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
			<th><?php echo $this->Paginator->sort('title','Account type/Head Of Service'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id','Account Type'); ?></th>
			<th><?php echo $this->Paginator->sort('detail'); ?></th>
			<th><?php echo $this->Paginator->sort('is_enable','Is Enable ?'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>

	<?php 
	$i=0;
	foreach ($accounts as $account): ?>
	<tr>
		<td><?php echo ++$i; ?>&nbsp;</td>
		<td><?php echo h($account['Account']['title']); ?>&nbsp;</td>
		<td>
			<?php echo $account['ParentAccount']['title']; ?>
		</td>
		<td><?php echo h($account['Account']['detail']); ?>&nbsp;</td>
		<td><?php 
		if($account['Account']['is_enable'] == "1"){
			echo "<font color=green>Yes</font>";
		}else{
			echo "<font color=red>No</font>";
		}
		 ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $account['Account']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $account['Account']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $account['Account']['id']), array(), __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>

	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="box-footer clearfix">
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	</div>
</div>
</div>
</div>
</div>
