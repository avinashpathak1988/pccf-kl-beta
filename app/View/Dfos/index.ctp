
<table border="0" cellspacing="5" cellpadding="5" class="table table-bordered">
	<tr>
		<th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
		<th><?php echo $this->Paginator->sort('title',' Name'); ?></th>
		<th><?php echo $this->Paginator->sort('contact_number',' Contact Number'); ?></th>
		<th><?php echo $this->Paginator->sort('email',' E-Mail ID'); ?></th>
		<th><?php echo $this->Paginator->sort('user_id',' User ID'); ?></th>
		<th><?php echo $this->Paginator->sort('is_enable','Is Enable ?'); ?></th>
		<th>Action</th>
	</tr>
	
	<?php  
		$i=0;
		foreach($dfos as $dfo){
			?>
		<tr>
		<td><?php echo ++$i; ?></td>
		<td><?php echo $dfo['Dfo']['title']; ?></td>
		<td><?php echo $dfo['Dfo']['contact_number']; ?></td>
		<td><?php echo $dfo['Dfo']['email']; ?></td>
		<td><?php echo $dfo['Dfo']['user_id']; ?></td>
		<td><?php echo $this->Message->show($dfo['Dfo']['is_enable']); ?></td>
		<td>
			<?php  
				echo $this->Html->link('Edit',array(
						'controller'=>'dfos',
						'action'=>'edit',$dfo['Dfo']['id']
					));
			?>&nbsp;&nbsp;&nbsp;&nbsp;
			<?php  
				echo $this->Html->link('Delete',array(
						'controller'=>'dfos',
						'action'=>'delete',$dfo['Dfo']['id']
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