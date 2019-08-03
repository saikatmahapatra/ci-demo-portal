<div class="card card-login border border-secondary mx-auto mt-3">
  <div class="card-header text-white bg-dark"><?php echo $this->config->item('app_logo_name_dashboard'); ?> - <?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></div>
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
	<?php echo form_hidden('form_action', 'login'); ?>
	<div class="form-label-group">		
		<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Email ID','maxlength' => '100','autofocus' => true,));?>
		<label for="user_email">Email ID</label>
		<?php echo form_error('user_email'); ?>
	</div>
	<div class="form-label-group">
		<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Password','class' => 'form-control','maxlength' => '16'));?>
		<label for="user_password">Password</label>
		<?php echo form_error('user_password'); ?>
	</div>
	<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-sign-in"></i> Sign In','class' => 'btn btn-lg btn-primary btn-block'));?>
	
	<?php form_close(); ?>

	<div class="mt-3">
		<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>">Forgot Password?</a>		
		<!-- <a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/registration');?>">Create your account</a> -->
	</div>
  </div><!--/.card-body-->
</div><!--/.card-->