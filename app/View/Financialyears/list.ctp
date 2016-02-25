
<table border="0" cellspacing="5" cellpadding="5" class="table table-bordered">
	<tr>
		<th><?php echo $this->Paginator->sort('id','SL#'); ?></th>
		<th><?php echo $this->Paginator->sort('from_year','Financial Year'); ?></th>
		<th><?php echo $this->Paginator->sort('is_enable','Is Enable ?'); ?></th>
		<th><?php echo $this->Paginator->sort('is_default','Is Default ?'); ?></th>
		<th>Action</th>
	</tr>

	<?php  
	$i=0;
	foreach($fyears as $fy){
		?>
		<tr>
			<td><?php echo ++$i; ?></td>
			<td><?php echo $fy['Financialyear']['title']; ?></td>
			<td>
				<?php 
					echo $this->Message->show($fy['Financialyear']['is_enable']);
				 ?>
			</td>
			<td><?php 
					echo $this->Message->show($fy['Financialyear']['is_default']);
				 ?></td>
			<td>
				<?php 
				echo $this->Html->link('Edit',array(
					'controller'=>'financialyears',
					'action'=>'edit',$fy['Financialyear']['id']
				));
				 ?>&nbsp;&nbsp;||&nbsp;&nbsp;	
				 <?php 
				echo $this->Html->link('Delete',array(
					'controller'=>'financialyears',
					'action'=>'delete',$fy['Financialyear']['id']
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