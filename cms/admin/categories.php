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
                            Welcome to Admin Area 
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <!-- Add Category Form -->
                        <div class="col-xs-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add a Category</label>
                                <input type="text" class="form-control" name="cat_title" placeholder="Category Name">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                            </div>
                        </form>
                        <?php add_category();?>
                            <!--Update Category-->   
                            
                            <?php
                                
                                update_category();     
                             ?>         
                        </div> 

                        
                        <!-- Categories Table -->
                        <div class="col-xs-6">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>                                 
                                </thead>
                                <tbody>
                                    <?php show_categories();?>

                                    <?php delete_category();?>
                                </tbody>
                            </table>   
                        </div>   

                        </form>
                        

                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>
