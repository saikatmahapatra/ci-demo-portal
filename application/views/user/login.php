<div class="card card-login ci-card mx-auto mt-3">
  <div class="card-body">
	<div class="text-center mb-4">
		<img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
		<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
		<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
	</div>
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
	<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')) ?>
	<?php echo form_hidden('form_action', 'login'); ?>
	<div class="form-group">
		<label for="user_email">Email / Username</label>
		<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Email','maxlength' => '100','autofocus' => true,));?>
		<?php echo form_error('user_email'); ?>
	</div>
	<div class="form-group">
		<label for="user_password">Password</label>
		<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Password','class' => 'form-control','maxlength' => '16'));?>
		<?php echo form_error('user_password'); ?>
	</div>
	<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Sign In','class' => 'btn btn-lg ci-btn-primary btn-primary btn-block'));?>
	<?php form_close(); ?>
	<div class="mt-3">
		<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>">Forgot Password?</a>
		<!-- <a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/registration');?>">Create your account</a> -->
	</div>
  </div><!--/.card-body-->
</div><!--/.card-->