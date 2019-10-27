<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <!-- <div class="card-header h6"></div> -->
            <!--/.card-header-->
            <div class="card-body">
            <h5 class="card-title">Timesheet Activities</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="ci-link-group">
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/add_activity');?>"
                        class="float-right btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i>
                        Add New</a>
                </div>
                <div class="table-responsive">
                    <table id="activity-datatable" class="table ci-table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Activity Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
            <!-- <div class="card-footer">
            </div> -->
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->