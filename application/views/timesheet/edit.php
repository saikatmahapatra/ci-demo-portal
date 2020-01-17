<?php
$row = $rows[0];
//print_r($row);
?>

<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-body">
            <h5 class="card-title">Edit Task</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>
                <?php echo form_hidden('id', $row['id']); ?>
                <?php echo form_hidden('selected_date', $row['timesheet_date']); ?>

                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="project_id" class="required">Project</label>
                        <?php echo form_dropdown('project_id', $project_arr, (isset($_POST['project_id']) ? set_value('project_id') : $row['project_id']), array('class' => 'form-control',));?>
                        <?php echo form_error('project_id'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="task_id_1" class="required">Task</label>
                        <?php echo form_dropdown('task_id_1', $arr_task_id_1, (isset($_POST['task_id_1']) ? set_value('task_id_1') : $row['task_id_1']), array('class' => 'form-control','data-render-target'=>'task_id_2', 'data-order'=>'2'));?>
                        <?php echo form_error('task_id_1'); ?>
                    </div>

                    <div class="form-group col-lg-6">
                        <label id="task_id_2" for="task_id_2" class="required">Sub Task</label>
                        <?php echo form_dropdown('task_id_2', $arr_task_id_2, (isset($_POST['task_id_2']) ? set_value('task_id_2') : $row['task_id_2']), array('class' => 'form-control'));?>
                        <?php echo form_error('task_id_2'); ?>
                    </div>
                </div>
                <!-- <div class="form-row">
                    <div class="form-group col-12">
                        <label id="task_id_3" for="task" class="required">Sub-Task</label>
                        <?php echo form_dropdown('task_id_3', array('' => '-Select-'), set_value('task_id_3'), array('class' => 'form-control',));?>
                        <?php echo form_error('task_id_3'); ?>
                    </div>
                </div> -->
                
                <div class="form-row">
                    <div class="form-group col-lg-4">
                        <label for="timesheet_hours" class="required">Hours</label>
                        <?php echo form_input(array('name' => 'timesheet_hours','value' => (isset($_POST['timesheet_hours']) ? set_value('timesheet_hours') : $row['timesheet_hours']),'id' => 'timesheet_hours','class' => 'form-control w-50','maxlength' => '5','placeholder' => '0',));?>
                        <?php echo form_error('timesheet_hours'); ?>
                    </div>
               
                    <div class="form-group col-lg-8">
                        <label for="timesheet_description" class="optional">Additional Note</label>
                        <?php echo form_input(array('name' => 'timesheet_description','value' => (isset($_POST['timesheet_description']) ? set_value('timesheet_description') : $row['timesheet_description']),'id' => 'timesheet_description','class' => 'form-control', 'maxlength' => '50','placeholder' => 'additional note')); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light ci-btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->