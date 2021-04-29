<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-8">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
    <?php echo form_open_multipart(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => '','id' => '',));?>
    <?php echo form_hidden('form_action', 'send'); ?>
        <div class="form-row">
			<div class="form-group col-md-12">
				<label for="ui_color_scheme" class="required">User Interface (color of theme, buttons, links)</label>
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
				<label for="nav_link_findout" class="required">Navigation links (menu links how easy to find out)</label>
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
                <label for="message" class="required">Message</label>
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
			'name' => 'submit', 'data-button-type' => 'submit',
			'value' => 'Submit',
			'class' => 'btn  btn-primary',
		));
		?>
	<?php echo form_close(); ?>
	</div>
</div>