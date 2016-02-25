<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-box-body">
      <h4 class="login-box-msg">Sign in to PCCF KL</h4>
      <?php echo $this->Form->create('User'); ?>
         
      <div class='form-group'>
          <label>Username</label>
         <?php echo $this->Form->input('user_id',array('type'=>'text','class'=> 'form-control','label'=>false,'placeholder'=>'Enter User Name','autocomplete'=>'off','div'=>false,'required'=>true)); ?>
      </div>
      <div class="clear"></div>

      <div class='form-group'>
          <label>Password</label>
          <?php echo $this->Form->input('password',array('type'=>'password','class'=> 'form-control','label'=>false,'placeholder'=>'Enter Password','autocomplete'=>'off','div'=>false,'required'=>true)); ?>
      </div>
      <div class="clear"></div>         	

      <center>
        <?php echo $this->Form->button('<i class="fa fa-sign-in"></i> LOGIN',array('type'=>'submit','div'=>false,'label'=>false,'class'=>"btn btn-success btn-block btn-flat",'value'=>'LOGIN',))?> 
      </center>
      <div class="cleardiv"></div>
    </div>

  <?php echo $this->Form->end();?>
  </div>
    </div>
  </div>
</div>