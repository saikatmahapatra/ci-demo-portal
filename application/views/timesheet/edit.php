<?php
$row = $rows[0];
//print_r($row);
?>

<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <div class="card-body">
            <h5 class="card-title">Edit Task</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>
                <?php echo form_hidden('id', $row['id']); ?>
                <?php echo form_hidden('selected_date', $row['timesheet_date']); ?>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="project_id" class="required">Project</label>
                        <?php echo form_dropdown('project_id', $project_arr, (isset($_POST['project_id']) ? set_value('project_id') : $row['project_id']), array('class' => 'form-control',));?>
                        <?php echo form_error('project_id'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="activity_id" class="required">Activity</label>
                        <?php echo form_dropdown('activity_id', $task_task_activity_type_array, (isset($_POST['activity_id']) ? set_value('activity_id') : $row['activity_id']), array('class' => 'form-control',));?>
                        <?php echo form_error('activity_id'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="timesheet_hours" class="required">Hours</label>
                        <?php echo form_input(array('name' => 'timesheet_hours','value' => (isset($_POST['timesheet_hours']) ? set_value('timesheet_hours') : $row['timesheet_hours']),'id' => 'timesheet_hours','class' => 'form-control w-25','maxlength' => '5','placeholder' => '0',));?>
                        <?php echo form_error('timesheet_hours'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="timesheet_description" class="required">Task Description</label>
                        <?php echo form_textarea(array('name' => 'timesheet_description','value' => (isset($_POST['timesheet_description']) ? set_value('timesheet_description') : $row['timesheet_description']),'id' => 'timesheet_description','class' => 'form-control','rows' => '2','cols' => '4','maxlength' => '200','placeholder' => 'Briefly describe in 200 characters.'));?>
                        <?php echo form_error('timesheet_description'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->