<div class="cl-mcont box-body">
<?php echo $this->Form->create('MSubMenu',array('url'=>'/Rollmenus/m_sub_menu','class'=>'master_table','admin'=>false)); ?>  
<?php echo $this->Form->input('id',array('type'=>'hidden','class'=> 'tbox','label'=>false,'div'=>false)); ?>	
	<div class="listtable innerPanel form-horizontal">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Menu Name: <span class="text-danger">*</span></label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('m_menu_id', array('label'=> false,'type'=>'select','empty'=>'--select--','options' => $menuList,'class'=>'form-control','id' => 'm_menu_id')); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label"> Sub Menu Name:<span class="text-danger">*</span></label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('name',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Sub Menu Url: <span class="text-danger">*</span></label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('sub_menu_url',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Sub Menu Icon: </label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('sub_menu_icon',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label"> Sub Menu Order:<span class="text-danger">*</span></label>
					<div class="col-sm-8">
						<?php echo $this->Form->input('sub_menu_order',array('type'=>'text','class'=> 'form-control','size' => 1,'maxlength' => 2,'label'=>false,'div'=>false)); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">Status: <span class="text-danger">*</span></label>
					<div class="col-sm-8">
						<?php echo $this->Form->radio('is_active',array('Y'=>"Active",'N'=>'Inactive'),array('default'=>'Y','legend'=>false,'label'=>false,'separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-4 control-label">&nbsp;</label>
					<div class="col-sm-8">
						&nbsp;
					</div>
				</div>
			</div>				
		</div>
		<div align="center">
			<?php  echo $this->Form->end(array('label'=>$button,'class'=>'btn btn-success','div'=>false));?>
		</div>
	</div>
	<br><br>
<?php
if(!empty($submenuList)){
?>
    <table class="listtable table table-bordered table-striped">
		<thead>
			<tr>
				<th>Sl No.</th>
				<th>Menu Name</th>
				<th>Sub Menu Name</th>
				<th>Sub Menu URL</th>
				<th>Order</th>
				<th>Status</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
<?php
	foreach($submenuList as $key => $val){
?>
			<tr>
				<td><?php echo $key+1?></td>
				<td><?php echo h($val['MMenu']['name'])?></td>
				<td><?php echo h($val['MSubMenu']['name'])?></td>
				<td><?php echo h($val['MSubMenu']['sub_menu_url'])?></td>
				<td><?php echo h($val['MSubMenu']['sub_menu_order'])?></td>
				<td>
<?php 
		if($val['MSubMenu']['is_active'] == 'Y'){
			
			echo 'Active';
		}else{
			
			echo 'Inactive';
		}
?>
				</td>
				<td class="blk2" width="10px">
					<?php echo $this->Form->create('SubMenuedit',array('url'=>'/Rollmenus/m_sub_menu','class'=>'master_table','admin'=>false)); ?>  
					<?php echo $this->Form->input('id',array('type'=>'hidden','value'=> h($val['MSubMenu']['id']))); ?>
					<?php echo $this->Form->end(array('label'=>'Edit','class'=>'btn btn-success','div'=>false));?>
				</td>
				<td class="blk2" width="10px">
					<?php echo $this->Form->create('SubMenudelete',array('url'=>'/Rollmenus/m_sub_menu','class'=>'master_table','admin'=>false)); ?>  
					<?php echo $this->Form->input('id',array('type'=>'hidden','value'=> $val['MSubMenu']['id'])); ?>
					<?php echo $this->Form->end(array('label'=>'Delete','class'=>'btn btn-danger','div'=>false,'onclick'=>'return confirm("Are you sure to delete this ?")'));?>
				</td>
			</tr>
<?php
}
?>             
        </tbody>
	</table>
<?php
}
?>
</div>