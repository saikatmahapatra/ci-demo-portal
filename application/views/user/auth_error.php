<div class="row heading-container">
    <div class="col-12">
    <h1 class="page-heading"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<p><i class="icon fa fa-warning fa-3x text-danger" aria-hidden="true"></i></p>
<p class="">Sorry! You are not authorized to access the requested page.</p>
<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Please login to continue...</a>