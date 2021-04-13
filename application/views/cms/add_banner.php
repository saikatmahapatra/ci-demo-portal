<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card ">
            <div class="card-header"><?php echo $this->app_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<?php echo form_open_multipart(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
				<?php echo form_hidden('form_action', 'insert'); ?>
				<?php echo form_hidden('upload_file_type_name', 'slider_img'); ?>
				<?php echo form_hidden('upload_status', 'Y'); ?>

				
				<div class="form-row">			
					<div class="form-group col-lg-12">									
						<label for="userfile" class="required">Image (Only 1200x300 dimensions are allowed)</label>
						<?php
							echo form_upload(array(
								'name' => 'userfile',
								'id' => 'userfile',
								'class' => 'form-control field-help'
							));
							?>
						<?php echo form_error('userfile'); ?>
						<small>Only .jpg, .jpeg, .png are allowed</small>
					</div>		
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-12">									
						<label for="content_title" class="">Text Line 1 (Optional)</label>
						<?php echo form_input(array('name' => 'upload_text_1', 'value' => set_value('upload_text_1'), 'id' => 'upload_text_1', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('upload_text_1'); ?>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-12">									
						<label for="content_title" class="">Text Line 2 (Optional)</label>
						<?php echo form_input(array('name' => 'upload_text_2', 'value' => set_value('upload_text_2'), 'id' => 'upload_text_2', 'class' => 'form-control', 'placeholder' => ''));?>
						<?php echo form_error('upload_text_2'); ?>
					</div>
				</div>
				
				<?php /* ?>
				<div class="form-row">
					<div class="form-group col-lg-12">									
						<label for="upload_status" class="required">Status</label>
						<!-- <div class=""> -->
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = $this->input->post('upload_status') == 'Y';
									echo form_radio(array('name' => 'upload_status','value' => 'Y','id' => 'Y','checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('upload_status', 'Y'));
								?>
								<label class="custom-control-label" for="Y">Publish</span></label>
							</div>
							
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = $this->input->post('upload_status') == 'N';
									echo form_radio(array('name' => 'upload_status', 'value' => 'N', 'id' => 'N', 'checked' => $radio_is_checked, 'class' => 'custom-control-input'), set_radio('upload_status', 'N'));
								?>
								<label class="custom-control-label" for="N">Unpublish</span></label>
							</div>								
						<!-- </div> -->
						<?php echo form_error('upload_status'); ?>
					</div>		
				</div>
				<?php */ ?>


				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/manage_banner');?>" class="btn btn-light">Cancel</a>
				<?php echo form_close(); ?>
			</div>
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->