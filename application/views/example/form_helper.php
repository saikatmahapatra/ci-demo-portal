<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>


<div class="row">
    <div class="col-lg-4">
    <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => '')); ?>
        <?php echo form_hidden('form_action', 'add'); ?>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="user_email" class="required">Email</label>
                <?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control', 'placeholder' => '','minlength' => '','maxlength' => '','aria-describedby'=>'emailHelpBlock')); ?>
                <div id="emailHelpBlock" class="form-text ci-form-help-text text-muted">We will not
                    share your email to any third party websites.</div>
                <?php echo form_error('user_email'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="user_password" class="required">Password</label>
                <?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' => 'user_password', 'class' => 'form-control', 'placeholder' => '', 'minlength' => '8','maxlength' => '20', 'aria-describedby'=>'passwordHelpBlock')); ?>
                <div id="passwordHelpBlock" class="form-text ci-form-help-text text-muted">Your password
                    must be 8-20 characters long, contain letters and numbers, and must not contain
                    spaces, special characters, or emoji.</div>
                <?php echo form_error('user_password'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="user_password_confirm" class="required">Confirm Password</label>
                <?php echo form_password(array('name' => 'user_password_confirm', 'value' => set_value('user_password_confirm'), 'id' => 'user_password_confirm', 'class' => 'form-control', 'placeholder' => '', 'minlength' => '8', 'maxlength' => '20',));?>
                <?php echo form_error('user_password_confirm'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="address" class="required">Address</label>
                <?php echo form_textarea(array('name' => 'address', 'value' => set_value('address'),'id' => 'address', 'class' => 'form-control', 'rows' => '1', 'cols' => '4', 'placeholder' => '','minlength' => '10', 'maxlength' => '200')); ?>
                <?php echo form_error('address'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="job_role" class="required">Job Role</label>
                <?php echo form_dropdown('job_role', $job_role_arr, set_value('job_role'), array('class' => 'form-control')); ?>
                <?php echo form_error('job_role'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="functional_domain" class="required">Job Domain</label>
                <?php echo form_multiselect('functional_domain', $domain_arr, set_value('functional_domain'), array('class' => 'form-control')); ?>
                <?php echo form_error('functional_domain'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <label for="userfile" class="required">Resume</label>
                <div class="custom-file">
                    <?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => 'custom-file-input', 'aria-describedby'=>'uploaderHelpBlock')); ?>
                    <label class="custom-file-label" for="userfile">Choose file</label>
                </div>
                <div id="emailHelpBlock" class="form-text ci-form-help-text text-muted">doc, docx, pdf,
                    jpg, png formats are supported. File size should not exceed 2 MB</div>
                <?php echo form_error('userfile'); ?>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-12">
                <label for="gender" class="required">Gender</label>
                <div class="">
                    <div class="custom-control custom-radio custom-control-inline">
                        <?php
                        $radio_is_checked = $this->input->post('user_gender') === 'M';
                            echo form_radio(array('name' => 'user_gender','value' => 'M','id' => 'M','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('user_gender', 'M'));
                        ?>
                        <label class="custom-control-label" for="M">Male</span></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <?php
                            $radio_is_checked = $this->input->post('user_gender') === 'F';
                            echo form_radio(array('name' => 'user_gender', 'value' => 'F', 'id' => 'F', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('user_gender', 'F'));
                        ?>
                        <label class="custom-control-label" for="F">Female</span></label>
                    </div>
                </div>
                <?php echo form_error('user_gender'); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <div class="form-check">
                    <?php
                        $cb_is_checked = $this->input->post('terms') === 'accept';
                        echo form_checkbox('terms', 'accept', $cb_is_checked, array('id' => 'trems','class' => 'form-check-input'));
                    ?>
                    <label class="form-check-label required" for="trems">I've read & accepting the <a href="#"
                            data-toggle="modal" data-target="#tncModal">Terms of Uses
                            Agreement</a>
                    </label>
                </div>
                <?php echo form_error('terms'); ?>
            </div>
        </div>
        <?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'id' => 'btn_submit', 'class' => 'btn ci-btn-primary btn-primary')); ?>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tncModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Terms of Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body tnc-content">
                <p>Modal body content</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn ci-btn-primary btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>