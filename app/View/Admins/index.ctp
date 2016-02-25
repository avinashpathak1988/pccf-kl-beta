<table border="0" cellspacing="5" cellpadding="5" class="table table-bordered">
<tr>
		<th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
		<th><?php echo $this->Paginator->sort('title',' Name'); ?></th>
		<th><?php echo $this->Paginator->sort('usertype_id',' User Type'); ?></th>
		<th><?php echo $this->Paginator->sort('email',' E-Mail ID'); ?></th>
		<th><?php echo $this->Paginator->sort('user_id',' User ID'); ?></th>
		<th><?php echo $this->Paginator->sort('is_enable','Is Enable ?'); ?></th>
		<th>Action</th>
	</tr>
	
<?php 
$i=0;
foreach($admins as $admin){
	?>
	<tr>
		<td><?php echo ++$i;  ?></td>
		<td><?php echo $admin['Admin']['title'];  ?></td>
		<td><?php echo $admin['Usertype']['title'];  ?></td>
		<td><?php echo $admin['Admin']['email'];  ?></td>
		<td><?php echo $admin['Admin']['user_id'];  ?></td>
		<td><?php echo $this->Message->show($admin['Admin']['is_enable']);  ?></td>
		<td>
			<?php 
			echo $this->Html->link('Edit',array(
				'controller'=>'admins',
				'action'=>'edit',$admin['Admin']['id']
			));
			 ?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <?php 
			echo $this->Html->link('Delete',array(
				'controller'=>'admins',
				'action'=>'delete',$admin['Admin']['id']
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