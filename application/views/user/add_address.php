<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <div class="card-header h6">Add Address</div>
            <!--/.card-header-->
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
                <?php echo form_hidden('form_action', 'insert_address'); ?>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="address_type" class="required">Type of Address</label>
                        <div>
                            <?php if(isset($address_type)){
						foreach($address_type as $address_char=>$address_text){ ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <?php
							$radio_is_checked = $this->input->post('address_type') === $address_char;
							echo form_radio(array('name' => 'address_type','value' => $address_char,'id' => $address_char,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('address_type', $address_char));
						    ?>
                                <label class="custom-control-label"
                                    for="<?php echo $address_char;?>"><?php echo $address_text;?></span></label>
                            </div>

                            <?php
						}
					}
					?>
                        </div>
                        <?php echo form_error('address_type'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="address" class="required">Address</label>
                        <?php echo form_textarea(array('name' => 'address','value' => set_value('address'),'id' => 'address','class' => 'form-control','maxlength' => '120','rows'=>'2','cols'=>'2','placeholder'=>''));?>
                        <?php echo form_error('address'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="locality" class="required">Locality / Area Name</label>
                        <?php echo form_input(array('name' => 'locality','value' => set_value('locality'),'id' => 'locality','class' => 'form-control','placeholder'=>''));?>
                        <?php echo form_error('locality'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="city" class="required">City / District / Town</label>
                        <?php echo form_input(array('name' => 'city','value' =>set_value('city'),'id' => 'city','class' => 'form-control','maxlength' => '30','placeholder'=>'',));?>
                        <?php echo form_error('city'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="state" class="required">State / Union Territory</label>
                        <?php echo form_dropdown('state', $arr_states, set_value('state') , array('class' => 'form-control','id' => 'state'));?>
                        <?php echo form_error('state'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="zip" class="required">Pin Code</label>
                        <?php echo form_input(array('name' => 'zip','value' => set_value('zip'),'id' => 'zip','class' => 'form-control','maxlength' => '6','placeholder'=>''));?>
                        <?php echo form_error('zip'); ?>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="phone1" class="optional">Phone </label>
                        <?php echo form_input(array('name' => 'phone1','value' => set_value('phone1'),'id' => 'phone1','class' => 'form-control','maxlength' => '15','placeholder'=>'',));?>
                        <?php echo form_error('phone1'); ?>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="landmark" class="optional">Landmark </label>
                        <?php echo form_input(array('name' => 'landmark','value' => set_value('landmark'),'id' => 'landmark','class' => 'form-control','maxlength' => '100','placeholder'=>'',));?>
                        <?php echo form_error('landmark'); ?>
                    </div>
                </div>

                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>"
                    class="btn btn-light btn-cancel">Cancel</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->
    </div>
    <!--./card-body-->
    <!--<div class="card-footer"></div>-->
    <!--/.card-footer-->
</div>
<!--/.col-->
</div>
<!--/.row-->