

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/demo/CMS/index">Home Page</a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                    <?php show_categories();?>
                    <li class="<?php echo $contact_class ?>"><a href="/demo/cms/contact">Contact Us</a></li>
                </ul>
                <ul class="nav navbar-right navbar-nav top-nav">
                    <?php if(isLoggedIn()){ ?> 
                        <li class="btn-group"><a href="/demo/CMS/admin" class="m-t-10 waves-effect waves-dark btn btn-md btn-rounded" data-abc="true">Dashboard</a>
                        <a href="/demo/CMS/includes/logout" class="m-t-10 waves-effect waves-dark btn btn-md btn-rounded" aria-disabled="true">Logout</a></li>
                   <?php }else{ ?>
                    <li class="btn-group"><a href="/demo/CMS/registration" class="m-t-10 waves-effect waves-dark btn btn-md btn-rounded" data-abc="true">Register</a>
                    <a href="/demo/CMS/login" class="m-t-10 waves-effect waves-dark btn btn-md btn-rounded" aria-disabled="true">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
           
           
            <!-- /.navbar-collapse -->
        </div>
        
        <!-- /.container -->
    </nav>
