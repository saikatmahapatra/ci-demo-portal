<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-header">Search Data</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <ul><?php echo validation_errors(); ?></ul>
                <?php echo form_open(base_url('leave/manage'), array( 'method' => 'get','class'=>'ci-form form-inline','name' => '','id' => 'leave-search-form')); ?>
                <?php echo form_hidden('form_action', 'search'); ?>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_from_date" class="sr-only required">From</label>
                    <?php echo form_input(array('name' => 'leave_from_date','value' => (isset($_REQUEST['leave_from_date']) ? $_REQUEST['leave_from_date'] : ''),'id' => 'leave_from_date','class' => 'form-control form-control-datepicker', 'placeholder' => 'From Date','readonly'=>true));?>
                    <?php //echo form_error('leave_from_date'); ?>
                </div>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_to_date" class="sr-only required">To</label>
                    <?php echo form_input(array('name' => 'leave_to_date','value' => (isset($_REQUEST['leave_to_date']) ? $_REQUEST['leave_to_date'] : ''),'class' => 'form-control form-control-datepicker','id' => 'leave_to_date','placeholder' => 'To Date','readonly'=>true));?>
                    <?php //echo form_error('leave_to_date'); ?>
                </div>

                <div class="form-group mb-2 mr-sm-2">
                    <label for="leave_status" class="sr-only required">Leave Status</label>
                    <?php 
				$leave_status = array();
				$leave_status[''] = 'Leave Status';
				foreach($leave_status_arr as $key=>$val){
                    if($key != 'P'){
                        $leave_status[$key] = $val['text'];
                    }
				}
			?>
                    <?php echo form_dropdown('leave_status', $leave_status, $this->input->get_post('leave_status'),array('class' => 'form-control','id'=>'leave_status')); ?>
                    <?php //echo form_error('leave_status'); ?>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Search','class' => 'btn ci-btn-primary btn-primary mb-2 mr-2'));?>
                <?php //echo form_input(array('name' => 'reset_btn','type' => 'reset','value' => 'Reset','class' => 'btn btn-secondary', 'id' => 'reset_leave_search_form'));?>
                <a href="<?php echo base_url('leave/manage');?>" class="btn btn-light mb-2">Reset</a>
                <?php echo form_close(); ?>

                <div class="table-responsive mt-3">
                    <div class="status-icon-group status-icon-justify mb-3">
                        <span class=""><?php echo $this->common_lib->get_icon(' ', 'text-secondary fa-sm'); ?> Pending</span>
                        <span class=""><?php echo $this->common_lib->get_icon('leave_status', 'text-success'); ?> Approved</span>
                        <span class=""><?php echo $this->common_lib->get_icon('leave_status', 'text-danger'); ?> Rejected</span>
                        <span class=""><?php echo $this->common_lib->get_icon('leave_status', 'text-warning'); ?>
                            Cancelled</span>
                    </div>
                    <!--/.status-icon-group status-icon-justify-->
                    <table class="table ci-table table-bordered table-hover w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Application No</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Applicant</th>
                                <th scope="col">L1 Approver</th>
                                <th scope="col">L2 Approver</th>
                                <th scope="col">Duration</th>
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
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>"><?php echo $row['leave_req_id'];?></a>
                                </td>
                                <td>
                                    <?php echo isset($row['leave_type']) ? $row['leave_type'] : '' ;?>
                                    <?php echo isset($row['leave_term']) ? '- '.$row['leave_term'] : '' ;?>
                                </td>
                                <td>
                                    <?php echo isset($row['user_firstname']) ? $row['user_firstname'] : ''?>
                                    <?php echo isset($row['user_lastname']) ? $row['user_lastname'] : ''?>
                                </td>
                                <td>
                                    <?php 
                                    $fa_icon = $this->common_lib->get_icon(' ', 'text-secondary fa-sm');
                                    if($row['supervisor_approver_status'] == 'A'){
                                        $fa_icon = $this->common_lib->get_icon('leave_status');
                                    }
                                    if($row['supervisor_approver_status'] == 'R'){
                                        $fa_icon = $this->common_lib->get_icon('leave_status');
                                    }
                                    if($row['supervisor_approver_status'] == 'C'){
                                        $fa_icon = $this->common_lib->get_icon('leave_status');
                                    }
                                    ?>
                                    <?php echo isset($row['supervisor_approver_status']) ? '<span class="'.$leave_status_arr[$row['supervisor_approver_status']]['css'].'">'.$fa_icon.'</span>' : ''; ?>
                                    <?php echo isset($row['supervisor_approver_firstname']) ? $row['supervisor_approver_firstname'] : ''?>
                                    <?php echo isset($row['supervisor_approver_lastname']) ? $row['supervisor_approver_lastname'] : ''?>
                                </td>
                                <td>
                                    <?php 
                                        $fa_icon = $this->common_lib->get_icon(' ', 'text-secondary fa-sm');
                                        if($row['director_approver_status'] == 'A'){
                                            $fa_icon = $this->common_lib->get_icon('leave_status');
                                        }
                                        if($row['director_approver_status'] == 'R'){
                                            $fa_icon = $this->common_lib->get_icon('leave_status');
                                        }
                                        if($row['director_approver_status'] == 'C'){
                                            $fa_icon = $this->common_lib->get_icon('leave_status');
                                        }
                                    ?>
                                    <?php echo isset($row['director_approver_status']) ? '<span class="'.$leave_status_arr[$row['director_approver_status']]['css'].'">'.$fa_icon.'</span>': ''; ?>
                                    <?php echo isset($row['director_approver_firstname']) ? $row['director_approver_firstname'] : ''?>
                                    <?php echo isset($row['director_approver_lastname']) ? $row['director_approver_lastname'] : ''?>
                                </td>
                                <td>
                                    <?php echo $this->common_lib->display_date($row['leave_from_date']);?>
                                    <?php echo ' to '.$this->common_lib->display_date($row['leave_to_date']);?>
                                    <?php //echo ', '.$row['applied_for_days_count'].' day(s)';?></td>
                                <td><span
                                        class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"><?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
                                </td>
                                <td>
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/'.$this->uri->segment(2).'/'.$this->uri->segment(3));?>"
                                        class="btn btn-sm btn-light text-secondary" 
                                        title="Details"><?php echo $this->common_lib->get_icon('info', 'dt_action_icon');?></a>

                                </td>
                            </tr>
                            <?php
				}
			}
			else{
				?>
                            <tr>
                                <td colspan="7">
                                    <?php if($this->input->get_post('form_action') === 'search') {
                                        ?>
                                        <div class="mt-3 alert alert-danger"><?php echo $this->common_lib->get_icon('warning'); ?> No result found based on your search criteria. Please search again.</div>
                                        <?php
                                        } else {?>
                                        <div class="mt-3 alert alert-info"><?php echo $this->common_lib->get_icon('warning'); ?> There are no leave requests awaiting for your approval. You can search leave records.</div>
                                        <?php
                                    }?>
                                </td>
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