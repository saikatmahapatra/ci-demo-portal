<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
        <div class="card ci-card">
            <div class="card-header h6">Holidays</div>
            <!--/.card-header-->
            <div class="card-body">
            <?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>
                <div class="ci-link-group">
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>"
                        class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i> Add New</a>
                </div>

                <div class="table-responsive">
                    <table id="holiday-datatable" class="table ci-table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                                <th scope="col">Occasion</th>
                                <th scope="col">Holiday Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->