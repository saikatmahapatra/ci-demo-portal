<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-4">
        <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <?php echo form_open_multipart(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => '','id' => '',));?>
        <?php echo form_hidden('form_action', 'send'); ?>

        <div class="form-group">
            <label for="name" class="required">Name</label>
            <?php echo form_input(array( 'name' => 'name', 'value' => set_value('name'), 'id' => 'name', 'class' => 'form-control', 'placeholder' => 'Please enter your full name', 'maxlength' => '50', )); ?>
            <?php echo form_error('name'); ?>
        </div>

        <div class="form-group">
            <label for="email" class="required">Email</label>
            <?php echo form_input(array( 'name' => 'email', 'value' => set_value('email'), 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Your email', 'maxlength' => '255', )); ?>
            <?php echo form_error('email'); ?>
        </div>
        <div class="form-group">
            <label for="phone_number" class="optional">Mobile Number</label>
            <?php echo form_input(array( 'name' => 'phone_number', 'value' => set_value('phone_number'), 'id' => 'phone_number', 'class' => 'form-control', 'placeholder' => '10-digit mobile number', 'maxlength' => '10', )); ?>
            <?php echo form_error('phone_number'); ?>
        </div>

        <div class="form-group">
            <label for="message" class="required">Message</label>
            <?php echo form_textarea(array( 'name' => 'message', 'value' => set_value('message'), 'id' => 'message', 'class' => 'form-control', 'rows' => '2', 'cols' => '2', 'placeholder' => 'Leave your message...', 'maxlength' => '200', )); ?>
            <?php echo form_error('message'); ?>
        </div>
        <div class="form-group">
            <div><?php print_r($captcha_image); ?></div>
            <br>
            <?php echo form_hidden('captcha_word', $captcha_word); ?>
            <?php echo form_input(array( 'name' => 'captcha', 'value' => set_value('captcha'), 'id' => 'captcha', 'class' => 'form-control', 'placeholder' => 'Enter the displayed characters', 'title' => '', 'minlength' => '', 'maxlength' => '15', )); ?>
            <?php echo form_error('captcha'); ?>
        </div>
        <?php echo form_submit(array( 'name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-primary', )); ?>
        <?php echo form_close(); ?>
    </div>
</div>