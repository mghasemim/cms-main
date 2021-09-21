<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php
    if(!isset($_GET['email']) || !isset($_GET['token'])){


        redirect('index');


    }

    $token = $_GET['token'];
    $email = $_GET['email'];

    if($stmt = mysqli_prepare($connection, "SELECT user_password, user_email, token FROM users WHERE token = ?")){
        
        mysqli_stmt_bind_param($stmt,"s",$token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $db_password, $user_email, $token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        

        if($email == $user_email){
            if(checkMethod('post')){
                if(empty($_POST['password']) || empty($_POST['confirmPassword'])){
                    echo "fields cannot be empty";
                }else{
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmPassword'];

                    if($password === $confirmPassword){
                        
                        
                        if(password_verify($password, $db_password)){
                            echo "your new password must be different";
                        }else{
                            $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

                            if($stmt = mysqli_prepare($connection,"UPDATE users SET token='', user_password = ? WHERE user_email = ?")){
                                mysqli_stmt_bind_param($stmt,"ss", $password,  $user_email);
                                mysqli_stmt_execute($stmt);
                                echo "ok2";
                                if(mysqli_stmt_affected_rows($stmt) >= 1){
                                    echo "ok3";
                                    redirect('/demo/cms/login.php');
                                }
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }else{
                        echo "they dont match dum dum";
                    }
                

                }
            }
        }else{
            echo "wrong token";
        }

    }







?>






<div class="container">



    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">


                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<hr>

<?php include "includes/footer.php";?>

</div> <!-- /.container -->



