<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-8">
        <div class="card ci-card">
            <div class="card-header">Add or Update Leave Balance</div>
            <div class="card-body">
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="d-flex h-100 mb-2">
                    <div class="align-self-end ml-auto"> 
                        <a href="<?php echo base_url($this->router->directory.$this->router->class.'/view_leave_balance');?>" class="btn btn-outline-secondary"><?php echo $this->common_lib->get_icon('left_arrow'); ?> Back to List</a>
                    </div>
                </div>
                <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leavebalance',)); ?>
                <?php echo form_hidden('form_action', 'leave_balance_update'); ?>
                <?php echo form_hidden('id', set_value('id')); ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="user_id" class="required">Employee</label>
                        <?php echo form_dropdown('user_id', $user_dropdwon, set_value('user_id'), array('class' => 'form-control','id' => 'user_dropdown')); ?>
                        <?php echo form_error('user_id'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="cl" class="required">Casual Leave</label>
                        <?php echo form_input(array('name' => 'cl','value' => set_value('cl'),'id' => 'cl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
                        <?php echo form_error('cl'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sl" class="required">Sick Leave</label>
                        <?php echo form_input(array('name' => 'sl','value' => set_value('sl'),'id' => 'sl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
                        <?php echo form_error('sl'); ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pl" class="required">Priviledge Leave</label>
                        <?php echo form_input(array('name' => 'pl','value' => set_value('pl'),'id' => 'pl','class' => 'form-control', 'placeholder'=>'', 'maxlength'=>'6')); ?>
                        <?php echo form_error('pl'); ?>
                    </div>
                
                    <div class="form-group col-md-3">
                        <label for="ol" class="required">Optional Leave</label>
                        <?php echo form_input(array('name' => 'ol','value' => set_value('ol'),'id' => 'ol', 'class' => 'form-control','placeholder'=>'','maxlength' => '3')); ?>
                        <?php echo form_error('ol'); ?>
                    </div>
                </div>
                <button type="submit" class="btn ci-btn-primary btn-primary">Save Changes</button>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
    <div class="col-lg-4">
        <div class="card ci-card">
            <div class="card-header">Update Log</div>
            <div class="card-body">
                <div>Added on : <span id="created_on"></span></div>
                <div>Updated on : <span id="updated_on"></span></div>
                <div>PL auto updated on : <span id="pl_updated_by_cron_on"></span></div>
                <div>CL auto updated on : <span id="cl_updated_by_cron_on"></span></div>
                <div>OL auto updated on : <span id="ol_updated_by_cron_on"></span></div>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
</div>
<!--/.row-->