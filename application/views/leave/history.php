<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-header">Data Table</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
        
                <div class="d-flex mb-2">
                    <div class="align-self-end ml-auto"> 
                        <a href="<?php echo base_url($this->router->directory.$this->router->class.'/apply');?>" class="btn btn-outline-success"><?php echo $this->common_lib->get_icon('leave'); ?> Apply Leave</a>

                        <a href="<?php echo base_url($this->router->directory.'user/edit_approvers');?>" class="btn btn-outline-secondary"><?php echo $this->common_lib->get_icon('user_settings'); ?> Change Approvers</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table ci-table table-sm table-bordered w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Application No</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">From Date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Days</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col">Reason</th>-->
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
			if(sizeof($data_rows)>0){
				foreach($data_rows as $row){
					?>
                            <tr>
                                <td><a
                                        href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>"><?php echo $row['leave_req_id'];?></a>
                                </td>
                                <td><?php echo $leave_type_arr[$row['leave_type']];?> <?php echo ' - '.$row['leave_term'];?></td>
                                <td><?php echo $this->common_lib->display_date($row['leave_from_date']);?></td>
                                <td><?php echo $this->common_lib->display_date($row['leave_to_date']);?></td>
                                <td><?php echo $row['applied_for_days_count'];?></td>
                                <td>
                                    <span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>">
                                        <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
                                </td>
                                <!-- <td><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></td> -->
                                <td>
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>"
                                        class="btn btn-sm btn-light text-secondary" 
                                        title="Details"><?php echo $this->common_lib->get_icon('info'); ?></a>
                                </td>
                            </tr>
                            <?php
				}
			}
			else{
				?>
                            <tr>
                                <td colspan="7"> No leave records found</td>
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