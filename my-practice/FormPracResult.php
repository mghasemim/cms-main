<?php


if (isset($_POST ['submit'] )){
    $names = ["mammad", "reza", "ahmad", "parsa"];
    $user = $_POST ['user'];
    $pass = $_POST ['pass'];
    
    
    
    
    if (in_array ($user,$names)){
        
     echo "u may enter";   
        
        
        
    }else {
        
        echo "u shall not pass";
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


?>