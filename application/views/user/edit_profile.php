<?php $row = $row[0]; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">Form</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
                
                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form',
            'name' => 'profile',
            'id' => 'profile',));
        ?>
        <?php echo form_hidden('form_action', 'update_profile'); ?>
        <?php echo form_hidden('user_email', $row['user_email']); ?>
            <div class="form-row">
            <div class="form-group col-md-4">
				<label for="user_email_secondary" class="required">Email ID (personal)</label>
				<?php
				echo form_input(array(
					'name' => 'user_email_secondary',
					'value' => (isset($_POST['user_email_secondary']) ? set_value('user_email_secondary') : $row['user_email_secondary']),
					'id' => 'user_email_secondary',
					'class' => 'form-control'
				));
				?>
				<?php echo form_error('user_email_secondary'); ?>
			</div>
            <div class="form-group col-md-4">
                <label for="user_phone1" class="required">10-digit Mobile Number (personal)</label>
                <?php
                echo form_input(array(
                    'name' => 'user_phone1',
                    'value' => (isset($_POST['user_phone1']) ? set_value('user_phone1') : $row['user_phone1']),
                    'id' => 'user_phone1',
                    'class' => 'form-control',
                    'maxlength' => '10',
                    'minlength' => '10',
                ));
                ?>
                <?php echo form_error('user_phone1'); ?>
            </div>
            <div class="form-group col-md-4">
                <label for="user_phone2" class="">10-digit Mobile Number (office)</label>
                <?php
                echo form_input(array(
                    'name' => 'user_phone2',
                    'value' => (isset($_POST['user_phone2']) ? set_value('user_phone2') : $row['user_phone2']),
                    'id' => 'user_phone2',
                    'class' => 'form-control',
                    'maxlength' => '10',
                    'minlength' => '10',
                ));
                ?>
                <?php echo form_error('user_phone2'); ?>
            </div>
            <div class="form-group col-md-4">
                <label for="user_blood_group" class="required">Blood Group</label>
                    <?php
                    echo form_dropdown('user_blood_group', $blood_group, isset($_POST['user_blood_group']) ? set_value('user_blood_group') : $row['user_blood_group'], array(
                        'class' => 'form-control',
                    ));
                    ?> 
                    <?php echo form_error('user_blood_group'); ?>
                </div>
                </div>

			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>" class="btn btn-light btn-cancel">Cancel</a>
        <?php echo form_close(); ?>
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->