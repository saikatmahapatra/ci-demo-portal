<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<p><i class="icon fa fa-warning fa-3x text-danger" aria-hidden="true"></i></p>
<p class="">Sorry! The requested page could not found.</p>
<a href="<?php echo base_url();?>" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i> Take me home</a>