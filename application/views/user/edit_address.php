<?php $row = $address[0]; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Form
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="float-right btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Back to Profile"> <i class="fa fa-chevron-left"></i> Back</a>
			</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
        <?php echo form_hidden('form_action', 'update_address'); ?>
			<div class="form-row">
				<div class="form-group col-md-12">
					<!--<label for="address_type" class="">Communication Address Type <span class="required">*</span></label>-->
					<?php						
					/*if(isset($address_type)){
						foreach($address_type as $address_char=>$address_text){
							?>							
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = $row['address_type'];
									echo form_radio(array('name' => 'address_type','value' => $address_char,'id' => $address_char,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('address_type', $address_char));
								?>
								<label class="custom-control-label" for="<?php echo $address_char;?>"><?php echo $address_text;?></span></label>
							</div>
							
							<?php
						}
					}*/
					?>					
					<?php //echo form_error('address_type'); ?>
					<h6>Edit <?php echo $address_type[$row['address_type']];?></h6>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-12">        						
					<label for="address" class="">Address <span class="required">*</span></label>
					<?php 
					echo form_textarea(array(
					'name' => 'address',
					'value' => isset($_POST['address']) ? set_value('address') : $row['address'],
					'id' => 'address',
					'class' => 'form-control',
					'maxlength' => '120',
					'rows'=>'2',
					'cols'=>'2',
					'placeholder'=>'House/Building/Apartment Name & No , Street Name & No'
					));
					?>
					<?php echo form_error('address'); ?>
				</div>
			</div>
			
			<div class="form-row">				
				<div class="form-group col-md-6">						
					<label for="locality" class="">Locality / Area Name <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'locality',
						'value' => isset($_POST['locality']) ? set_value('locality') : $row['locality'],
						'id' => 'locality',
						'class' => 'form-control',
						'placeholder'=>''
					));
					?>
					<?php echo form_error('locality'); ?>
				</div>

				<div class="form-group col-md-6">        						
					<label for="zip" class="">Pin Code <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'zip',
						'value' => isset($_POST['zip']) ? set_value('zip') : $row['zip'],
						'id' => 'zip',
						'class' => 'form-control',
						'maxlength' => '6',
						'placeholder'=>''
					));
					?>
					<?php echo form_error('zip'); ?>
				</div>
			</div>
			
			
				
			<div class="form-row">				
				<div class="form-group col-md-6">
					<label for="city" class="">City / District / Town <span class="required">*</span></label>
					<?php 
					echo form_input(array(
					'name' => 'city',
					'value' =>isset($_POST['city']) ? set_value('city') : $row['city'],
					'id' => 'city',
					'class' => 'form-control',
					'maxlength' => '30',
					'placeholder'=>'',
					));
					?>
					<?php echo form_error('city'); ?>
				</div>				
				<div class="form-group col-md-6">
					<label for="state" class="">State/Union Territory <span class="required">*</span></label>
					<?php 
					/*echo form_input(array(
					'name' => 'state',
					'value' => isset($_POST['state']) ? set_value('state') : $row['state'],
					'id' => 'state',
					'class' => 'form-control',
					'maxlength' => '30',
					'placeholder'=>'',
					));*/
					echo form_dropdown('state', $arr_states, isset($_POST['state']) ? set_value('state') : $row['state'], array(
						'class' => 'form-control',
						'id' => 'state'
					));
					?>
					<?php echo form_error('state'); ?>
				</div>				
			</div>	
			
				
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label for="phone1" class="">Phone (Optional)</label>
					<?php 
					echo form_input(array(
					'name' => 'phone1',
					'value' => isset($_POST['phone1']) ? set_value('phone1') : $row['phone1'],
					'id' => 'phone1',
					'class' => 'form-control',
					'maxlength' => '15',
					'placeholder'=>'',
					));
					?>
					<?php echo form_error('phone1'); ?>
				</div>
				<div class="form-group col-md-6">
					<label for="landmark" class="">Landmark (Optional)</label>
					<?php 
					echo form_input(array(
					'name' => 'landmark',
					'value' => isset($_POST['landmark']) ? set_value('landmark') : $row['landmark'],
					'id' => 'landmark',
					'class' => 'form-control',
					'maxlength' => '100',
					'placeholder'=>'',
					));
					?>
					<?php echo form_error('landmark'); ?>
				</div>				
			</div>
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->