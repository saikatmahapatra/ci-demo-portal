<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="card ci-card col-lg-7">
		<div class="card-body">
			<h1 class="page-title my-0"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
			<div class="text-muted mb-2">Sign in to your account to continue</div>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<div class="row justify-content-center mt-4">
				<div class="col-8 col-md-5 col-lg-6 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
					<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
				</div>
				<div class="col-12 col-md-7 col-lg-6 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
					<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')); ?>
					<?php echo form_hidden('form_action', 'login'); ?>
					<div class="mb-3">
						<div class="input-group">
							<!-- <label for="user_email">Email ID or Username</label> -->
							<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><i class="fas fa-user" aria-hidden="true"></i></span></div>
							<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Username','maxlength' => '100','autofocus' => true,));?>
						</div>
						<?php echo form_error('user_email'); ?>
					</div>
					
					<div class="my-3">
						<div class="input-group">
							<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2"><i class="fas fa-lock" aria-hidden="true"></i></span></div>
							<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Password','class' => 'form-control','maxlength' => '16'));?>
						</div>
						<?php echo form_error('user_password'); ?>
					</div>
					
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Sign In','class' => 'btn ci-btn-primary btn-primary btn-block'));?>
					<?php echo form_close(); ?>
					
					<p class="mb-0 text-muted"><a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a></p>
				</div>
			</div>

		</div>
	</div>
</div>