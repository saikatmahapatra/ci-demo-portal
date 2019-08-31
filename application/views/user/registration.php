<div class="card card-login mx-auto mt-3">
    <div class="card-header text-white bg-black"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></div>
    <div class="colorgraph-2"></div>
    <div class="card-body">
        <div class="text-center mb-4">
            <img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
            <!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
            <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
        </div>
        <?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
        <?php echo form_hidden('form_action', 'self_registration'); ?>
        <?php echo form_hidden('user_role', 3); ?>

        <div class="form-group">
            <label for="user_firstname" class="required">First Name</label>
            <?php echo form_input(array( 'name' => 'user_firstname', 'value' => set_value('user_firstname'), 'id' => 'user_firstname', 'class' => 'form-control', 'maxlength' => '30', 'placeholder' => '', )); ?>
            <?php echo form_error('user_firstname'); ?>
        </div>

        <div class="form-group">
            <label for="user_lastname" class="required">Last Name</label>
            <?php echo form_input(array( 'name' => 'user_lastname', 'value' => set_value('user_lastname'), 'id' => 'user_lastname', 'class' => 'form-control', 'maxlength' => '50', 'placeholder' => '', )); ?>
            <?php echo form_error('user_lastname'); ?>
        </div>
        <div class="form-group">
            <label for="user_email" class="required">Email ID (office)</label>
            <?php echo form_input(array( 'name' => 'user_email', 'value' => set_value('user_email'), 'id' => 'user_email', 'class' => 'form-control', 'maxlength' => '255', 'placeholder' => '', )); ?>
            <?php echo form_error('user_email'); ?>
        </div>

        <div class="form-group">
            <label for="user_phone1" class="required">10-digit Mobile Number (personal)</label>
            <?php echo form_input(array( 'name' => 'user_phone1', 'value' => set_value('user_phone1'), 'id' => 'user_phone1', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => '', )); ?>
            <?php echo form_error('user_phone1'); ?>
        </div>
        <div class="form-group">
            <label for="user_password" class="required">Password</label>
            <?php echo form_password(array( 'name' => 'user_password', 'value' => set_value('user_password'), 'id' => 'user_password', 'class' => 'form-control', 'maxlength' => '12', 'placeholder' => '', )); ?>
            <?php echo form_error('user_password'); ?>
        </div>

        <div class="form-group">
            <label for="user_password_confirm" class="required">Confirm Password</label>
            <?php echo form_password(array( 'name' => 'user_password_confirm', 'value' => set_value('user_password_confirm'), 'id' => 'user_password_confirm', 'class' => 'form-control', 'maxlength' => '12', 'placeholder' => '', )); ?>
            <?php echo form_error('user_password_confirm'); ?>
        </div>
        <div class="form-group">
            <label for="user_dob" class="required">Date of Birth</label>
            <?php echo form_input(array( 'name' => 'user_dob', 'value' => set_value('user_dob'), 'id' => 'user_dob', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'autocomplete'=>'off', 'readonly'=>true )); ?>
            <?php echo form_error('user_dob'); ?>
        </div>
        <div class="form-group">
            <label for="gender" class="required">Gender</label>
            <div class="">
                <div class="custom-control custom-radio custom-control-inline">
				<?php $radio_is_checked = $this->input->post('user_gender') === 'M'; echo form_radio(array('name' => 'user_gender','value' => 'M','id' => 'M','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_gender', 'M')); ?>
                    <label class="custom-control-label" for="M">Male</span></label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
				<?php $radio_is_checked = $this->input->post('user_gender') === 'F'; echo form_radio(array('name' => 'user_gender', 'value' => 'F', 'id' => 'F', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_gender', 'F')); ?>
                    <label class="custom-control-label" for="F">Female</span></label>
                </div>
            </div>
            <?php echo form_error('user_gender'); ?>
        </div>
        <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Create Account','class' => 'btn btn-primary'));?>
        <a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Login</a>
        <?php echo form_close(); ?>
        <!--/.card-body-->
    </div>
    <!--/.card-->