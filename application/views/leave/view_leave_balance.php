<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-body">
            <h5 class="card-title">Data Table</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="ci-link-group">
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/leave_balance');?>"
                        class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i> Add or Update Balance</a>
                </div>

                <div class="table-responsive">
                    <table id="view-leave-bal-datatable" class="table ci-table table-striped table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Emp ID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">CL</th>
                                <th scope="col">SL</th>
                                <th scope="col">PL</th>
                                <th scope="col">OL</th>
                                <th scope="col">Imported On</th>
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