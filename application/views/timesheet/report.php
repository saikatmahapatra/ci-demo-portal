<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-header">Timesheet Report</div>
            <div class="card-body">
            
            <?php echo isset($alert_message) ? $alert_message : ''; ?>

                <?php echo form_open(site_url('timesheet/report'), array( 'method' => 'get','class'=>'ci-form','name' => '','id' => 'timesheet-search-form')); ?>
                <?php echo form_hidden('form_action', 'search'); ?>
                <?php 
                if(($this->input->get('redirected_from')=='reportee_id')){
                    ?>
                    <input type="hidden" name="redirected_from" value="<?php echo $this->input->get('redirected_from'); ?>">
                    <?php
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="from_date" class="sr-only required">From Date</label>
                        <?php 
                        $first_day_this_month = date('01-m-Y');
                        $last_day_this_month  = date('t-m-Y');
                    ?>
                        <?php echo form_input(array('name' => 'from_date','value' => (isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : $first_day_this_month),'id' => 'from_date','class' => 'form-control report-datepicker', 'placeholder' => 'From Date','readonly'=>true));?>
                        <?php echo form_error('from_date'); ?>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="to_date" class="sr-only required">To Date</label>
                        <?php echo form_input(array('name' => 'to_date','value' => (isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : $last_day_this_month),'class' => 'form-control report-datepicker','id' => 'to_date','placeholder' => 'To Date','readonly'=>true));?>
                        <?php echo form_error('to_date'); ?>
                    </div>
                    <div class="form-group col-md-3 ci-select2">
                        <label for="q_emp" class="sr-only">Employee </label>
                        <?php echo form_dropdown('q_emp', $user_arr, $this->input->get_post('q_emp'),array('class' => 'form-control select2-control', 'id'=>'q_emp')); ?>
                        <?php echo form_error('q_emp'); ?>
                    </div>

                    <div class="form-group col-md-3 ci-select2">
                        <label for="q_project" class="sr-only">Project </label>
                        <?php echo form_dropdown('q_project', $project_arr, $this->input->get_post('q_project'),array('class' => 'form-control select2-control','id'=>'q_project')); ?>
                        <?php echo form_error('q_project'); ?>
                    </div>
                    <div class="form-group col-md-2">
                    <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Search','class' => 'btn ci-btn-primary btn-primary mb-2 mr-2'));?>
                    <?php echo form_button(array('name' => 'reset_btn','type' => 'reset','content' => 'Reset','class' => 'btn btn-secondary mb-2','id'=>'reset_timesheet_form'));?>
                    </div>
                </div>
                    
                <?php echo form_close(); ?>

                <?php if(isset($data_rows) && sizeof($data_rows)>0){ ?>
                <?php echo form_open(current_url(), array('method' => 'GET', 'class' => 'mt-2', 'name' => 'download_data')); ?>
                <?php if(($this->input->get('redirected_from')=='reportee_id') && ($this->input->get('q_emp') !='')){ ?>
                    <input type="hidden" name="redirected_from" value="<?php echo $this->input->get('redirected_from'); ?>">
                <?php } ?>
                <input type="hidden" name="form_action" value="search">
                <input type="hidden" name="form_action_primary" value="download">
                <input type="hidden" name="q_emp" value="<?php echo $this->input->get('q_emp');?>">
                <input type="hidden" name="q_project" value="<?php echo $this->input->get('q_project');?>">
                <input type="hidden" name="from_date" value="<?php echo $this->input->get('from_date');?>">
                <input type="hidden" name="to_date" value="<?php echo $this->input->get('to_date');?>">
                <button type="submit" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip"
                    title="Download as excel"> <?php echo $this->common_lib->get_icon('download'); ?>
                    Download</button>
                <?php echo form_close(); ?>
                <?php } ?>

                <div class="table-responsive mt-3">
                    <?php /*if(isset($data_rows) && sizeof($data_rows)>0){ ?>
                    <?php echo form_open(current_url(), array('method' => 'GET', 'class' => 'form-inline my-3 ml-2', 'name' => 'download_data')); ?>
                    <input type="hidden" name="form_action" value="search">
                    <input type="hidden" name="form_action_primary" value="download">
                    <input type="hidden" name="q_emp" value="<?php echo $this->input->get('q_emp');?>">
                    <input type="hidden" name="q_project" value="<?php echo $this->input->get('q_project');?>">
                    <input type="hidden" name="from_date" value="<?php echo $this->input->get('from_date');?>">
                    <input type="hidden" name="to_date" value="<?php echo $this->input->get('to_date');?>">
                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Download"> <i
                            class="fas fa-fw fa-download" aria-hidden="true"></i> Download as Excel</button>
                    <?php echo form_close(); ?>
                    <?php } */ ?>

                    <table class="table ci-table table-sm table-striped w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Project</th>
                                <th scope="col">Task</th>
                                <th scope="col">Sub Task</th>
                                <th scope="col">Hours</th>
                                <th scope="col">Task Description</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data_rows)){ ?>
                            <?php if(sizeof($data_rows)>0) { ?>
                            <?php foreach($data_rows as $row){ ?>
                            <tr>
                                <td><?php echo $this->common_lib->display_date($row['timesheet_date']);?></td>
                                <td><?php echo $row['user_firstname'].' '.$row['user_lastname'];?></td>
                                <td><?php echo $row['project_name'].'-'.$row['project_number'];?></td>
                                <td><?php echo $row['task_name'];?></td>
                                <td>-</td>
                                <td><?php echo $row['timesheet_hours'];?></td>
                                <td><?php echo $row['timesheet_description'];?></td>
                            </tr>
                            <?php } // end foreach?>
                            <?php } else{ ?>
                            <tr>
                                <td colspan="7" class="">
                                    No records found based on your search criteria.
                                </td>
                            </tr>
                            <?php }?>
                            <?php } else {?>
                            <tr>
                                <td colspan="7" class="">
                                    Please search selecting employee, project and date range.
                                </td>
                            </tr>
                            <?php
				}
				?>
                        </tbody>
                    </table>
                    <?php echo isset($pagination_link) ? $pagination_link : ''; ?>
                </div>
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->