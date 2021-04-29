<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('table'); ?> Data Table</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
        
                <div class="d-flex mb-2">
                    <div class="align-self-end ml-auto"> 
                        <a href="<?php echo base_url($this->router->directory.$this->router->class.'/apply');?>" class="btn btn-link action-link"><?php echo $this->common_lib->get_icon('leave'); ?> Apply Leave</a>

                        <a href="<?php echo base_url($this->router->directory.'user/edit_approvers');?>" class="btn btn-link action-link"><?php echo $this->common_lib->get_icon('user_settings'); ?> Change Approvers</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table ci-table   table-striped w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Application No</th>
                                <th scope="col">Type</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Days</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col">Reason</th>-->
                                <th scope="col">Action</th>
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
                                    <span class="<?php echo $leave_status_arr[$row['leave_status']]['badge_css'];?>">
                                        <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
                                </td>
                                <!-- <td><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></td> -->
                                <td>
                                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/'.$row['leave_req_id'].'/history');?>"
                                        class="btn btn-datatable btn-icon btn-transparent-dark" 
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
                        <tfoot class="">
                            <tr>
                                <th scope="col">Application No</th>
                                <th scope="col">Type</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Days</th>
                                <th scope="col">Status</th>
                                <!-- <th scope="col">Reason</th>-->
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="float-right"><?php echo $pagination_link; ?></div>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
    <!--/.col-->
</div>
<!--/.row-->