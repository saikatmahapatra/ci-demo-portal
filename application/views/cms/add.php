<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-9">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
		<?php echo form_hidden('form_action', 'insert'); ?>

		
		<div class="form-row">
			<div class="form-group col-md-12">									
				<label for="pagecontent_title" class="">Content Title <span class="required">*</span></label>
				<?php echo form_input(array('name' => 'pagecontent_title', 'value' => set_value('pagecontent_title'), 'id' => 'pagecontent_title', 'class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('pagecontent_title'); ?>
			</div>		
		</div>
		
		<div class="form-group">									
			<label for="pagecontent_text" class="">Content (HTML) <span class="required">*</span></label>
			<?php echo form_textarea(array('name' => 'pagecontent_text','value' => set_value('pagecontent_text'),'class' => 'form-control textarea','id' => 'pagecontent_text','rows' => '2','cols' => '50','placeholder' => '')); ?>
			<?php echo form_error('pagecontent_text'); ?>
		</div>

		<div class="form-row">			
			<div class="form-group col-md-4">									
				<label for="pagecontent_type" class="">Content Type <span class="required">*</span></label>
				<?php echo form_dropdown('pagecontent_type', $arr_content_type, set_value('pagecontent_type'), array('class' => 'form-control',));?>
				<?php echo form_error('pagecontent_type'); ?>
			</div>
			
			<?php /*?>
			<div class="form-group col-md-4 d-none">									
				<label for="pagecontent_display_start_date" class="">Display from Date</label>
				<?php echo form_input(array('name' => 'pagecontent_display_start_date','value' => set_value('pagecontent_display_start_date'),'id' => 'pagecontent_display_start_date','class' => 'form-control cms-datepicker', 'placeholder' => 'dd-mm-yyyy','readonly'=>true));?>
				<?php echo form_error('pagecontent_display_start_date'); ?>
			</div>
		
			<div class="form-group col-md-4 d-none">									
				<label for="pagecontent_display_end_date" class="">Display to Date</label>
				<?php echo form_input(array('name' => 'pagecontent_display_end_date','value' => set_value('pagecontent_display_end_date'),'class' => 'form-control cms-datepicker','id' => 'pagecontent_display_end_date','placeholder' => 'dd-mm-yyyy','readonly'=>true));?>
				<?php echo form_error('pagecontent_display_end_date'); ?>
			</div>	
			<?php */ ?>
		</div>
		<?php /* ?>
		<div class="form-row d-none">			
			<div class="form-group col-md-4">									
				<label for="pagecontent_meta_keywords" class="">Meta Keywords</label>
				<?php echo form_input(array('name' => 'pagecontent_meta_keywords','value' => set_value('pagecontent_meta_keywords'),'id' => 'pagecontent_meta_keywords','class' => 'form-control', 'placeholder' => '')); ?>
				<?php echo form_error('pagecontent_meta_keywords'); ?>
			</div>
		
			<div class="form-group col-md-4">									
				<label for="pagecontent_meta_description" class="">Meta Description</label>
				<?php echo form_input(array('name' => 'pagecontent_meta_description','value' => set_value('pagecontent_meta_description'),'id' => 'pagecontent_meta_description','class' => 'form-control', 'placeholder' => ''));?>
				<?php echo form_error('pagecontent_meta_description'); ?>
			</div>
		
			<div class="form-group col-md-4">									
				<label for="pagecontent_meta_author" class="">Meta Author</label>
				<?php echo form_input(array('name' => 'pagecontent_meta_author','value' => set_value('pagecontent_meta_author'),'class' => 'form-control','id' => 'pagecontent_meta_author','placeholder' => ''));?>
				<?php echo form_error('pagecontent_meta_author'); ?>
			</div>			
		</div>
		<?php */ ?>

		<div class="form-row">
			<div class="form-group col-md-12">									
				<label for="pagecontent_status" class="">Display Status <span class="required">*</span></label>
				<?php //echo form_dropdown('pagecontent_status', array('Y'=>'Yes','N'=>'No'), set_value('pagecontent_status'), array('class' => 'form-control')); ?>
				<?php //echo form_error('pagecontent_status'); ?>

				<!-- <div class=""> -->
					<div class="custom-control custom-radio custom-control-inline">
						<?php
							$radio_is_checked = $this->input->post('pagecontent_status') == 'Y';
							echo form_radio(array('name' => 'pagecontent_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('pagecontent_status', 'Y'));
						?>
						<label class="custom-control-label" for="Y">Publish</span></label>
					</div>
					
					<div class="custom-control custom-radio custom-control-inline">
						<?php
							$radio_is_checked = $this->input->post('pagecontent_status') == 'N';
							echo form_radio(array('name' => 'pagecontent_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('pagecontent_status', 'N'));
						?>
						<label class="custom-control-label" for="N">Unpublish</span></label>
					</div>								
				<!-- </div> -->
				<small id="emailHelp" class="form-text text-muted">If you unpublish this, it will not displayed for public user(employees)</small>
				<?php echo form_error('pagecontent_status'); ?>
			</div>		
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">				
				<div class="custom-control custom-checkbox my-1 mr-sm-2">
					<?php
						$cb_is_checked = $this->input->post('send_email_notification') === 'Y';
						echo form_checkbox('send_email_notification', 'Y', $cb_is_checked, array('id' => 'send_email_notification','class' => 'custom-control-input'));
					?>					
					<label class="custom-control-label" for="send_email_notification">Send Email Notification to All Employees (Optional)</label>
				</div>
				<small id="" class="form-text text-muted">If you check this option,, all registered active employees will get an email notification/update about this article.</small>
			</div>
		</div>


		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
		<a href="<?php echo base_url($this->router->directory.$this->router->class);?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
		<?php echo form_close(); ?>
	</div>
</div>