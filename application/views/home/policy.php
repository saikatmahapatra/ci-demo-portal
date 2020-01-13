<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h5>
                <?php if(isset($data_rows) && sizeof($data_rows> 0)){ ?>
            <div class="accordion" id="accordion">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <div class="card my-2" style="border: none;">
                        <div class="card-header border collapsed"  data-toggle="collapse" data-target="#collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" aria-expanded="false" aria-controls="collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" id="heading_<?php echo isset($row['id']) ? $row['id'] : '';?>"><?php echo isset($row['content_title']) ? $row['content_title'] : '';?></div>

                        <div id="collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" class="collapse" aria-labelledby="heading_<?php echo isset($row['id']) ? $row['id'] : '';?>" data-parent="#accordion">
                            <div class="card-body" style="border: 1px solid rgba(0, 0, 0, 0.125); border-top: none;">
                            <div class="text-muted small mb-1">
                                <?php echo "Published on"; //isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
                                <?php //echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
                                <?php echo $this->common_lib->display_date($row['content_created_on'],true,null,'d-M-Y h:i:s a'); ?>
                            </div>
                                <div>
                                    <?php echo isset($row['content_text']) ? trim($row['content_text']) : '';?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            </div>
            <div class="mt-2">
                <?php echo $pagination_link;?>
            </div>
        <?php } else{
            ?>
            <p>Opps ! No contents available currently.</p>
            <?php
        } ?>
            </div>
        </div><!--/.card-->
    </div>
</div>