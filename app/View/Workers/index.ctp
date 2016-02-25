<table border="0" cellspacing="5" cellpadding="5" class="table table-bordered">
	<tr>
		<th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
        <th><?php echo $this->Paginator->sort('workercategory_id','Category'); ?></th>
		<th><?php echo $this->Paginator->sort('worker_code',' Code'); ?></th>
		<th><?php echo $this->Paginator->sort('title',' Name'); ?></th>
		<th><?php echo $this->Paginator->sort('card_number',' Card Number'); ?></th>
		<th><?php echo $this->Paginator->sort('contact_number','Contact Number'); ?></th>
		<th><?php echo $this->Paginator->sort('ro_id','RO'); ?></th>
		<th><?php echo $this->Paginator->sort('is_enable','Is Enable ?'); ?></th>
		<th>Action</th>
	</tr>
	
	<?php 
		$i=0;
		foreach($workers as $worker){
			?>
		<tr>
		<td><?php echo ++$i; ?></td>
        <td><?php echo $worker['Workercategory']['title']; ?></td>
		<td><?php echo $worker['Worker']['worker_code']; ?></td>
		<td><?php echo $worker['Worker']['title']; ?></td>
		<td><?php echo $worker['Worker']['card_number']; ?></td>
		<td><?php echo $worker['Worker']['contact_number']; ?></td>
		<td><?php echo $worker['Ro']['title']; ?></td>
		<td><?php echo $this->Message->show($worker['Worker']['is_enable']); ?></td>
		<td>
	
		<?php  
		echo $this->Html->link('Edit',array(
				'controller'=>'workers',
				'action'=>'edit',
				$worker['Worker']['id']
			));
		?>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;
		<?php  
		echo $this->Html->link('Delete',array(
				'controller'=>'workers',
				'action'=>'delete',
				$worker['Worker']['id']
			));
		?>
		
		</td>
		</tr>
			<?php
		}
		
	 ?>
	
	
</table>
<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="box-footer clearfix">
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ' '))."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	</div>