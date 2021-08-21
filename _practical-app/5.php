<?php include "functions.php"; ?>
<?php include "includes/header.php";?>
	<section class="content">

		<aside class="col-xs-4">
		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

	
	<?php 


//  Step1: Use a pre-built math function here and echo it
    
echo sqrt(25) . "<br>";

//	Step 2:  Use a pre-built string function here and echo it
$str = "Salam Khoobi Shoma?" . "<br>";

echo strtolower ($str);    
//	Step 3:  Use a pre-built Array function here and echo it
$array = [255,569,2,21,48,548,99,10,6];

print_r ($array);
echo "<br>";    
sort($array);
print_r ($array);

	
?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php"; ?>