<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-md-12">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
        <ul>
			<li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/bootstrap');?>" class="">Bootstrap </a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/form_helper');?>" class="">Form Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/dom_pdf_gen_pdf');?>" class="">DOM PDF Generate</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/date_helper');?>" class="">Date Helper</a></li>
            <li><a href="<?php echo base_url($this->router->directory.$this->router->class.'/directory_helper');?>" class="">Directory Helper</a></li>
            
        </ul>   
    </div>

</div>