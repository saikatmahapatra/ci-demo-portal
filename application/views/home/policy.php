<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-body">
                <?php if(isset($data_rows) && sizeof($data_rows> 0)){ ?>
                <?php foreach($data_rows as $key=>$row) { ?>
                    <h5 class="card-title"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></h5>
                    <div class="small text-muted">Published on <?php echo $this->common_lib->display_date($row['content_created_on'],true,null,'d-M-Y h:i:s a'); ?></div>
                    <div class="mt-3">
                        <?php echo isset($row['content_text']) ? trim($row['content_text']) : '';?>
                    </div>
                    <hr>
                <?php }  ?>
            <div class="mt-2">
                <?php echo $pagination_link;?>
            </div>
        <?php } else{
            ?>
            <p>No information available.</p>
            <?php
        } ?>
            </div>
        </div><!--/.card-->
    </div>
</div>