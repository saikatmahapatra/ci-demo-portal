<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <?php echo isset($alert_message) ? $alert_message : ''; ?>
        <?php echo form_open_multipart(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'import_form',)); ?>
        <?php echo form_hidden('form_action', 'leave_balance_import'); ?>
        <?php echo form_hidden('id', ''); ?>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="user_id" class="required">File</label>
                <?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile','class' => 'form-control', 'required'=>'required', 'accept' =>'.xls, .xlsx'));?>
                <?php echo form_error('userfile'); ?>
                <div class="form-text small text-muted">Only .xls, .xlxs formats are supported. Imporatable file should have specific format. Please follow the format while importing records.</div>
            </div>
        </div>
        <button type="submit" data-button-type="submit" class="btn btn-lg btn-primary">Submit</button>
        <?php echo form_close(); ?>


        <div class="table-responsive mt-3">
            <h2>Leave Balance Master</h2>
            <table id="leave_balance_datatable" class="table ci-table   table-striped w-100">
                <thead class="">
                    <tr>
                        <th scope="col">Employee</th>
                        <th scope="col">Balance for month</th>
                        <th scope="col">CL</th>
                        <th scope="col">PL</th>
                        <th scope="col">SL</th>
                        <th scope="col">OL</th>
                        <th scope="col">Created/Updated on</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot class="">
                    <tr>
                        <th scope="col">Employee</th>
                        <th scope="col">Balance for month</th>
                        <th scope="col">CL</th>
                        <th scope="col">PL</th>
                        <th scope="col">SL</th>
                        <th scope="col">OL</th>
                        <th scope="col">Created/Updated on</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!--/.table-responsive-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->