<?php
$row = $options;
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('form_icon'); ?> Form</div>
            <div class="card-body">
                
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>
                
                <div class="form-group row">
                    <label for="timesheet_disable_prev_month" class="col-sm-4 col-form-label">Disable Previous Months</label>
                    <div class="col-sm-5">
                    <?php echo form_dropdown('timesheet_disable_prev_month', array('true'=>'Yes', 'false'=>'No'), (isset($_POST['timesheet_disable_prev_month']) ? set_value('timesheet_disable_prev_month') : $row['timesheet_disable_prev_month']), array('class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_disable_prev_month'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="timesheet_disable_prev_month" class="col-sm-4 col-form-label">Disable Next Months</label>
                    <div class="col-sm-5">
                    <?php echo form_dropdown('timesheet_disable_next_month', array('true'=>'Yes', 'false'=>'No'), (isset($_POST['timesheet_disable_next_month']) ? set_value('timesheet_disable_next_month') : $row['timesheet_disable_next_month']), array('class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_disable_next_month'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="timesheet_enable_prev_days" class="col-sm-4 col-form-label">Enable Previous Days</label>
                    <div class="col-sm-5">
                    <?php echo form_input(array('name' => 'timesheet_enable_prev_days', 'value' => (isset($_POST['timesheet_enable_prev_days']) ? set_value('timesheet_enable_prev_days') : $row['timesheet_enable_prev_days']),'id' => 'timesheet_enable_prev_days','placeholder'=>'Default: 3', 'class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_enable_prev_days'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="timesheet_enable_next_days" class="col-sm-4 col-form-label">Enable Next Days</label>
                    <div class="col-sm-5">
                    <?php echo form_input(array('name' => 'timesheet_enable_next_days', 'value' => (isset($_POST['timesheet_enable_next_days']) ? set_value('timesheet_enable_next_days') : $row['timesheet_enable_next_days']),'id' => 'timesheet_enable_next_days','placeholder'=>'Default: 0', 'class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_enable_next_days'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="timesheet_report_max_date_range" class="col-sm-4 col-form-label">Report allowed of max days</label>
                    <div class="col-sm-5">
                    <?php echo form_input(array('name' => 'timesheet_report_max_date_range', 'value' => (isset($_POST['timesheet_report_max_date_range']) ? set_value('timesheet_report_max_date_range') : $row['timesheet_report_max_date_range']),'id' => 'timesheet_report_max_date_range','placeholder'=>'Default: 30', 'class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_report_max_date_range'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="timesheet_apply_settings" class="col-sm-4 col-form-label">Apply Above Settings</label>
                    <div class="col-sm-5">
                    <?php echo form_dropdown('timesheet_apply_settings', array('true'=>'Yes', 'false'=>'No'), (isset($_POST['timesheet_apply_settings']) ? set_value('timesheet_apply_settings') : $row['timesheet_apply_settings']), array('class' => 'form-control')); ?>
                    <?php echo form_error('timesheet_apply_settings'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Save Changes','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->