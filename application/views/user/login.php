<div class="row justify-content-center">
	<div class="col-sm-12">		
		
		<div class="text-center">
			<img class="logo-2x pb-3" src="<?php echo base_url('assets/src/img/logo.png');?>">
			<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
			<h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
		</div>
		
		

		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin')) ?>
		<?php echo form_hidden('form_action', 'login'); ?>
			<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';                
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
			?>
		
			<div class="form-group">
				<label for="user_email">Email <span class="required">*</span></label>
				<div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div></div>
					<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'name','class' => 'form-control','placeholder' => '','maxlength' => '100','autofocus' => true,));?>
				</div>
				
				<?php echo form_error('user_email'); ?>
			</div>
			<div class="form-group">
				<label for="user_password">Password <span class="required">*</span></label>
				<div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div></div>
					<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => '','class' => 'form-control','maxlength' => '16'));?>
				</div>
				<?php echo form_error('user_password'); ?>
			</div>
			<!--<div class="form-group">
				<input id="remember" name="remember" type="checkbox" value="1">
				<label class="form-check-label" for="remember">Remember Password</label>
			</div>	-->											
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Sign In','class' => 'btn btn-lg btn-primary btn-block'));?>
			
			<?php form_close(); ?>

			<div class="mt-3">
				<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>">Forgot Password?</a>
				<br>
				<!-- <a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/registration');?>">Create your account</a> -->
			</div>
				
		</div>
	</div>