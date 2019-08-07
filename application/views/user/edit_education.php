<?php $row = $education[0]; ?>
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
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form','name' => 'edit_education', 'id' => 'edit_education'));?>
        <?php echo form_hidden('form_action', 'edit'); ?>
			
			<div class="form-row">                
				<div class="form-group col-md-4">                                
					<label for="academic_qualification" class="">Qualification <span class="required">*</span></label>
					<?php
					echo form_dropdown('academic_qualification', $arr_academic_qualification, isset($_POST['academic_qualification']) ? set_value('academic_qualification') : $row['academic_qualification'] , array(
						'class' => 'form-control',
						'id' => 'academic_qualification',
					));
					?> 
					<?php echo form_error('academic_qualification'); ?>
				</div>	

				<div class="form-group col-md-4">                                
					<label for="academic_degree" class="">Degree <span class="required">*</span></label>
					<?php
					echo form_dropdown('academic_degree', $arr_academic_degree, isset($_POST['academic_degree']) ? set_value('academic_degree') : $row['academic_degree'], array(
						'class' => 'form-control',
						'id' => 'academic_degree'
					));
					?> 
					<?php echo form_error('academic_degree'); ?>
				</div>

				<div class="form-group col-md-4">        							
					<label for="academic_specialization" class="">Specialization <span class="required">*</span></label>
					<?php
					echo form_dropdown('academic_specialization', $arr_academic_specialization, isset($_POST['academic_specialization']) ? set_value('academic_specialization') : $row['academic_specialization'], array(
						'class' => 'form-control',
						'id' => 'academic_specialization',
					));
					?> 
					<?php echo form_error('academic_specialization'); ?>
				</div>					
            </div>
			<div class="form-group">                                
					<label for="academic_institute" class="">University / Board / Council <span class="required">*</span></label>
					<?php
					echo form_dropdown('academic_institute', $arr_academic_inst, isset($_POST['academic_institute']) ? set_value('academic_institute') : $row['academic_institute'], array(
						'class' => 'form-control',
						'id' => 'academic_institute',
					));
					?> 
					<?php echo form_error('academic_institute'); ?>
				</div>
			<div class="form-row">
				<div class="form-group col-md-4">        						
					<label for="academic_from_year" class="">From Year <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'academic_from_year',
						'value' => isset($_POST['academic_from_year']) ? set_value('academic_from_year') : $row['academic_from_year'],
						'id' => 'academic_from_year',
						'class' => 'form-control',
						'maxlength' => '4',
						'placeholder'=>''
					));
					?>
					<?php echo form_error('academic_from_year'); ?>
				</div>
				<div class="form-group col-md-4">        						
					<label for="academic_to_year" class="">To Year <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'academic_to_year',
						'value' => isset($_POST['academic_to_year']) ? set_value('academic_to_year') : $row['academic_to_year'],
						'id' => 'academic_to_year',
						'class' => 'form-control',
						'maxlength' => '4',
						'placeholder'=>''
					));
					?>
					<?php echo form_error('academic_to_year'); ?>
				</div>
				<div class="form-group col-md-4">        						
					<label for="academic_marks_percentage" class="">% Marks <span class="required">*</span></label>
					<?php
					echo form_input(array(
						'name' => 'academic_marks_percentage',
						'value' => isset($_POST['academic_marks_percentage']) ? set_value('academic_marks_percentage') : $row['academic_marks_percentage'],
						'id' => 'academic_marks_percentage',
						'class' => 'form-control',
						'maxlength' => '5',
						'placeholder'=>'ex. 78.0'
					));
					?>
					<?php echo form_error('academic_marks_percentage'); ?>
				</div>
			</div>
			
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary">Cancel</a>
        <?php echo form_close(); ?>
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->


<!-- Modal -->
<div class="modal fade" id="addDegree" tabindex="-1" role="dialog" aria-labelledby="addDegree" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDegreeTitle">Add New Degree</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div id="responseMessage_addDegree"></div>
        <input type="text" class="form-control" id="new_degree_name" name="new_degree_name" placeholder="Degree Name">				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnAddDegree" class="btn btn-primary">Save changes</button>
        
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addSpecialization" tabindex="-1" role="dialog" aria-labelledby="addSpecialization" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSpecializationTitle">Add New Specialization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div id="responseMessage_addSpecialization"></div>
        <input type="text" class="form-control" id="new_specialization_name" name="new_specialization_name" placeholder="Specialization Name">				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnAddSpecialization" class="btn btn-primary">Save changes</button>
        
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addInst" tabindex="-1" role="dialog" aria-labelledby="addInst" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInstTitle">Add New University</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div id="responseMessage_addInst"></div>
        <input type="text" class="form-control" id="new_inst_name" name="new_inst_name" placeholder="University/Board/Council Name">				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnAddInst" class="btn btn-primary">Save changes</button>
        
      </div>
    </div>
  </div>
</div>