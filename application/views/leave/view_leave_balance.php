<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card"> 
            <div class="card-header">Data Table</div>
            <div class="card-body">           
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                
            <div class="export-form ">
                <div id="import_result_msg"></div>
                <?php echo form_open_multipart(current_url(), array( 'method' => 'post','class'=>'form-inline','name' => '','id' => 'import_form',)); ?>
                    <?php echo form_hidden('form_action', 'leave_balance_import'); ?>
                    <?php echo form_hidden('id', ''); ?>
                        <div class="form-group">
                            <label for="user_id" class="required">Select Exported File </label>
                            <?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control mx-2', 'required'=>'required', 'accept' =>'.xls, .xlsx'));?>
                            <?php echo form_error('userfile'); ?>
                        </div>
                        <button type="submit" class="btn ci-btn-primary btn-primary">Import Data</button>
                    <?php echo form_close(); ?>
                    <div class="form-text ci-form-help-text text-muted">Note: Only xls file is allowed with maximum 2MB of size. To import leave balance data you need to "Export Data" first & modify the excel file to import it.</div>
                </div>

                <div class="ci-link-group">
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/leave_balance');?>"
                        class="btn btn-sm btn-outline-success" title="Add"> <i class="fas fa-plus"></i> Add or Update Balance</a>
                    
                        <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ml-2', 'name' => 'download_data')); ?>
						<input type="hidden" name="form_action" value="download">
						<button type="submit" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Download data as excel"> <i class="fas fa-download" aria-hidden="true"></i> Export Data</button>
					<?php echo form_close(); ?>
                </div>

                <div class="table-responsive">
                    <table id="view-leave-bal-datatable" class="table ci-table table-sm table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Emp ID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">CL</th>
                                <th scope="col">PL</th>
                                <th scope="col">SL</th>
                                <th scope="col">CO</th>
                                <!-- <th scope="col">OL</th> -->
                                <th scope="col">Import Date</th>
                                <th scope="col">Created On</th>
                                <th scope="col">Updated On</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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