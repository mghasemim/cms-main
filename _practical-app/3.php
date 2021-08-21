<?php include "functions.php"; ?>
<?php include "includes/header.php";?>

	<section class="content">

	<aside class="col-xs-4">

	<?php Navigation();?>
			
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<?php  

if (1==2){echo 'hi';} elseif (2===2.0){echo 'another hi';} else {echo 'i love PHP'.'<br>';}
    
    
for ($var = 1 ; $var <= 10 ; $var++ ){
    
    echo $var . "<br>";
    
    
    
    
    
}
$num = 25;    
switch ($num){
        
    case 35 :
        echo "it's 35";
        break;
    case 30 :
        echo "it's 30";
        break;
    case 25 :
        echo "it's 25";
        break;
     case 45 :
        echo "it's 45";
        break;
     case 40 :
        echo "it's 40"; 
        break;
        
        
        
        
}
    
    
   
    
    
    
    
    
    
    
    
/*  Step1: Make an if Statement with elseif and else to finally display string saying, I love PHP



	Step 2: Make a forloop  that displays 10 numbers


	Step 3 : Make a switch Statement that test againts one condition with 5 cases

 */

	
?>






</article><!--MAIN CONTENT-->
	
<?php include "includes/footer.php"; ?>