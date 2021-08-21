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
                    <small>All Posts By
                        <?php 
                        if(isset($_GET['author'])){
                            $author = $_GET['author'];
                        }
                        echo $author;
                         ?>
                    </small>
                </h1>
                        <!-- First Blog Post -->
                        
                    <?php author_posts(); ?>

               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>         