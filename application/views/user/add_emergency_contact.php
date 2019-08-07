<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->



<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Form
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="float-right btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Back to Profile"> <i class="fa fa-chevron-left"></i> Back</a>
			</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>

			<?php
			if(!$has_add_limit){
				?>
					<div class="alert alert-info"><b>Note: </b> You have already added 3 emergency contacts. To add new contact you can delete or edit existing one.</div>
				<?php
			}
			?>
			
			<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'contact_person_address_add','id' => 'contact_person_address_add')); ?>
			<?php echo form_hidden('form_action', 'add'); ?>
				
				<div class="form-row">				
					<div class="form-group col-md-6">
						<label for="contact_person_name" class="">Contact Person Name <span class="required">*</span></label>
						<?php 
						echo form_input(array(
						'name' => 'contact_person_name',
						'value' =>set_value('contact_person_name'),
						'id' => 'contact_person_name',
						'class' => 'form-control',
						'maxlength' => '30',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('contact_person_name'); ?>
					</div>
					<div class="form-group col-md-6">
						<label for="relationship_with_contact" class="">Relationship with Contact <span class="required">*</span></label>
						<?php
						echo form_dropdown('relationship_with_contact', $arr_relationship, set_value('relationship_with_contact') , array(
							'class' => 'form-control',
							'id' => 'relationship_with_contact'
						));
						?>
						<?php echo form_error('relationship_with_contact'); ?>
					</div>
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="contact_person_address" class="">Communication Address (Optional)</label>
						<?php 
						echo form_textarea(array(
						'name' => 'contact_person_address',
						'value' => set_value('contact_person_address'),
						'id' => 'contact_person_address',
						'class' => 'form-control',
						'maxlength' => '200',
						'rows'=>'2',
						'cols'=>'2',
						'placeholder' =>'House/Apt/Complex name & no, city/town, state, zip code'
						));
						?>
						<?php echo form_error('contact_person_address'); ?>
					</div>
				</div>
					
				<div class="form-row">	
					<div class="form-group col-md-6">
						<label for="contact_person_phone1" class="">Mobile Number <span class="required">*</span></label>
						<?php 
						echo form_input(array(
						'name' => 'contact_person_phone1',
						'value' => set_value('contact_person_phone1'),
						'id' => 'contact_person_phone1',
						'class' => 'form-control',
						'maxlength' => '10',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('contact_person_phone1'); ?>
					</div>
					<div class="form-group col-md-6">
						<label for="contact_person_phone2" class="">Phone Number(Optional)</label>
						<?php 
						echo form_input(array(
						'name' => 'contact_person_phone2',
						'value' => set_value('contact_person_phone2'),
						'id' => 'contact_person_phone2',
						'class' => 'form-control',
						'maxlength' => '15',
						'placeholder'=>'',
						));
						?>
						<?php echo form_error('contact_person_phone2'); ?>
					</div>				
				</div>
				<?php if($has_add_limit){ ?>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'content' => 'Submit','class' => 'btn btn-primary'));?>
				<?php } ?>
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary">Cancel</a>
				<?php echo form_close(); ?>
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->