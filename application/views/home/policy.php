<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
    <div class="col-md-6">
        <div class="card news-card">
            <div class="card-header h6">
            <i class="fa fa-cog fa-lg" aria-hidden="true"></i> Policies
            </div>
            <div class="card-body">
                <?php if(isset($data_rows) && sizeof($data_rows> 0)){ ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach($data_rows as $key=>$row) { ?>
                        <li class="list-group-item">
                        <a class="" href="<?php echo base_url($this->router->directory.$this->router->class.'/details/'.$row['id'].'/redirect/policy');?>"><?php echo isset($row['pagecontent_title']) ? $row['pagecontent_title'] : '';?></a>
                        </li>
                    <?php }  ?>
                    </ul>
                <?php } ?>
                <?php echo $pagination_link;?>
            </div>
            <!-- <div class="card-footer text-center">
                <?php echo $pagination_link;?>
            </div> -->
        </div><!--/.card-->
    </div>
</div>