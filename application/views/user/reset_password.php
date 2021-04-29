<div class="row justify-content-center align-items-center" style="height:100vh">
   <div class="col-sm-6 col-lg-4 login-card-wrapper">
      <div class="card">
         <div class="card-header py-3 text-center"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div>
         <div class="card-body">
            <div class="mb-2"><?php echo isset($alert_message) ? $alert_message : ''; ?></div>
            <div class="text-center mb-4"><a href="<?php echo base_url();?>"><img class="" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="80"></a></div>
            <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin mt-3')); ?>
            <?php echo form_hidden('form_action', 'reset_password'); ?>
            <?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
            <?php echo form_error('user_email'); ?>
            <div class="form-group">
               <label class="sr-only" for="password_reset_key">OTP</label>
               <?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => 'Enter 6-digit email OTP', 'class' => 'form-control py-4', 'maxlength' => '6', 'autofocus' => '' )); ?>
               <?php echo form_error('password_reset_key'); ?>
            </div>
            <div class="form-group">
               <label class="sr-only" for="user_new_password">New Password</label>
               <?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'Enter a new password', 'class' => 'form-control py-4', 'maxlength' => '20', )); ?>
               <?php echo form_error('user_new_password'); ?>
            </div>
            <div class="form-group">
               <label class="sr-only" for="confirm_user_new_password">Confirm Password</label>
               <?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Re-enter password', 'class' => 'form-control py-4', 'maxlength' => '20', )); ?>
               <?php echo form_error('confirm_user_new_password'); ?>
            </div>
            <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn btn-lg btn-primary btn-block btn-lg'));?>
            <div class="text-center mt-4">
               <a href="<?php echo base_url($this->router->class.'/login');?>">Go to login</a> <br>
               <a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Re-send Email OTP</a>
            </div>
            <?php echo form_close(); ?>
         </div>
	  </div>
	  <div class="text-center text-muted mt-4 small">
        <div><?php echo $this->config->item('app_admin_copy_right');?> <?php echo $this->config->item('app_version');?></div>
      </div>
   </div>
</div>