<div class="cl-mcont box-body">
<?php echo $this->Form->create('MMenu',array('url'=>'/Rollmenus/m_menu','class'=>'master_table','admin'=>false)); ?>  
<?php echo $this->Form->input('id',array('type'=>'hidden','class'=> 'tbox','label'=>false,'div'=>false)); ?>
<div class="listtable innerPanel form-horizontal">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Menu Name: <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label"> Menu Url:</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('menu_url',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label"> Menu Icon:</label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('menu_icon',array('type'=>'text','class'=> 'form-control','label'=>false,'div'=>false)); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Menu Order : <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('menu_order',array('type'=>'text','class'=> 'form-control validate numeric','size' => 1,'maxlength' => 2,'label'=>false,'div'=>false)); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">Status <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <?php echo $this->Form->radio('is_active',array('Y'=>"Active",'N'=>'Inactive'),array('default'=>'Y','legend'=>false,'label'=>false,'separator'=>'&nbsp;&nbsp;&nbsp;')); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center"><?php  echo $this->Form->end(array('label'=>$button,'class'=>'btn btn-success','div'=>false));?></div>
</div>
<br><br>
<?php if(!empty($menuList)){ ?>
<div class="row">
    <div class="col-sm-12">
        <table class="listtable table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Menu Name</th>
                    <th>Menu URL</th>
                    <th>Menu Icon</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <!--<th class="blk2b" width="10px">Delete</th>-->
                </tr>
            </thead>
            <tbody>
                <?php foreach($menuList as $key => $val){ ?>
                <tr>
                    <td><?php echo $key+1?></td>
                    <td><?php echo h($val['MMenu']['name'])?></td>
                    <td><?php echo h($val['MMenu']['menu_url'])?></td>
                    <td><?php echo h($val['MMenu']['menu_order'])?></td>
                    <td><i class="fa <?php echo h($val['MMenu']['menu_icon'])?>"></i></td>
                    <td>
                    <?php 
                    if(($val['MMenu']['is_active']) == 'Y'){                        
                        echo 'Active';
                    }else{                        
                        echo 'Inactive';
                    }
                    ?>
                    </td>
                    <td>
                        <?php echo $this->Form->create('Menuedit',array('url'=>'/Rollmenus/m_menu','class'=>'master_table','admin'=>false)); ?>  
                        <?php echo $this->Form->input('id',array('type'=>'hidden','value'=> h($val['MMenu']['id']))); ?>
                        <?php echo $this->Form->end(array('label'=>'Edit','class'=>'btn btn-danger','div'=>false));?>
                    </td>
                    <?php /*<!--<td class="blk2" width="10px">
                        <?php echo $this->Form->create('Menudelete',array('url'=>'/Masters/m_menu','class'=>'master_table','admin'=>false)); ?>  
                        <?php echo $this->Form->input('m_menu_id',array('type'=>'hidden','value'=> $val['MMenu']['m_menu_id'])); ?>
                        <?php echo $this->Form->end(array('label'=>'Delete','class'=>'btn btn-primary','div'=>false,'onclick'=>'return confirm("Are you sure to delete this ?")'));?>
                    </td>-->*/?>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php }?>
</div>