<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('table'); ?> Data Table</div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
            
                <div class="d-flex mb-2">
                    <div class="align-self-end ml-auto"> 
                        <a href="<?php echo base_url($this->router->directory.$this->router->class.'/add_holiday');?>" class="btn btn-link action-link"> <?php echo $this->common_lib->get_icon('plus'); ?> Add New</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="holiday-datatable" class="table ci-table   table-striped w-100">
                        <thead class="">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                                <th scope="col">Occasion</th>
                                <th scope="col">Holiday Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot class="">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                                <th scope="col">Occasion</th>
                                <th scope="col">Holiday Type</th>
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