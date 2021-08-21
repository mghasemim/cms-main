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
               
                <?php show_posts();?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
        <?php       
        for($i=1; $i<=$counter; $i++){

            if($i == $page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
        </ul>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>         