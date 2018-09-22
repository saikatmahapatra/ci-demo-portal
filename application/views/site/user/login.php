<div class="row justify-content-center">
	<div class="col-12 col-sm-8 col-md-4">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<div class="card">
			<div class="card-header text-center bg-primary text-white">
				<img class="mb-1" style="width:80px;" src="<?php echo base_url('assets/src/img/logo.svg');?>">
				<h6><?php echo $this->config->item('app_company_product');?></h6>
				<h5 class=""><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h5>
			</div>
			<div class="card-body">				
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'admin_login ci-from')) ?>
				<?php echo form_hidden('form_action', 'login'); ?>
				
					<div class="form-group">
						<label for="user_email">Email ID</label>
						<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'name','class' => 'form-control','placeholder' => 'user@unitedexploration.co.in','maxlength' => '100','autofocus' => true,));?>
						<?php echo form_error('user_email'); ?>
					</div>
					<div class="form-group">
						<label for="user_password">Password</label>
						<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Login password','class' => 'form-control','maxlength' => '16'));?>
						<?php echo form_error('user_password'); ?>
					</div>
					<!--<div class="form-group">
						<input id="remember" name="remember" type="checkbox" value="1">
						<label class="form-check-label" for="remember">Remember Password</label>
					</div>	-->											
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Login','class' => 'btn btn-primary btn-block'));?>
					
					<?php form_close(); ?>

					<div class="mt-3">
						<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>">Forgot Password?</a>
						<br>
						<a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/registration');?>">Don't have an account? Create your account</a>
					</div>
				</div>
			</div>
		</div>
	</div>