
<div class="row justify-content-center">
	<div class="col-sm-12 col-md-4 form-signin">	
		<div class="text-center">
			<img class="logo-2x py-2" src="<?php echo base_url('assets/src/img/logo-dark.png');?>">
			<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
			<h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
			<p>Password reset OTP will be sent to your registered email.</p>
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
			<?php echo form_hidden('form_action', 'forgot_password'); ?>
			<div class="form-group">
					<label for="user_email">Email <span class="required">*</span></label>
					<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div></div> -->
					<?php echo form_input(array('name' => 'user_email','value' => set_value('user_email'),'id' => 'name','class'=> 'form-control','placeholder' => 'Please enter your registered email','maxlength' => '100','autofocus' => true,));?>
					<!-- </div> -->
					<?php echo form_error('user_email'); ?>
				</div>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-lg btn-primary btn-block'));?>
				
				<?php form_close(); ?>
				<div class="mt-3">
					<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to Login</a>
				</div>
				
		</div>
	</div>