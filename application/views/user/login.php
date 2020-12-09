
<div class="card card-login mx-auto">
<div class="card-header"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div>
<div class="card-body text-center">
    <div class="mb-2"><?php echo isset($alert_message) ? $alert_message : ''; ?></div>
    <a href="<?php echo base_url();?>"><img class="mb-1" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="100"></a>
    <h4 class="text-center">Employee Login</h4>
    <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin mt-3')); ?>
    <?php echo form_hidden('form_action', 'login'); ?>
    
    <div class="form-group">
      <label class="sr-only" for="user_email">Email</label>
      <?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Enter email address','maxlength' => '100','autofocus' => true));?>
      <?php echo form_error('user_email'); ?>
    </div>

    <div class="form-group">
      <label class="sr-only" for="user_password">Password</label>
      <?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Enter password','class' => 'form-control','maxlength' => '16'));?>
      <?php echo form_error('user_password'); ?>
    </div>

    <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Sign In','class' => 'btn ci-btn-primary btn-primary btn-block btn-lg mb-2'));?>
    <a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a>
  <?php echo form_close(); ?>
</div>
</div>