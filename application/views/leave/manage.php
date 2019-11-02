<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-body">
                <h5 class="card-title">Leave Requests</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array( 'method' => 'get','class'=>'ci-form form-inline','name' => '','id' => 'leave-search-form')); ?>
                <?php echo form_hidden('form_action', 'search'); ?>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_status" class="sr-only">Leave Status</label>
                    <?php 
				$leave_status = array();
				$leave_status[''] = 'All Leave Status';
				foreach($leave_status_arr as $key=>$val){
					$leave_status[$key] = $val['text'];
				}
			?>
                    <?php echo form_dropdown('leave_status', $leave_status, $this->input->get_post('leave_status'),array('class' => 'form-control','id'=>'leave_status')); ?>
                    <?php echo form_error('leave_status'); ?>
                </div>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_from_date" class="sr-only">Leave From Date</label>
                    <?php 
				$first_day_this_month = '';
				$last_day_this_month  = '';
			?>
                    <?php echo form_input(array('name' => 'leave_from_date','value' => (isset($_REQUEST['leave_from_date']) ? $_REQUEST['leave_from_date'] : $first_day_this_month),'id' => 'leave_from_date','class' => 'form-control form-control-datepicker', 'placeholder' => 'From Date','readonly'=>true));?>
                    <?php echo form_error('leave_from_date'); ?>
                </div>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_to_date" class="sr-only">Leave To Date </label>
                    <?php echo form_input(array('name' => 'leave_to_date','value' => (isset($_REQUEST['leave_to_date']) ? $_REQUEST['leave_to_date'] : $last_day_this_month),'class' => 'form-control form-control-datepicker','id' => 'leave_to_date','placeholder' => 'To Date','readonly'=>true));?>
                    <?php echo form_error('leave_to_date'); ?>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Search','class' => 'btn ci-btn-primary btn-primary mb-2 mr-2'));?>
                <?php //echo form_input(array('name' => 'reset_btn','type' => 'reset','value' => 'Reset','class' => 'btn btn-secondary', 'id' => 'reset_leave_search_form'));?>
                <a href="<?php echo current_url();?>" class="btn btn-secondary mb-2">Reset</a>
                <?php echo form_close(); ?>

                <div class="table-responsive mt-3">
                    <div class="status-icon-group status-icon-justify mb-3">
                        <span class=""><i class="fa fa-fw fa-check text-success" aria-hidden="true"></i> Approved</span>
                        <span class=""><i class="fa fa-fw fa-close text-danger" aria-hidden="true"></i> Rejected</span>
                        <span class=""><i class="fa fa-fw fa-close text-warning" aria-hidden="true"></i>
                            Cancelled</span>
                    </div>
                    <!--/.status-icon-group status-icon-justify-->
                    <table class="table ci-table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Request No</th>
                                <th scope="col">Applicant</th>
                                <th scope="col">L1 Approver</th>
                                <th scope="col">L2 Approver</th>
                                <th scope="col">Leave Summary</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
			if(sizeof($data_rows)>0){
				foreach($data_rows as $row){
					//print_r($row);
					?>
                            <tr>
                                <td>
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>"
                                        title="Click here to view details"><?php echo $row['leave_req_id'];?></a>
                                </td>
                                <td>
                                    <?php echo isset($row['user_firstname']) ? $row['user_firstname'] : ''?>
                                    <?php echo isset($row['user_lastname']) ? $row['user_lastname'] : ''?>
                                    <?php echo isset($row['user_emp_id']) ? '('.$row['user_emp_id'].')' : ''?>
                                </td>
                                <td>
                                    <?php 
							$fa_icon = '';
							if($row['supervisor_approver_status'] == 'A'){
								$fa_icon = 'fa-check';
							}
							if($row['supervisor_approver_status'] == 'R'){
								$fa_icon = 'fa-close';
							}
							if($row['supervisor_approver_status'] == 'C'){
								$fa_icon = 'fa-close';
							}
							?>
                                    <?php echo isset($row['supervisor_approver_status']) ? '<span class="'.$leave_status_arr[$row['supervisor_approver_status']]['css'].'"><i class="fa fa-fw '.$fa_icon.'" aria-hidden="true"></i></span>' : ''; ?>
                                    <?php echo isset($row['supervisor_approver_firstname']) ? $row['supervisor_approver_firstname'] : ''?>
                                    <?php echo isset($row['supervisor_approver_lastname']) ? $row['supervisor_approver_lastname'] : ''?>
                                    <?php echo isset($row['supervisor_approver_emp_id']) ? '('.$row['supervisor_approver_emp_id'].')' : ''?>
                                </td>
                                <td>
                                    <?php 
							$fa_icon = '';
							if($row['director_approver_status'] == 'A'){
								$fa_icon = 'fa-check';
							}
							if($row['director_approver_status'] == 'R'){
								$fa_icon = 'fa-close';
							}
							if($row['director_approver_status'] == 'C'){
								$fa_icon = 'fa-close';
							}
							?>
                                    <?php echo isset($row['director_approver_status']) ? '<span class="'.$leave_status_arr[$row['director_approver_status']]['css'].'"><i class="fa fa-fw '.$fa_icon.'" aria-hidden="true"></i></span>': ''; ?>
                                    <?php echo isset($row['director_approver_firstname']) ? $row['director_approver_firstname'] : ''?>
                                    <?php echo isset($row['director_approver_lastname']) ? $row['director_approver_lastname'] : ''?>
                                    <?php echo isset($row['director_approver_emp_id']) ? '('.$row['director_approver_emp_id'].')' : ''?>

                                </td>
                                <td>
                                    <?php echo $row['leave_type'];?>
                                    <?php echo $this->common_lib->display_date($row['leave_from_date']);?>
                                    <?php echo ' to '.$this->common_lib->display_date($row['leave_to_date']);?>
                                    <?php //echo ', '.$row['applied_for_days_count'].' day(s)';?></td>
                                <td><span
                                        class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"><?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
                                </td>
                                <td>
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>"
                                        class="btn btn-outline-info btn-sm" data-toggle="tooltip"
                                        title="View Details"><i class="fa fa-fw  fa-info-circle"
                                            aria-hidden="true"></i></a>

                                </td>
                            </tr>
                            <?php
				}
			}
			else{
				?>
                            <tr>
                                <td colspan="7">No result found</td>
                            </tr>
                            <?php
			}
			?>
                        </tbody>
                    </table>
                    <div class="float-right"><?php echo $pagination_link; ?></div>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->