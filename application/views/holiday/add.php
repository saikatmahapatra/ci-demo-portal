<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <!-- <div class="card-header h6"></div> -->
            <!--/.card-header-->
            <div class="card-body">
            <h5 class="card-title">Add Holiday</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'insert'); ?>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="holiday_date" class="required">Holiday Date</label>
                        <?php echo form_input(array('name' => 'holiday_date', 'value' => set_value('holiday_date'), 'id' => 'holiday_date', 'class' => 'form-control holiday-datepicker', 'placeholder' => '', 'readonly'=>true));?>
                        <?php echo form_error('holiday_date'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="holiday_description" class="required">Holiday Occasion</label>
                        <?php echo form_input(array('name' => 'holiday_description', 'value' => set_value('holiday_description'), 'id' => 'holiday_description', 'class' => 'form-control', 'placeholder' => ''));?>
                        <?php echo form_error('holiday_description'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="holiday_type" class="required">Holiday Type</label>
                        <?php echo form_dropdown('holiday_type', $arr_holiday_type, set_value('holiday_type'), array('class' => 'form-control')); ?>
                        <?php echo form_error('holiday_type'); ?>
                    </div>
                </div>
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->