<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin')); ?>
<?php echo form_hidden('form_action', 'login'); ?>
  <div class="mb-2"><?php echo isset($alert_message) ? $alert_message : ''; ?></div>
  <a href="<?php echo base_url();?>"><img class="mb-4" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="100"></a>
  <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
  <div class="form-group">
    <label class="sr-only" for="user_email">Email</label>
    <?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control py-4','placeholder' => 'Enter email address','maxlength' => '100','autofocus' => true,));?>
    <?php echo form_error('user_email'); ?>
  </div>

  <div class="form-group">
    <label class="sr-only" for="user_password">Password</label>
    <?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Enter password','class' => 'form-control py-4','maxlength' => '16'));?>
    <?php echo form_error('user_password'); ?>
  </div>

  <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Sign In','class' => 'btn ci-btn-primary btn-primary btn-block btn-lg'));?>
  <div class="my-3">
    <a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a>
  </div>
  <p class="mt-5 mb-3 text-muted"><?php echo $this->config->item('app_admin_copy_right');?> <br><?php echo $this->config->item('app_version');?></p>
  <?php echo form_close(); ?>