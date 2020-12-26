<?php 
//$row = $row[0]; 
$approver = sizeof($approvers)>0 ? $approvers[0] : null; 
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-9">
		<div class="card ">
            <div class="card-header"><?php echo $this->app_lib->get_icon('form_icon'); ?> Form</div>
			<div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="d-flex mb-2">
                    <div class="align-self-end ml-auto"> 
                    <a href="<?php echo base_url($this->router->directory.'leave/apply');?>" class="btn btn-link action-link"><?php echo $this->app_lib->get_icon('leave'); ?> Apply Leave</a>
                    </div>
                </div>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form',
                    'name' => 'approvers',
                    'id' => 'approvers',));
                ?>
                        <?php echo form_hidden('form_action', 'update_approvers'); ?>
                        <div class="form-row">
                            <div class="form-group ci-select2 col-lg-6">
                                <label for="" class="required">L1 Approver (Initial)</label>
                                <?php echo form_dropdown('user_supervisor_id', $user_arr, isset($approver['user_supervisor_id']) ? $approver['user_supervisor_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_supervisor_id')); ?> 
                                <?php echo form_error('user_supervisor_id'); ?>
                            </div>
                            <div class="form-group ci-select2 col-lg-6">
                                <label for="" class="required">L2 Approver (Final)</label>
                                <?php echo form_dropdown('user_director_approver_id', $user_arr, isset($approver['user_director_approver_id']) ? $approver['user_director_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_director_approver_id')); ?> 
                                <?php echo form_error('user_director_approver_id'); ?>
                            </div>
                        </div>
                        
                        <div class="form-row d-none">
                            <div class="form-group ci-select2 col-lg-6 d-none">
                                <label for="" class="required">HR</label>
                                <?php echo form_dropdown('user_hr_approver_id', $user_arr, isset($approver['user_hr_approver_id']) ? $approver['user_hr_approver_id'] : set_value('user_hr_approver_id') ,array('class' => 'form-control select2-control', 'id'=>'user_hr_approver_id')); ?> 
                                <?php echo form_error('user_hr_approver_id'); ?>
                            </div>
                            <div class="form-group ci-select2 col-lg-6 d-none">
                                <label for="" class="">Finance Approver</label>
                                <?php echo form_dropdown('user_finance_approver_id', $user_arr, isset($approver['user_finance_approver_id']) ? $approver['user_finance_approver_id'] : set_value('user_supervisor_id') ,array('class' => 'form-control select2-control', 'id'=>'user_finance_approver_id')); ?> 
                                <?php echo form_error('user_finance_approver_id'); ?>
                            </div>
                        </div>

                    <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <?php echo form_close(); ?>
			
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->