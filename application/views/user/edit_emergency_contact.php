<?php $row = $econtact[0]; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-6">
		<div class="card ci-card">
			<div class="card-header h6">Edit Emergency Contact</div><!--/.card-header-->

			<div class="card-body">
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'contact_person_address_add','id' => 'contact_person_address_add')); ?>
				<?php echo form_hidden('form_action', 'update'); ?>
			
			<div class="form-row">
				<div class="form-group col-lg-6">
					<label for="contact_person_name" class="required">Contact Person Name</label>
					<?php echo form_input(array('name' => 'contact_person_name','value' => isset($_POST['contact_person_name']) ? set_value('contact_person_name') : $row['contact_person_name'],'id' => 'contact_person_name','class' => 'form-control','maxlength' => '30','placeholder'=>'',)); ?>
					<?php echo form_error('contact_person_name'); ?>
				</div>
				<div class="form-group col-lg-6">
					<label for="relationship_with_contact" class="required">Relationship with Contact</label>
					<?php echo form_dropdown('relationship_with_contact', $arr_relationship, isset($_POST['relationship_with_contact']) ? set_value('relationship_with_contact') : $row['relationship_with_contact'] , array('class' => 'form-control','id' => 'relationship_with_contact'));?>
					<?php echo form_error('relationship_with_contact'); ?>
				</div>
			</div>	
			
			<div class="form-row">
				<div class="form-group col-lg-12">
					<label for="contact_person_address" class="">Communication Address</label>
					<?php echo form_textarea(array('name' => 'contact_person_address','value' => isset($_POST['contact_person_address']) ? set_value('contact_person_address') : $row['contact_person_address'],'id' => 'contact_person_address','class' => 'form-control','maxlength' => '200','rows'=>'2','cols'=>'2','placeholder' =>''));?>
					<?php echo form_error('contact_person_address'); ?>
				</div>
			</div>
				
			<div class="form-row">	
				<div class="form-group col-lg-6">
					<label for="contact_person_phone1" class="required">Mobile Number</label>
					<?php echo form_input(array('name' => 'contact_person_phone1','value' => isset($_POST['contact_person_phone1']) ? set_value('contact_person_phone1') : $row['contact_person_phone1'],'id' => 'contact_person_phone1','class' => 'form-control','maxlength' => '10','placeholder'=>'',)); ?>
					<?php echo form_error('contact_person_phone1'); ?>
				</div>
				<div class="form-group col-lg-6">
					<label for="contact_person_phone2" class="optional">Phone Number</label>
					<?php echo form_input(array('name' => 'contact_person_phone2','value' => isset($_POST['contact_person_phone2']) ? set_value('contact_person_phone2') : $row['contact_person_phone2'],'id' => 'contact_person_phone2','class' => 'form-control','maxlength' => '15','placeholder'=>'',));?>
					<?php echo form_error('contact_person_phone2'); ?>
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