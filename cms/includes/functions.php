<?php


function checkQuery($result){
    global $connection;

    if(!$result){
                
        die("query failed" . mysqli_error($connection) . "  " . mysqli_errno($connection));
        
    }   
}

function show_posts(){
    global $connection;
    global $counter;
    global $page;
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = "";
    }
    if($page == "" || $page == 1){
        $page_1 = 0;
    }else{
        $page_1 = ($page * 5) - 5;
    }

    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        
        $query = "SELECT * FROM posts WHERE post_status != 'denied'";
        
    }else{  
            
        $query = "SELECT * FROM posts WHERE post_status = 'published'";
       
    }     

    
    $count_posts = mysqli_query($connection, $query);
    $counter = mysqli_num_rows($count_posts);
    $counter = ceil($counter / 5);

    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        
        $query = "SELECT * FROM posts WHERE post_status != 'denied' LIMIT $page_1, 5";
        
    }else{  
            
        $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, 5";
       
    }     

    $posts_data = mysqli_query($connection,$query);

    $count = mysqli_num_rows($posts_data);
        if ($count == 0){
            echo "<h2>NO POST</h2>";
            
        }else{

            while ($row = mysqli_fetch_assoc($posts_data)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200);
                $post_view_count = $row['post_view_count'];
                include "includes/show_posts.php";
            }    
        }
}

function show_posts_category(){
    global $connection;
    
    if(isset($_GET['category'])){
        $post_category_id = mysqli_real_escape_string($connection, $_GET['category']);

        if(isadmin()){
        
            $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_view_count 
            FROM posts WHERE post_category_id = ? AND post_status != ?");
            $denied = "denied";
            checkQuery($stmt1);
        }else{  
                
            $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_view_count 
            FROM posts WHERE post_category_id = ? AND post_status = ?");
            $published = "published";
            checkQuery($stmt2);
            
        }      
        
        if(isset($stmt1)){
            mysqli_stmt_bind_param($stmt1,"is",$post_category_id,$denied);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content,$post_view_count);
            $post_content = substr($post_content,0,200);
            $stmt = $stmt1;
        }else{

            mysqli_stmt_bind_param($stmt2,"is",$post_category_id,$published);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2,$post_id,$post_title,$post_author,$post_date,$post_image,$post_content,$post_view_count);
            $post_content = substr($post_content,0,200);
            $stmt = $stmt2;
        }
     
      
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) === 0){
            echo "<h2>NO POST</h2>";
            
        }else{

            while (mysqli_stmt_fetch($stmt)){
                include "includes/show_posts.php";
                
            }
        }
        mysqli_stmt_close($stmt);        
    }  
}


function search_posts(){
    global $connection;

    if (isset($_POST['submit'])){

        $search= mysqli_real_escape_string($connection, $_POST['search']);
        
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status != 'denied'";
            
        }else{  
                
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
            
        }      
        
        $posts_search = mysqli_query($connection,$query);
        checkQuery($posts_search);

        $count = mysqli_num_rows($posts_search);
        if ($count == 0){
            echo "<h2>NO RESULT</h2>";
            
        }else{

            while ($row = mysqli_fetch_assoc($posts_search)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200);
                $post_view_count = $row['post_view_count'];
                include "includes/show_posts.php";
            }    
        }
    }
}

function author_posts(){
    global $connection;
    global $author;
    
    $author = mysqli_real_escape_string($connection, $author);

    
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        
        $query = "SELECT * FROM posts WHERE post_author = '{$author}' AND post_status != 'denied'";
        
    }else{  
            
        $query = "SELECT * FROM posts WHERE post_author = '{$author}' AND post_status = 'published'";
        
    }      
    
    $posts_data = mysqli_query($connection,$query);
    $count = mysqli_num_rows($posts_data);
    if ($count == 0){
        echo "<h2>NO RESULT</h2>";
        
    }else{
    while ($row = mysqli_fetch_assoc($posts_data)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,200);
        $post_view_count = $row['post_view_count'];
        include "includes/show_posts.php";
    }   
    }
}

function show_post(){
    global $connection;
    global $p_id;
    
    if(isset($_GET)){
        $p_id= mysqli_real_escape_string($connection, $_GET['p_id']);

        $query = "SELECT * FROM posts WHERE post_id = {$p_id}";
        $posts_data = mysqli_query($connection,$query);


        while ($row = mysqli_fetch_assoc($posts_data)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_view_count = $row['post_view_count'];

            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && $post_status != 'denied'){
                
            
                $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $p_id";
                $view_counter = mysqli_query($connection,$query);
                checkQuery($view_counter);
                include "includes/show_posts.php";

            }elseif($post_status == 'published'){
                    
                $query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $p_id";
                $view_counter = mysqli_query($connection,$query);
                checkQuery($view_counter);
                include "includes/show_posts.php";                
                
            }else{
                header("Location: index.php");
            }  
            
        }
    }
}

function show_categories(){
    global $connection;
    global $contact_class;

    $query = "SELECT * FROM categories";
    $cat_select_all = mysqli_query($connection,$query);

    while ($row = mysqli_fetch_assoc($cat_select_all)){
        $cat_title = $row ['cat_title'];
        $cat_id = $row['cat_id'];

        $cat_class=" ";
        $contact_class=" ";
        $pagename = basename($_SERVER['PHP_SELF']);

        if(isset($_GET['category']) && $_GET['category'] == $cat_id){

            $cat_class = "active";
        }elseif($pagename == "contact.php"){

            $contact_class = "active";
        }

        echo "<li class='{$cat_class}'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
        }
        

           
} 

function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '{$username}'";
    $result = mysqli_query($connection, $query);
    checkQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }

    

}

function email_exists($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '{$email}'";
    $result = mysqli_query($connection, $query);
    checkQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }

    

}

function register_user($username, $email, $password){
    global $connection;
    global $message;

        $username = escape($username);
        $email = escape($email);
        $password = escape($password);

        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $query = "INSERT INTO users (username, user_email, user_password, user_role) 
        VALUES ('$username', '$email', '$password', 'newbie')";
        $register = mysqli_query($connection,$query);
        checkQuery($register);

        $message = "<h6 class='text-center bg-success'>Welcome To Our Family   <a href='index.php'>Log In</a></h6>";
}

function escape($string){
    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function isadmin(){
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}










































?>