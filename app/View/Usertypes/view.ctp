<div class="usertypes view">
<h2><?php echo __('Usertype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usertype['Usertype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($usertype['Usertype']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Enable'); ?></dt>
		<dd>
			<?php echo h($usertype['Usertype']['is_enable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($usertype['Usertype']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($usertype['Usertype']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usertype'), array('action' => 'edit', $usertype['Usertype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usertype'), array('action' => 'delete', $usertype['Usertype']['id']), array(), __('Are you sure you want to delete # %s?', $usertype['Usertype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usertypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usertype'), array('action' => 'add')); ?> </li>
	</ul>
</div>
