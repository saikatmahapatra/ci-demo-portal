<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-md-12">
        <div class="card ci-card">
            <div class="card-header h6">SRBAC Roles</div>
            <!--/.card-header-->
            <div class="card-body">
                <?php echo isset($alert_message) ? $alert_message : ''; ?>

                <div class="table-responsive">
                    <table id="cms-datatable" class="table ci-table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created on</th>
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
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->

    </div>
</div>
</div>
<!--/.row-->