<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card"> 
            <div class="card-header">Projects</div>
            <div class="card-body">
           
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="ci-link-group">
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>"
                        class="float-right btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i>
                        Add New</a>
                </div>

                <div class="table-responsive">
                    <table id="project-datatable" class="table ci-table table-sm table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Project</th>
                                <th scope="col">Code</th>
                                <!-- <th scope="col">Tagged Tasks</th> -->
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
        </div>
        <!--/.card ci-card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->