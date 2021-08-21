<?php include "Functions.php" ; ?>
<?php Connection();  ?>
<?php QuerryAll();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Row</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="home-button">
        
        <a href="/demo/my-practice/my site/Index.php"><button class="btn btn-dark">Home Page</button></a>
        
        </div>
        <br>
        <hr>
        <br>
        <div class="col-sm-6">
            <form action="DeleteData.php" method="post">
                
                <div class="form-group">
                    <select name="id" id="">
                    <?php  
                           FetchID();

                        ?>
                
                    </select>
                </div>
                <div class="form-group">    
                    <input type="submit" name="submit" value="پاک کردن" class="btn btn-primary">
                </div>
            
            
            
            
            
            </form>





        </div>
    </div>











    
</body>
</html>