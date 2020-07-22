<h1 class="page-title">Bootstrap Datepicker</h1>
<div class="card ci-card">
    <div class="card-header">
        Datepicker
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div data-format="yyyy-mm-dd" class="bs-datepicker-timesheet" id="timesheet_calendar"></div>
                <?php echo form_error('selected_date'); ?>
            </div>
            <div class="col-md-8 offset-md-1">
                <h6>Selected Dates</h6>
                <div class="bg-light small text-muted" id="selected_dates"></div>
                
                

                <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => '')); ?>
                <?php echo form_hidden('form_action', 'add'); ?>
                <?php echo form_hidden('selected_date', set_value('selected_date')); ?>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="first_name" class="required">First Name</label>
                        <?php echo form_input(array('name' => 'first_name', 'value' => set_value('first_name'),'id' => 'first_name','class' => 'form-control', 'placeholder' => '')); ?>
                        <?php echo form_error('first_name'); ?>
                    </div>
                </div>

                <?php echo form_submit(array('name' => 'submit', 'value' => 'Submit', 'id' => 'btn_submit', 'class' => 'btn ci-btn-primary btn-primary')); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>