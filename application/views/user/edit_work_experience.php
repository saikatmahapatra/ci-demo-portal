<?php $row = $job_exp[0]; ?>

<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-9">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
                <?php echo form_hidden('form_action', 'edit'); ?>


                <div class="form-group">
                    <label for="company_id" class="required">Company Name</label>
                    <?php echo form_dropdown('company_id', $arr_company, isset($_POST['company_id']) ? set_value('company_id') : $row['company_id'], array( 'class' => 'form-control', 'id' => 'prev_company_id' )); ?>
                    <?php echo form_error('company_id'); ?>
                </div>
                <div class="form-group">
                    <label for="designation_id" class="required">Designation / Role</label>
                    <?php echo form_dropdown('designation_id', $arr_designation_prev_work, isset($_POST['designation_id']) ? set_value('designation_id') : $row['designation_id'], array( 'class' => 'form-control', 'id' => 'prev_designation_id' )); ?>
                    <?php echo form_error('designation_id'); ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="from_date" class="required">From Date</label>
                        <?php echo form_input(array( 'name' => 'from_date', 'value' => isset($_POST['from_date']) ? set_value('from_date') : $this->common_lib->display_date($row['from_date']), 'id' => 'from_date', 'maxlength' => '10', 'class' => 'form-control job-exp-datepicker', 'placeholder' => '', 'autocomplete'=>'off', 'readonly'=>true )); ?>
                        <?php echo form_error('from_date'); ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="to_date" class="required">To Date</label>
                        <?php echo form_input(array( 'name' => 'to_date', 'value' => isset($_POST['to_date']) ? set_value('to_date') : $this->common_lib->display_date($row['to_date']), 'id' => 'to_date', 'maxlength' => '10', 'class' => 'form-control job-exp-datepicker', 'placeholder' => '', 'autocomplete'=>'off', 'readonly'=>true )); ?>
                        <?php echo form_error('to_date'); ?>
                    </div>
                </div>

                <div class="form-row d-none">
                    <div class="form-group col-md-12">
                        <label for="job_description" class="optional">Key Roles </label>
                        <?php echo form_textarea(array('name' => 'job_description','value' => isset($_POST['job_description']) ? set_value('job_description') : $row['job_description'],'class' => 'form-control','id' => 'job_description','rows' => '2','cols' => '50','placeholder' => 'Describe roles')); ?>
                        <?php echo form_error('job_description'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>"
                    class="btn btn-light" data-button-type="cancel">Cancel</a>
                <?php echo form_close(); ?>

            </div>
            <!--./card-body-->
        </div>
        <!--/.card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->

<!-- Add Company Modal -->
<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="addCompany" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompanyTitle">Add New Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="responseMessage_addCompany"></div>
                <input type="text" class="form-control" id="new_company_name" name="new_company_name"
                    placeholder="Company Name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnaddCompany" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>


<!-- Add Designation Modal -->
<div class="modal fade" id="addDesignation" tabindex="-1" role="dialog" aria-labelledby="addDesignation"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDesignationTitle">Add New Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="responseMessage_addDesignation"></div>
                <input type="text" class="form-control" id="new_designation_name" name="new_designation_name"
                    placeholder="Designation Name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnaddDesignation" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>