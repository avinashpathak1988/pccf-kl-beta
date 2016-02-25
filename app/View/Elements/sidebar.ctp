<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <?php
            if(isset($menu) && is_array($menu) && count($menu)>0){
                $webProjectName = $this->webroot;
                $urlWithProjectName = $this->here;
                $required_url =  str_replace($webProjectName,"",$urlWithProjectName);
                foreach($menu as $key=>$val){
                    if(isset($menu[$key.'-icon'])){
                        $icon_class = '';
                        if(is_array($val) && count($val)>0){
                            $url = '#';
                        }else{
                            $url = '/'.$val;
                        }
                        $icon_class = $menu[$key.'-icon'];
                        $activeMEnu = '';
                        if($url != '#'){
                            if($required_url == $url){
                                $activeMEnu = 'active';
                            }
            ?>
            <li class="<?php echo $activeMEnu?>">
                <?php echo $this->Html->link('<i class="fa '.$icon_class.'"></i><span>'.$key, $url, array('escape'=>false)); ?>
            </li>
            <?php
            }else{
                if(is_array($val) && in_array($required_url,$val)){
                    $activeMEnu = 'active';
                }                
?>
<li class="<?php echo $activeMEnu?> treeview">
                <?php echo $this->Html->link('<i class="fa '.$icon_class.'"></i> <span>'.$key.'</span></span><i class="fa fa-angle-left pull-right"></i>', 'javascript:void(0);', array('escape'=>false)); ?>                
<?php
            }
            if(is_array($val) && count($val)>0){
?>
                <ul class="treeview-menu">
<?php            
                foreach($val as $sub_key=>$sub_val){
                    $activeSubMEnu = '';
                    if(is_array($sub_val)){
                        $sub_url = '#';
                    }else{
                        $sub_url = '/'.$sub_val;
                        if($required_url == $sub_val){
                            $activeSubMEnu = 'active';
                        }
                    }
?>
                    <li class="<?php echo $activeSubMEnu?>">
                        <?php echo $this->Html->link("<i class='fa fa-circle-o'></i> ".$sub_key, $sub_url, array('escape'=>false)); ?>
                    </li>
<?php                 
                } 
?>
                </ul>
<?php                      
            }
?>
            </li>
<?php 
        }       
    }
}
?>   
        </ul>
            
    </section>
</aside>