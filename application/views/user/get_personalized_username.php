<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="card  col-md-7">
		<div class="card-body">
			<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
			<div class="text-muted mb-2">Now you can create your personalized username. Once you create an user name you can either login using email or username.</div>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<div class="row justify-content-center mt-4">
				<div class="col-8 col-md-5 col-md-6 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
					<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
				</div>
				<div class="col-12 col-md-7 col-md-6 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
				<?php echo form_hidden('form_action', 'set_username'); ?>
					<div class="form-group mb-3">
						<label for="user_name">Set Your Username</label>
						<?php echo form_input(array('name' => 'user_name','value' => set_value('user_name'),'id' => 'user_name','class'=> 'form-control','placeholder' => 'Example: jhonsmith17','maxlength' => '32','autofocus' => true));?>	
						<div class="form-text small text-muted">Username should be 5 to 32 characters in length.</div>
						<?php echo form_error('user_name'); ?>
					</div>
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn  btn-primary btn-block'));?>
					<a href="<?php echo base_url('/home');?>" class="btn  btn-secondary btn-block">Go to Dashboard</a>
				<?php echo form_close(); ?>
				</div>
			</div>

		</div>
	</div>
</div>