<?php include "includes/header.php"; ?>

    <!-- Navigation -->
 <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
               
                <!-- Blog Post -->
               
            <?php
             show_post()   
            ?>
            <!-- Blog Comments -->
            <?php
            if (isset($_POST['add_comment'])){
                $p_id= $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)
                VALUES ({$p_id}, '{$comment_author}', '{$comment_email}', '{$comment_content}}', 'unapproved', now())";
                $add_comment= mysqli_query($connection,$query);
                checkQuery($add_comment);
                
                // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 
                // WHERE post_id = $p_id";
                // $add_comment_counter = mysqli_query($connection,$query);
                // checkQuery($add_comment_counter);
                
                }else{
                    echo "<script>alert('these fields cannot be empty')</script>";

                }
            }
            
            
            
            
            
            
            ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea class="form-control"  rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                
                $query="SELECT * FROM comments WHERE comment_post_id = {$p_id} 
                AND comment_status = 'approved' ORDER BY comment_id DESC";
                $show_comments= mysqli_query($connection,$query);
                
                checkQuery($show_comments);

                $count = mysqli_num_rows($show_comments);
                if ($count == 0){
                    echo "<h3>Leave The First Comment</h3>";}

                while($row=mysqli_fetch_assoc($show_comments)){
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                ?>    
                
                
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
 
                <?php } ?>
                
        
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>         