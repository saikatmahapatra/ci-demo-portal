<?php $row = $row[0]; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-header">Delete Account</div>
            <div class="card-body">
            
                <?php
					echo isset($row['user_firstname']) ? $row['user_firstname'] . '&nbsp;' : '';
					echo isset($row['user_midname']) ? $row['user_midname'] . '&nbsp;' : '';
					echo isset($row['user_lastname']) ? $row['user_lastname'] : '';
					echo isset($row['user_emp_id']) ? ' (Emp ID '.$row['user_emp_id'].') ': '';
					echo isset($row['user_email']) ? '; '.$row['user_email']: '';
				?>
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'form','id' => 'form',));?>
                <?php echo form_hidden('form_action', 'close_account'); ?>
                <?php echo form_hidden('user_id', $row['id']); ?>

                <div class="form-group">
                    <label for="user_dor" class="required">Date of Release</label>
                    <?php echo form_input(array( 'name' => 'user_dor', 'value' => set_value('user_dor'), 'id' => 'user_dor', 'maxlength' => '10', 'class' => 'form-control', 'placeholder' => 'dd-mm-yyyy', 'autocomplete'=>'off', 'readonly'=>true )); ?>
                    <?php echo form_error('user_dor'); ?>
                </div>

                <div class="form-group">
                    <label for="user_dor" class="required">Comments</label>
                    <?php echo form_textarea(array( 'name' => 'account_close_comments', 'value' => set_value('account_close_comments'), 'id' => 'account_close_comments', 'class' => 'form-control', 'rows' => '2', 'cols' => '4', 'maxlength' => '200', 'placeholder' => '' )); ?>
                    <?php echo form_error('account_close_comments'); ?>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <?php
								$cb_is_checked = $this->input->post('terms') === 'accept';
								echo form_checkbox('terms', 'accept', $cb_is_checked, array('id' => 'terms','class' => 'custom-control-input'));
							?>
                        <label class="custom-control-label required" for="terms">I understand that, this action can
                            not be undo. Portal account will be archived forever and this user will not be able to
                            login permanently.</label>
                    </div>
                    <?php echo form_error('terms'); ?>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/edit_user_profile/'.$row['id']);?>"
                    class="btn btn-light ci-btn-cancel">Cancel</a>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage');?>"
                    class="btn btn-link" data-toggle="tooltip" title="">Manage Employees</a>
                <?php echo form_close(); ?>

            </div>
            <!--./card-body-->
        </div>
        <!--/.card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->