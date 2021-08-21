<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
<?php 
if(isset($_POST['submit'])){

    $to = "mohamadreza.ghasemi1383@gmail.com";
    $email = "From: ". $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $message = wordwrap($message,70);

    mail($to, $subject, $message, $email);
    
}

?>    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       
                        <div class="form-group">
                           <label for="email" class="sr-only">Email</label>
                           <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter a Subject">
                        </div>
                         <div class="form-group">
                            <label for="message" class="sr-only">Your Message</label>
                           <textarea name="message" class="form-control" id="message" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
