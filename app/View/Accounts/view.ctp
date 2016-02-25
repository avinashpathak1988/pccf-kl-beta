<div class="accounts view">
<h2><?php echo __('Account'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($account['Account']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($account['Account']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($account['ParentAccount']['title'], array('controller' => 'accounts', 'action' => 'view', $account['ParentAccount']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Detail'); ?></dt>
		<dd>
			<?php echo h($account['Account']['detail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Enable'); ?></dt>
		<dd>
			<?php echo h($account['Account']['is_enable']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($account['Account']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($account['Account']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account'), array('action' => 'edit', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account'), array('action' => 'delete', $account['Account']['id']), array(), __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Allocation Details'), array('controller' => 'allocation_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Allocation Detail'), array('controller' => 'allocation_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Accounts'); ?></h3>
	<?php if (!empty($account['ChildAccount'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Detail'); ?></th>
		<th><?php echo __('Is Enable'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['ChildAccount'] as $childAccount): ?>
		<tr>
			<td><?php echo $childAccount['id']; ?></td>
			<td><?php echo $childAccount['title']; ?></td>
			<td><?php echo $childAccount['parent_id']; ?></td>
			<td><?php echo $childAccount['detail']; ?></td>
			<td><?php echo $childAccount['is_enable']; ?></td>
			<td><?php echo $childAccount['created']; ?></td>
			<td><?php echo $childAccount['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'accounts', 'action' => 'view', $childAccount['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'accounts', 'action' => 'edit', $childAccount['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'accounts', 'action' => 'delete', $childAccount['id']), array(), __('Are you sure you want to delete # %s?', $childAccount['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Allocation Details'); ?></h3>
	<?php if (!empty($account['AllocationDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Allocation Id'); ?></th>
		<th><?php echo __('Account Id'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Detail'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Sub Account Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($account['AllocationDetail'] as $allocationDetail): ?>
		<tr>
			<td><?php echo $allocationDetail['id']; ?></td>
			<td><?php echo $allocationDetail['allocation_id']; ?></td>
			<td><?php echo $allocationDetail['account_id']; ?></td>
			<td><?php echo $allocationDetail['amount']; ?></td>
			<td><?php echo $allocationDetail['detail']; ?></td>
			<td><?php echo $allocationDetail['created']; ?></td>
			<td><?php echo $allocationDetail['modified']; ?></td>
			<td><?php echo $allocationDetail['sub_account_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'allocation_details', 'action' => 'view', $allocationDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'allocation_details', 'action' => 'edit', $allocationDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'allocation_details', 'action' => 'delete', $allocationDetail['id']), array(), __('Are you sure you want to delete # %s?', $allocationDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Allocation Detail'), array('controller' => 'allocation_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
