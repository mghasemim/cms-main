<?php 
include  "Functions.php";

Connection();
QuerryAll();

if (isset($_POST ['submit'] )){


    DeleteRow();
    
   
        }
?>

<?php include "HomeButton.html"; ?>