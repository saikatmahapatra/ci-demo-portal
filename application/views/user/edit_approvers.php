<?php 
//$row = $row[0]; 
$approver = sizeof($approvers)>0 ? $approvers[0] : null; 
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->


<div class="row">        
    <div class="col-md-6">
        <?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form',
            'name' => 'approvers',
            'id' => 'approvers',));
        ?>
        <?php echo form_hidden('form_action', 'update_approvers'); ?>
        
            <div class="form-row">
                <div class="form-group col-md-12 ci-select2">
                    <label for="" class="">Supervisor / Level 1 Approver <span class="required">*</span></label>
                    <?php echo form_dropdown('user_supervisor_id', $user_arr, isset($approver['user_supervisor_id']) ? $approver['user_supervisor_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_supervisor_id')); ?> 
                    <?php echo form_error('user_supervisor_id'); ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12 ci-select2">
                    <label for="" class="">Director / Level 2 Approver <span class="required">*</span></label>
                    <?php echo form_dropdown('user_director_approver_id', $user_arr, isset($approver['user_director_approver_id']) ? $approver['user_director_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_director_approver_id')); ?> 
                    <?php echo form_error('user_director_approver_id'); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 ci-select2">
                    <label for="" class="">HR Approver <span class="required">*</span></label>
                    <?php echo form_dropdown('user_hr_approver_id', $user_arr, isset($approver['user_hr_approver_id']) ? $approver['user_hr_approver_id'] : set_value('user_hr_approver_id') ,array('class' => 'form-control select2-control', 'id'=>'user_hr_approver_id')); ?> 
                    <?php echo form_error('user_hr_approver_id'); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12 ci-select2">
                    <label for="" class="">Finance Approver</label>
                    <?php echo form_dropdown('user_finance_approver_id', $user_arr, isset($approver['user_finance_approver_id']) ? $approver['user_finance_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_finance_approver_id')); ?> 
                    <?php echo form_error('user_finance_approver_id'); ?>
                </div>
            </div>
            <!-- <select class="form-control user-serach-dropdown-ajax"></select> -->
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div><!--/.col-md-6-->
</div>