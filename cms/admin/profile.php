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
                    <?php

                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = "";
                    }
                    
                    switch ($source) {
                        
                        case 'edit_profile':
                            include "includes/edit_profile.php";
                            break;
                        
                        default:
                            include "includes/view_profile.php";
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
