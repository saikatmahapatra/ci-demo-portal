<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <div class="card-body">
                <h5 class="card-title">Add Emergency Contact Details</h5>
                <?php echo isset($alert_message) ? $alert_message : ''; ?>

                <?php
			if(!$has_add_limit){
				?>
                <div class="alert alert-info"><b>Note: </b> You have already added 3 emergency contacts. To add new
                    contact you can delete or edit existing one.</div>
                <?php
			}
			?>

                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'contact_person_address_add','id' => 'contact_person_address_add')); ?>
                <?php echo form_hidden('form_action', 'add'); ?>

                <div class="form-row">
                    <div class="form-group col-lg 6">
                        <label for="contact_person_name" class="required">Contact Person Name</label>
                        <?php echo form_input(array('name' => 'contact_person_name','value' =>set_value('contact_person_name'),'id' => 'contact_person_name','class' => 'form-control','maxlength' => '30','placeholder'=>'',)); ?>
                        <?php echo form_error('contact_person_name'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="relationship_with_contact" class="required">Relationship with Contact</label>
                        <?php echo form_dropdown('relationship_with_contact', $arr_relationship, set_value('relationship_with_contact') , array('class' => 'form-control','id' => 'relationship_with_contact')); ?>
                        <?php echo form_error('relationship_with_contact'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="contact_person_address" class="">Communication Address</label>
                        <?php echo form_textarea(array('name' => 'contact_person_address','value' => set_value('contact_person_address'),'id' => 'contact_person_address','class' => 'form-control','maxlength' => '200','rows'=>'2','cols'=>'2','placeholder' =>'')); ?>
                        <?php echo form_error('contact_person_address'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="contact_person_phone1" class="required">Mobile Number</label>
                        <?php echo form_input(array('name' => 'contact_person_phone1','value' => set_value('contact_person_phone1'),'id' => 'contact_person_phone1','class' => 'form-control','maxlength' => '10','placeholder'=>'',)); ?>
                        <?php echo form_error('contact_person_phone1'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="contact_person_phone2" class="optional">Phone Number</label>
                        <?php echo form_input(array('name' => 'contact_person_phone2','value' => set_value('contact_person_phone2'),'id' => 'contact_person_phone2','class' => 'form-control','maxlength' => '15','placeholder'=>'',));?>
                        <?php echo form_error('contact_person_phone2'); ?>
                    </div>
                </div>
                <?php if($has_add_limit){ ?>
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'content' => 'Submit','class' => 'btn btn-primary'));?>
                <?php } ?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>"
                    class="btn btn-light btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--./card-body-->
        </div>
        <!--/.card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->