<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-6">
		<div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
			<div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array( 'method' => 'post', 'class'=>'ci-form', 'name' => 'change_password', 'id' => 'change_password', )); ?> 
                    <?php echo form_hidden('form_action', 'change_password'); ?>

        <div class="form-group">
            <label for="user_current_password" class="required">Current Password</label>
            <?php echo form_password(array('name' => 'user_current_password', 'value' => set_value('user_current_password'), 'id' => 'user_current_password', 'class' => 'form-control', 'maxlength' => 15, 'autocomplete' => 'off', )); ?>
            <?php echo form_error('user_current_password'); ?>
        </div>

        <div class="form-group">
            <label for="user_new_password" class="required">New Password</label>
            <?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'class' => 'form-control', 'maxlength' => 15, 'autocomplete' => 'off', )); ?> 
            <?php echo form_error('user_new_password'); ?>
        </div>

        <div class="form-group">
            <label for="confirm_user_new_password" class="required">Confirm New Password</label>
            <?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'class' => 'form-control', 'maxlength' => 15, 'autocomplete' => 'off', )); ?>
            <?php echo form_error('confirm_user_new_password'); ?>
        </div>

        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn btn-lg btn-primary'));?>
        <?php echo form_close(); ?>
				
			</div><!--./card-body-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->