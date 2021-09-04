<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="/demo/CMS/search" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
        <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button> 
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>
<div class="well">
<?php if(isset($_SESSION['role'])){ 
        if(isset($_SESSION['id'])){
                
            $profile_id = $_SESSION['id'];

            $query = "SELECT * FROM users WHERE user_id = {$profile_id}";
            $profile_data =mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($profile_data)){
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
        } ?>

<!--profile -->
       
<div class="card"> 
    <div class="card-body little-profile text-center">
        <div class="pro-img"><img class="img-rounded" width="100" src="images/<?php echo $user_image; ?>" alt="user"></div>
        <h3 class="m-b-0"><?php  echo $user_firstname; ?>  <?php  echo $user_lastname; ?></h3>
        <p class="text-muted"><?php  echo $username; ?></p>
        <p class="text-info"><?php  echo $user_role; ?></p>
        <div class="btn-group">
            <a href="/demo/CMS/admin" class="m-t-10 waves-effect waves-dark btn btn-success btn-md btn-rounded" data-abc="true">Dashboard</a>
            <a href="/demo/CMS/includes/logout" class="m-t-10 waves-effect waves-dark btn btn-warning btn-md btn-rounded" aria-disabled="true">Logout</a>
        </div>
    </div>    
</div>

<?php }else{ ?>
<!-- Login -->

<?php 

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    login_user($username,$password);
}

?>

<h4>Login</h4>
    <form action="" method="post">
    <div class="form-group">
        <input name="username" type="text" class="form-control" placeholder="Enter Username">
    </div>
    <div class="input-group">
        <input name="password" type="password" class="form-control" placeholder="Enter Password">
        <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit">Log In
            </button>
        </span>
    </div>
    <div class="form-group">
        <a href="/demo/CMS/registration.php" class="btn pull-left">Sign Up</a>
        <a href="forgot.php?token=<?php echo uniqid(true); ?>" class="btn pull-right">Forgot Password</a>
    </div>
    </form>

    <!-- /.input-group -->

<?php }?>

</div>

<!-- Blog Categories Well -->
<div class="well">

    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
    <?php show_categories();?>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include "widget.php";?>

</div>