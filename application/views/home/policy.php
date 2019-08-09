<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
    <div class="col-md-8">
        <?php if(isset($data_rows) && sizeof($data_rows> 0)){ ?>
            <div class="accordion" id="accordion">
                <?php foreach($data_rows as $key=>$row) { ?>
                    <div class="card">
                        <div class="card-header collapsed"  data-toggle="collapse" data-target="#collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" aria-expanded="false" aria-controls="collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" id="heading_<?php echo isset($row['id']) ? $row['id'] : '';?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></div>

                        <div id="collapse_<?php echo isset($row['id']) ? $row['id'] : '';?>" class="collapse" aria-labelledby="heading_<?php echo isset($row['id']) ? $row['id'] : '';?>" data-parent="#accordion">
                            <div class="card-body">
                            <div class="text-muted small mb-1">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php //echo isset($row['user_firstname']) ? "By ".$row['user_firstname'] : '';?>
                                <?php //echo isset($row['user_lastname']) ? $row['user_lastname'].", " : '';?>
                                <?php echo $this->common_lib->display_date($row['pagecontent_created_on'],true,null,'d-M-Y h:i:s a'); ?>
                            </div>
                                <div>
                                    <?php echo isset($row['pagecontent_text']) ? $row['pagecontent_text'] : '';?>
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
</div>