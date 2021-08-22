<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="">Users Online: <span class="usersOnline"></span></a></li>
                <li><a href="/demo/cms/index"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                     <?php
                    
                    if(isset($_SESSION['username'])){
                    
                    echo $_SESSION['firstname']; echo " " . $_SESSION['lastname'];
                    
                }
                    
                    ?>
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/demo/cms/admin/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/demo/cms/includes/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
<?php  
                $pagename = basename($_SERVER['PHP_SELF']);

                $dashboard_class = " ";
                $posts_class = " ";
                $categories_class = " ";
                $comments_class = " ";
                $users_class = "";
                    $collapse_class= "collapse";
                $profile_class = " ";
                
                switch ($pagename) {
                    case 'posts.php':
                        $posts_class = "active";
                        break;

                    case 'categories.php':
                        $categories_class = "active";
                        break;
                    
                    case 'comments.php':
                        $comments_class = "active";
                        break;

                    case 'users.php':
                        $users_class = "active";
                        $collapse_class = "collapse in";
                        break;
  
                    case 'profile.php':
                        $profile_class = "active";
                        break;

                    default:
                        $dashboard_class = "active";
                        break;
                }
                
?>
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php echo $dashboard_class ?>">
                        <a href="/demo/cms/admin/index"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo $posts_class ?>">
                        <a href="/demo/cms/admin/posts"><i class="fa fa-fw fa-file-text"></i> Posts</a>
                    </li>
                    <!--
                        <---dropdown menu---.>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-clipboard"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php">View Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Posts</a>
                            </li>
                        </ul>
                    </li>-->
                <?php if(isadmin()){ ?>
                   
                    <li class="<?php echo $categories_class ?>">
                        <a href="/demo/cms/admin/categories"><i class="fa fa-fw fa-list"></i> Categories</a>
                    </li>
                <?php  } ?>
                    <li class="<?php echo $comments_class ?>">
                        <a href="/demo/cms/admin/comments"><i class="fa fa-fw fa-comments"></i> Comments</a>
                    </li>
                <?php if(isadmin()){ ?>                    
                    <li class="<?php echo $users_class ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="<?php echo $collapse_class ?>">
                            <li>
                                <a href="/demo/cms/admin/users">View Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
                <?php  } ?>
                    <li class="<?php echo $profile_class ?>">
                        <a href="/demo/cms/admin/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
</nav>