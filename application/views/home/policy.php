<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-12">
        <div class="card ci-card">
            <div class="card-header"><?php echo isset($row['content_type']) ? ucwords($row['content_type']) : '';?></div>
            <div class="card-body">
                <?php if(isset($data_rows) && sizeof($data_rows> 0)){ ?>
                <?php foreach($data_rows as $key=>$row) { ?>
                    <h6 class="card-title mb-0"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></h6>
                    <div class="text-muted small mb-3">Published on <?php echo $this->common_lib->display_date($row['content_created_on'],true,null); ?></div>
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