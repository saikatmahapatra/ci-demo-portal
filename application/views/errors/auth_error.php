<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<p><i class="icon fa fa-warning fa-3x text-danger" aria-hidden="true"></i></p>
<p class="">Sorry! You are not authorized to access the requested page.</p>
<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-outline-primary">Please login to continue...</a>