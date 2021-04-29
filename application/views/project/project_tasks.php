<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('table'); ?> Data Table</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form','name' => 'myform','id' => 'myform','role' =>'form')); ?>
                <?php echo form_hidden('form_action', 'update'); ?>

                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="project_id" class="required">Project</label>
                        <?php echo form_dropdown('project_id', $arr_project, $this->uri->segment(4) ? $this->uri->segment(4) : set_value('project_id'), array('class' => 'form-control select2-control', 'id' => 'project_id_dd')); ?>
                        <?php echo form_error('project_id'); ?>
                    </div>
                </div>
                <?php //print_r($tagged_tasks);?>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="project_tasks" class="required">Tasks</label>
                        <?php echo form_multiselect('project_tasks[]', $arr_task_id_1, sizeof($tagged_tasks) > 0 ? $tagged_tasks : set_value('project_tasks'), array('class' => 'form-control select2-control')); ?>
                        <div id="project_tasks_help" class="form-text text-muted small">All sub-tasks of the above tasks will be automatically linked with the project. Sub-tasks will be displayed at timesheet on selecting the tasks from task drop down.</div>
                        <?php echo form_error('project_tasks[]'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit', 'data-button-type' => 'submit','content' => 'Save Changes','class' => 'btn btn-primary'));?>

                <a href="<?php echo base_url($this->router->directory.$this->router->class);?>"
                    class="btn btn-light" data-button-type="cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->