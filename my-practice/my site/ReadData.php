<?php 

    include "Functions.php" ;  
    Connection();
    QuerryAll();    

?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>

    <div class="container">
        <div class="home-button">
            
                <a href="/demo/my-practice/my site/Index.php"><button class="btn btn-dark">Home Page</button></a>
            
        </div>
        <div class="col-sm-6">


        <?php       while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <pre>
        <?php
        print_r($row);
        ?>
        
        
        </pre>
<?php
}
?>




            
        </div>
    </div>
</body>
</html>