<?php 
include  "Functions.php";

Connection();
QuerryAll();

if (isset($_POST ['submit'] )){


    UpdateTable();
    
   
        }
?>

<?php include "HomeButton.html"; ?>