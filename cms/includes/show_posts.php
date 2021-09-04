        <h2>
            <a href="/demo/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
        </h2>
        <p class="lead">
            by <a href="author_post/<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?>
        <span class="pull-right"><i class="glyphicon glyphicon-eye-open"></i>  <?php echo $post_view_count ?>
        <?php 
        if(isset($_SESSION['role'])){
            if(isset($_GET['p_id'])){
       ?>
        <a class="btn btn-default" href="/demo/cms/admin/posts/edit_post/<?php echo $post_id; ?>">Edit Post</a>
        <?php } }?>
        </span></p>
        <hr>
        <a href="/demo/cms/post/<?php echo $post_id; ?>">
        <img class="img-responsive" src="/demo/cms/images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
        </a>
        <hr>
        <p><?php echo $post_content; ?></p>
        <?php 
        if(!isset($_GET['p_id'])){ 
         ?>
        <a class="btn btn-primary" href="/demo/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        <?php 
        }
         ?>
        <hr> 