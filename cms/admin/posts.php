<?php include "includes/admin_header.php";?>
    <div id="wrapper">

        <!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Posts
                            <small><?php 
                            
                            if(isset($_GET['author'])){
                               $author = $_GET['author'];

                                echo "Every post by " . $author;

                            }elseif(isset($_GET['category'])){
                                $cat = $_GET['category'];
                                $query = "SELECT * FROM categories WHERE cat_id = {$cat}";
                                $find_category = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($find_category);
                                $category = $row['cat_title'];
                                
                                echo "Every post related to " . $category;
                            }else{
                                echo "All Posts";
                            }
                            
                            
                            ?></small>
                        </h1>
                    <?php

                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = "";
                    }
                    
                    switch ($source) {
                        case 'add_post':
                            include "includes/add_post.php";
                            break;

                        case 'edit_post':
                            include "includes/edit_post.php";
                            break;
                        
                        default:
                            include "includes/view_posts.php";
                            break;
                        
                        
                    }
                    ?>
                        
                        
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
