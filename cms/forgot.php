
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';





if(!checkMethod('get') && !isset($_GET['token'])){

    redirect('index');
}

if(checkMethod('post')){

    if(isset($_POST['email'])){
        $email = escape($_POST['email']);
        
        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));
        
        if(email_exists($email)){

            if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")){

                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

               
                    //Server settings
                                    
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = Config::SMTP_USER;                     //SMTP username
                    $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = Config::SMTP_PORT;
                    $mail->CharSet    = 'UTF-8';                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('mohamadreza.ghasemi1383@gmail.com', 'Mailer');
                    $mail->addAddress($email);     //Add a recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Reset Your Password';
                    $mail->Body    = '<p>Click on the link below to reset your password:
                    
                    <a href="http://localhost/demo/cms/reset.php?email=' . $email . '&token='. $token .'" class="btn btn-warning">Click HERE</a>
                   
                    </p>';
                    $mail->AltBody = 'Copy This link in your browser to reset your password:
                    http://localhost/demo/cms/reset.php?email=' . $email . '&token='. $token .'
                    ';

                   if($mail->send()){
                    $sent = true;
                    }

            }else{

                echo mysqli_stmt_error($stmt)."  ".mysqli_stmt_errno($stmt);
            }

        }else{  
            $emailnotexist = true;

            

        }
    }


}
?>


<!-- Page Content -->
<div class="container">
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button onclick="location.href='/demo/cms/'" class="btn btn-sm"><i class="glyphicon glyphicon-home"></i></button>
                        <button onclick="location.href='/demo/cms/login'" class="btn btn-sm pull-right"><i class="glyphicon glyphicon-log-in"></i></button>
                        <div class="text-center">
                      
                            <?php if(!isset($sent)): ?> 
                                
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>
                                        <?php if(isset($emailnotexist)){ echo "<h4 class='text-danger'>Your Email dosen't exist</h4>"; } ?>
                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                        <h4 class="text-danger"></h4>
                                    </form>


                                </div><!-- Body-->

                            <?php else: ?>
                            <h4 class="text-success"><?php echo "Reset link has been sent. please check your email" ?></h4>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

