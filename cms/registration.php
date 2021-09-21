<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
<?php

$error = [
    'username' => '',
    'email' => '',
    'password' => ''
];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(strlen($username) < 5){
        $error['username'] = '<h5 class="bg-danger">*Username need to be at least 5 characters</h5>';
    }
    elseif(username_exists($username)){
        $error['username'] = '<h5 class="bg-danger">*This username already exists</h5>';
    }
    
    if($email == ''){
        $error['email'] = '<h5 class="bg-danger">*This field Cannot be empty</h5>'; 
    }elseif (email_exists($email)){
        $error['email'] = '<h5 class="bg-danger">*This email already exists</h5>';
    }

    if(strlen($password) < 7){
        $error['password'] = '<h5 class="bg-danger">*Password need to be at least 7 characters</h5>';
    }

    foreach ($error as $key => $value) {
        if(empty($value)){

            unset($error[$key]);   

        }
    }

    if(empty($error)){
        register_user($username, $email, $password);
        redirect("login.php");
    }else{
        $message = ""; 
    }

}else{
    $message = "";
}

?>    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <?php  echo $message; ?>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"
                            autocomplete="on" value="<?php echo isset($username) ? $username : ''  ?>">
                            <?php echo isset($error['username']) ? $error['username'] : ''?>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                            autocomplete="on" value="<?php echo isset($email) ? $email : ''  ?>">
                            <?php echo isset($error['email']) ? $error['email'] : ''?>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            <?php echo isset($error['password']) ? $error['password'] : ''?>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
