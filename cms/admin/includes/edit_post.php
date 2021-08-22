<?php
if(isset($_GET['edit'])){
        
    $edit_post_id = escape($_GET['edit']);
    
    
    $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id}";
    $update_posts_data =mysqli_query($connection,$query);

    while ($row=mysqli_fetch_assoc($update_posts_data)){
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_status = $row['post_status'];
    } 
}
?>

<?php 
if (isset($_POST['update_post'])){

    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_author = escape($_POST['post_author']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp,"../images/$post_image");
    if(empty($post_image)){

        $query = "SELECT * FROM posts WHERE post_id = {$edit_post_id} ";
        $old_image = mysqli_query($connection,$query);

        while ($row = mysqli_fetch_assoc($old_image)) {
            $post_image = $row['post_image'];
        }
    }

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    $post_comment_count = 1 ;

    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = {$post_category_id}, post_author = '{$post_author}',
    post_status = '{$post_status}', post_image ='$post_image', post_content = '{$post_content}', post_date = now(),
    post_tags = '{$post_tags}' WHERE post_id = {$edit_post_id}";


    $update_posts = mysqli_query($connection,$query);
    checkQuery($update_posts);
    
    if (isset($_POST['reset'])){
    
        $reset_id = escape($_POST['reset']);
        
        $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = $reset_id";
        $reset_views = mysqli_query($connection,$query);
        checkQuery($reset_views);

    }


    header("Location: /demo/cms/admin/posts");
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" value="<?php echo $post_title; ?>" class="form-control">
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
        <input type="text" name="post_author" value="<?php //echo $post_author; ?>" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author" class="form-control">
        <?php if(isadmin()){ ?>  
        <?php
            $query = "SELECT * FROM users";
            $all_users =mysqli_query($connection, $query);
            
            while ($row=mysqli_fetch_array($all_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                if($post_author == $username){
                    echo"<option selected value='{$post_author}'>{$post_author}</option>";
                }else{
                echo"<option value='{$username}'>{$username}</option>";    
                }
            }
        }else{ 
                $username = $_SESSION['username'];
                
                echo"<option selected value='{$username}'>{$username}</option>";
                
                
        }?>  
        </select>
    </div>
  
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" class="form-control">
        <?php 
        switch ($post_status) {
            case 'published':
                echo "
                <option value='published'>Published</option>
                <option value='draft'>Draft</option>
                <option value='denied'>Denied</option>";
                break;
            
            case 'denied':
                echo "
                <option value='denied'>Denied</option>
                <option value='draft'>Draft</option>
                <option value='published'>Published</option>";
                    break;    
            
            default:
                echo "
                <option value='draft'>Draft</option>
                <option value='published'>Published</option>
                <option value='denied'>Denied</option>";
                break;
        }
         ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width="100" src="../images/<?php  echo $post_image; ?>" alt="<?php echo $post_image; ?>">
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="editor" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="checkbox" name="reset" value="<?php echo $edit_post_id; ?>" id="reset">
        <label for="reset"> Reset Views Counter  </label>   
    </div>

    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update">  
    <button class="btn btn-outline-primary" onclick="location.href='/demo/cms/admin/posts';" type="button">Cancel</button>
    </div>

</form>

