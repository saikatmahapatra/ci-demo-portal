<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header">Data Table</div>
            <div class="card-body">
                <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <div class="d-flex mb-2">
                    <div class="align-self-end ml-auto"> 
                    <a href="<?php echo base_url($this->router->directory.$this->router->class.'/add_task');?>" class="btn btn-outline-success"> <?php echo $this->common_lib->get_icon('plus'); ?>
                        Add New</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="task-datatable" class="table ci-table table-bordered table-hover w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot class="">
                            <tr>
                                <th scope="col">Task</th>
                                <th scope="col">Type</th>
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
    <!--/.col-->
</div>
<!--/.row-->