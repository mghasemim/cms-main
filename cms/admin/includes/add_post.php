<?php 
if (isset($_POST['create_post'])){

    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_author = escape($_POST['post_author']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp,"../images/$post_image");

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');


    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, 
    post_image, post_content, post_tags, post_status)
    VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(),
     '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";


    $add_posts = mysqli_query($connection,$query);
    
    checkQuery($add_posts);
    
    header("Location: posts.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <select name="post_category_id" class="form-control">
        <?php
            $query = "SELECT * FROM categories";
            $all_cat =mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($all_cat)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo"<option value='{$cat_id}'>{$cat_title}</option>";    
            }    
        ?>  
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="post_author">Post Author</label>

    
        <select name="post_author" class="form-control">
        <?php if(isadmin()){ ?>
            <option value='Unknown'>--Select an user for Author--</option>
        <?php
            $query = "SELECT * FROM users";
            $all_users =mysqli_query($connection,$query);

            while ($row=mysqli_fetch_assoc($all_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo"<option value='{$username}'>{$username}</option>";    
            }    
        ?>  
        <?php }else{ 
            $username = $_SESSION['username'];

            echo"<option selected value='{$username}'>{$username}</option>";
            
            
            } ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="denied">Denied</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10">
        </textarea>
    </div>

    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish">  
    <button class="btn btn-outline-primary" onclick="location.href='posts.php';" type="button">Cancel</button>
    </div>

</form>