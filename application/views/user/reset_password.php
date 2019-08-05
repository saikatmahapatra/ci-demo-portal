<div class="card card-login border border-secondary mx-auto mt-3">
  <div class="card-header text-white bg-black"><?php echo $this->config->item('app_logo_name_dashboard'); ?> - <?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></div>
  <div class="colorgraph-2"></div>
  <div class="card-body">
	<div class="text-center mb-4">
		<img class="logo-2x" src="<?php echo base_url('assets/src/img/logo-dark.png');?>">
		<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
		<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
	</div>
	<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
	?>

	<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')) ?>
	<?php echo form_hidden('form_action', 'reset_password'); ?>
	<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
	<?php echo form_error('user_email'); ?>

	<div class="form-label-group">
		<?php
		echo form_password(array(
			'name' => 'password_reset_key',
			'value' => set_value('password_reset_key'),
			'id' => 'password_reset_key',
			'placeholder' => '6-digit OTP (received by email)',
			'class' => 'form-control',
			'maxlength' => '6',
			'autofocus' => ''
		));
		?>
		<label for="password_reset_key">6-digit OTP (received by email)</label>
		<?php echo form_error('password_reset_key'); ?>
	</div>

	<div class="form-label-group">
		<?php
		echo form_password(array(
			'name' => 'user_new_password',
			'value' => set_value('user_new_password'),
			'id' => 'user_new_password',
			'placeholder' => 'New Password',
			'class' => 'form-control',
			'maxlength' => '16',
		));
		?>
		<label for="user_new_password" class="">New Password</label>
		<?php echo form_error('user_new_password'); ?>
	</div>

	<div class="form-label-group">
		<?php
		echo form_password(array(
			'name' => 'confirm_user_new_password',
			'value' => set_value('confirm_user_new_password'),
			'id' => 'confirm_user_new_password',
			'placeholder' => 'Confirm Password',
			'class' => 'form-control',
			'maxlength' => '16',
		));
		?>
		<label for="confirm_user_new_password">Confirm Password</label>
		<?php echo form_error('confirm_user_new_password'); ?>
	</div>
	<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-lg btn-primary btn-block'));?>	
	<?php form_close(); ?>
	

	<div class="mt-3">
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>" class="">Resend Email OTP</a>
		<br>
		<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to Login</a>
	</div>
  </div><!--/.card-body-->
</div><!--/.card-->