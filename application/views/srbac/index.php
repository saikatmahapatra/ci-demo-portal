<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">SRBAC Roles</div>
            <div class="card-body">
                <?php echo isset($alert_message) ? $alert_message : ''; ?>

                <div class="table-responsive">
                    <table id="cms-datatable" class="table ci-table table-bordered table-hover w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created on</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot class="">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created on</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--/.table-responsive-->
            </div>
            <!--/.card-body-->
        </div>
        <!--/.card -->
    </div>
</div>
</div>
<!--/.row-->