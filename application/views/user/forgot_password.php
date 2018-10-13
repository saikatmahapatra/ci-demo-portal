
<div class="row justify-content-center">
	<div class="col-12 col-sm-8 col-md-4">			
		<div class="card">
			<div class="card-header text-center bg-primary text-white">				
				<img class="mb-1" style="width:180px;" src="<?php echo base_url('assets/src/img/logo.png');?>">
				<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
				<h5 class=""><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h5>
			</div>
			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';                
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				<div class="text-center mt-4 mb-5">					
					<p>Enter your registered email address to get reset password link.</p>
				</div>
				
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form')) ?>
				<?php echo form_hidden('form_action', 'forgot_password'); ?>
				
					<div class="form-group">
					<label for="user_email">Registered Email <span class="required">*</span></label>
						<?php echo form_input(array('name' => 'user_email','value' => set_value('user_email'),'id' => 'name','class'=> 'form-control','placeholder' => '','maxlength' => '100','autofocus' => true,));?>
						<?php echo form_error('user_email'); ?>
					</div>
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary btn-block'));?>
					
					<?php form_close(); ?>
					<div class="mt-3">
						<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to login</a>
					</div>
				</div>
			</div>
		</div>
	</div>