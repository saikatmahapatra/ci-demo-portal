<div class="card card-login mx-auto mt-3">
  <div class="card-header text-white bg-black"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></div>
  <div class="colorgraph-2"></div>
  <div class="card-body">
	<div class="text-center mb-4">
		<img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
		<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
		<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
		<p>Password reset OTP will be sent to your registered email.</p>
	</div>
	<?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>

	<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')) ?>
	<?php echo form_hidden('form_action', 'forgot_password'); ?>
		<div class="form-group">
			<label for="user_email">Registered Email</label>
			<?php echo form_input(array('name' => 'user_email','value' => set_value('user_email'),'id' => 'user_email','class'=> 'form-control','placeholder' => '','maxlength' => '100','autofocus' => true,));?>
			
			<?php echo form_error('user_email'); ?>
		</div>
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-lg btn-primary btn-block'));?>
		
	<?php form_close(); ?>
	

	<div class="mt-3">
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to Login</a>
	</div>
  </div><!--/.card-body-->
</div><!--/.card-->