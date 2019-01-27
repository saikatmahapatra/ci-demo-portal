<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
		<p>Where 1 is very poor an 5 is very satisfactory</p>
    </div>
	
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-8">
	<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}

	?>
    <?php echo form_open_multipart(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => '','id' => '',));?>
    <?php echo form_hidden('form_action', 'send'); ?>
        <div class="form-row">
			<div class="form-group col-md-12">
				<label for="ui_color_scheme">User Interface (color of theme, buttons, links) <span class="required">*</span></label>
				<div class="">
				<input type="range" class="custom-range" min="0" max="5" id="customRange2">
					<?php 
					for($i = 1 ; $i<=5 ; $i++){
						?>
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = $this->input->post('ui_color_scheme') === $i;
								echo form_radio(array('name' => 'ui_color_scheme','value' => $i,'id' => 'ui_color_scheme_'.$i,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('ui_color_scheme', $i));
							?>
							<label class="custom-control-label" for="ui_color_scheme_<?php echo $i;?>"><?php echo $i;?></span></label>
						</div>
						<?php
					}
					?>
				</div>
				<?php echo form_error('name'); ?>
			</div>
        </div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="nav_link_findout">Navigation links (menu links how easy to find out) <span class="required">*</span></label>
				<div class="">
					<?php 
					for($i = 1 ; $i<=5 ; $i++){
						?>
						<div class="custom-control custom-radio custom-control-inline">
							<?php
								$radio_is_checked = $this->input->post('nav_link_findout') === $i;
								echo form_radio(array('name' => 'nav_link_findout','value' => $i,'id' => 'nav_link_findout_'.$i,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('nav_link_findout', $i));
							?>
							<label class="custom-control-label" for="nav_link_findout_<?php echo $i;?>"><?php echo $i;?></span></label>
						</div>
						<?php
					}
					?>
				</div>
				<?php echo form_error('name'); ?>
			</div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12"> 
                <label for="message" class="">Message <span class="required">*</span></label>
                <?php
                echo form_textarea(array(
                    'name' => 'message',
                    'value' => set_value('message'),
                    'id' => 'message',
                    'class' => 'form-control',
                    'rows' => '2',
                    'cols' => '2',
                    'placeholder' => 'Leave your message...',
                    'maxlength' => '200',
                ));
                ?>
                <?php echo form_error('message'); ?>
            </div>
        </div>
        
		<?php
		echo form_submit(array(
			'name' => 'submit',
			'value' => 'Submit',
			'class' => 'btn btn-primary',
		));
		?>
	<?php echo form_close(); ?>
	</div>
</div>