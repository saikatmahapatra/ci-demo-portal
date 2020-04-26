<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<p><i class="fas fa-fw fa-exclamation-triangle fa-3x text-danger" aria-hidden="true"></i></p>
<p class="">Sorry! You are not authorized to access the requested page.</p>
<a href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>" class="btn btn-outline-primary">Please login to continue...</a>