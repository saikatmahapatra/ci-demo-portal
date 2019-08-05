<div class="row justify-content-center">
	<div class="col-sm-12 col-md-4 form-signin">
		<div class="text-center">
			<img class="logo-2x py-2" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
			<h1 class="page-title"><?php echo isset($page_title)? $page_title:'Untitled Page'; ?></h1>
		</div>
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')) ?>
		<?php echo form_hidden('form_action', 'activate_account'); ?>
			<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
			?>
		
			<div class="form-group">
				<label for="user_email">Registered Email <span class="required">*</span></label>
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div></div> -->
					<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'name','class' => 'form-control','placeholder' => '','maxlength' => '100','autocomplete' => 'off'));?>
				<!-- </div> -->
				
				<?php echo form_error('user_email'); ?>
			</div>
			<div class="form-group">
				<label for="activation_otp">Activation OTP <span class="required">*</span></label>
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div></div> -->
					<?php echo form_password(array('name' => 'activation_otp','value' => set_value('activation_otp'),'id' =>'activation_otp','placeholder' => '','class' => 'form-control','maxlength' => '16', 'autocomplete' => 'off'));?>
				<!-- </div> -->
				<?php echo form_error('activation_otp'); ?>
			</div>
			<!--<div class="form-group">
				<input id="remember" name="remember" type="checkbox" value="1">
				<label class="form-check-label" for="remember">Remember Password</label>
			</div>	-->
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Activate','class' => 'btn btn-lg btn-primary btn-block'));?>
			
			<?php form_close(); ?>

			<div class="mt-3">
				<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Already Activated? Back to Login</a>
			</div>
				
	</div>
</div>