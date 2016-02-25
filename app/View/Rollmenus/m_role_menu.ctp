
<div class="cl-mcont box-body">
<div class="listtable innerPanel form-horizontal">
    <div class="form-group">
        <?php echo $this->Form->create('SearchMenu',array('url'=>'/Rollmenus/m_role_menu','class'=>'master_table','admin'=>false)); ?> 
        <label class="col-sm-3 control-label">Usertype: <?php echo Configure::read('reqVal') ?></label>
        <div class="col-sm-5">
            <?php echo $this->Form->input('usertype_id', array('label'=>false,'type'=>'select','class' =>'form-control','options' => $userTypeList,'value' =>$usertype_id,'empty' => '--Select--')); ?>
        </div>
        <?php echo $this->Form->end(array('label' => 'Search', 'class' => 'btn btn-success','div' => false)); ?> 
    </div>
</div>

            
<?php
if($usertype_id!=0){
?>
<div class="innerPanel">
<?php echo $this->Form->create('MRoleMenu',array('url'=>'/Rollmenus/m_role_menu','class'=>'master_table','admin'=>false)); ?>  
<?php echo $this->Form->input('id',array('type'=>'hidden','class'=> 'tbox','label'=>false,'div'=>false)); ?>
<?php echo $this->Form->input('usertype_id',array('type'=>'hidden','class'=> 'tbox','label'=>false,'div'=>false, 'value' => $usertype_id)); ?>

<?php
    foreach($menuList AS $key => $val){
        if($val['MMenu']['menu_url'] == ''){
?>
    <fieldset>
        <legend><?=$val['MMenu']['name']?></legend>
<?php
            foreach($val['MSubMenu'] AS $k => $v){
                if($v['sub_menu_url'] == ''){
?>
        <fieldset>
            <legend><?=$v['sub_menu_nm']?></legend>
<?php
                    foreach($v['MSubSubMenu'] AS $key1 => $val1){ 
                        if( $val1['sub_sub_menu_url'] == ''){
?>
            <fieldset>
                <legend><?=$v['sub_menu_nm']?><span class="red2b">*</span></legend>
                    <div style="float:left;width: 190px;margin-top: 10px;">
<?php
            echo $val1['sub_sub_menu_nm'];
?>
                    </div>
            </fieldset>
<?php
                        }else{
?>
            <div style="float: left;">
<?php
            $checked = '';   
                        if(in_array($val1['sub_sub_menu_id'],$editSubsubmenuList)){
                            $checked = "checked='checked'";
                        }    
                        echo $this->Form->checkbox("MRoleMenu.MSubSubMenu.",array('hiddenField'=>false,'value'=>$val1['sub_sub_menu_id'],$checked)); 
                        echo "&nbsp;&nbsp;&nbsp;".$val1['sub_sub_menu_nm'];
?>
            </div>
<?php   
                        }
                    }
?>                 
        </fieldset>
<?php
                }else{
?> 
        <div style="float:left;width:250px;">
<?php    
            $checked = '';   
                    if(in_array($v['id'],$editSubmenuList)){
                        $checked = "checked='checked'";
                    }
                    echo "<label style='font-weight:normal;cursor:pointer;'>&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo $this->Form->checkbox("MRoleMenu.MSubMenu.", array('hiddenField'  => false,'value'   => $v['id'], $checked));
                    echo "&nbsp;&nbsp;&nbsp;".$v['name']."</label>";
?>
        </div>
<?php  
                }
            }
?> 
    </fieldset>  
<?php
        }else{
?>
    <fieldset>
        <legend style="border-top : 1px solid #e5e5e5;">
<?php   
            $checked = '';  
            if(in_array($val['MMenu']['id'],$editMenuList)){
                $checked = "checked='checked'";
            }
            
            echo "<label style='font-weight:normal;cursor:pointer;'>&nbsp;&nbsp;&nbsp;&nbsp;";
            echo $this->Form->checkbox("MRoleMenu.MMenu.", array('hiddenField'  => false,'value' => $val['MMenu']['id'],$checked));
            echo "&nbsp;&nbsp;&nbsp;&nbsp;".$val['MMenu']['name']."</label>";
?>
        </legend>
    </fieldset>                 
<?php   
        }            
    }
?>
    <div class="text-center"><?php  echo $this->Form->end(array('label'=>'Save','class'=>'btn btn-success','div'=>false));?> </div>
<?php
}
?>
</div>
</div>