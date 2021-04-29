<div class="row justify-content-center align-items-center" style="height:100vh">
   <div class="col-sm-6 col-lg-4 login-card-wrapper">
      
      <div class="card">
         <div class="card-header py-3 text-center bg-dark text-white"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div>
         <div class="card-body">
            <div class="mb-2"><?php echo isset($alert_message) ? $alert_message : ''; ?></div>
            <div class="text-center"><a href="<?php echo base_url();?>"><img class="" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="80"></a></div>
            <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin mt-3')); ?>
            <?php echo form_hidden('form_action', 'login'); ?>
            <div class="form-group">
               <label class="required" for="user_email">Email</label>
               <?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Enter email address','maxlength' => '100','autofocus' => true));?>
               <?php echo form_error('user_email'); ?>
            </div>
            <div class="form-group">
               <label class="required" for="user_password">Password</label>
               <?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Enter password','class' => 'form-control','maxlength' => '16'));?>
               <?php echo form_error('user_password'); ?>
            </div>
            <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Log In','class' => 'btn btn-lg btn-primary btn-block btn-lg'));?>
            <div class="text-center mt-4"><a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a></div>
            <?php echo form_close(); ?>
         </div>
      </div>
      <div class="text-center text-muted mt-4 small">
        <div><?php echo $this->config->item('app_admin_copy_right');?> <?php echo $this->config->item('app_version');?></div>
      </div>
   </div>
</div>