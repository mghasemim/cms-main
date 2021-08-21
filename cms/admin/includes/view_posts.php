<?php 
include "includes/delete_modal.php";
if(isset($_POST['checkBoxArray'])){

    foreach ($_POST['checkBoxArray'] as $select_post_id) {
        $bulk_option = $_POST['bulk_option'];
        $select_post_id = escape($select_post_id);    
        switch ($bulk_option) {
            case 'publish':

                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$select_post_id}";
                $publish_post = mysqli_query($connection,$query);
        
                checkQuery($publish_post);
                
                break;

            case 'draft':

                    $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$select_post_id}";
                    $draft_post = mysqli_query($connection,$query);
            
                    checkQuery($draft_post);
                       
                    break;

            case 'deny':

                $query = "UPDATE posts SET post_status = 'denied' WHERE post_id = {$select_post_id}";
                $deny_post = mysqli_query($connection,$query);
        
                checkQuery($deny_post);
                   
                break;
            case 'delete':
                

                $query = "DELETE FROM posts WHERE post_id = {$select_post_id}";
                $delete_post = mysqli_query($connection,$query);
                checkQuery($delete_post);

                $query = "DELETE FROM comments WHERE comment_post_id = {$select_post_id}";
                $delete_post_comments = mysqli_query($connection, $query);
                checkQuery($delete_post_comments);
    
                 
                break;
            case 'clone':


                $query = "SELECT * FROM posts WHERE post_id = {$select_post_id}";
                $select_posts =mysqli_query($connection,$query);

                while ($row=mysqli_fetch_assoc($select_posts)){
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,200);
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = date('d-m-y');
                $post_status = $row['post_status'];
            
            }

                $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, 
                post_image, post_content, post_tags, post_status)
                VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(),
                '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";


                $clone_posts = mysqli_query($connection,$query);

                checkQuery($clone_posts);
            
                break;
        }
    }



}




?>
<form action="" method="post">
<table class="table table-bordered table-hover">

    <div id="bulkOptionContainer" class="col-xs-4">
    
    <select name="bulk_option" class="form-control">

    <option value="">-- Select an option --</option>
    <option value="publish">Publish</option>
    <option value="draft">Draft</option>
    <option value="deny">Deny</option>
    <option value="delete">Delete</option>
    <option value="clone">Clone</option>
    
    </select>
        
    </div>

    <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a href="posts.php?source=add_post" class="btn btn-primary">Add Post</a>
    </div>

    <thead>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Category</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Comment Count</th>
        <th>View Count</th>
        <th>Date</th>
        <th>Status</th>
        <!--<th><a href="posts.php?source=add_post"></i></a></th>-->
        <th class="text-center">
            Actions
            <!-- <form method="get" action="">
                <button class="btn btn-light btn-sm" type="submit" name="source" value="add_post"><i class="fa fa-plus"></i></button>
            </form> -->
        </th>
    </thead>
    <tbody> 
<?php 

if(isadmin()){
    if(isset($_GET['author'])){
        $author = escape($_GET['author']);

        $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_image,
        posts.post_content, posts.post_tags, posts.post_view_count, posts.post_date, posts.post_status,
        categories.cat_id, categories.cat_title  
        FROM posts
        LEFT JOIN categories ON posts.post_category_id = categories.cat_id  
        WHERE post_author = '{$author}' ORDER BY post_id DESC";

    }else if(isset($_GET['category'])){

        $category = escape($_GET['category']);
        
        $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_image,
        posts.post_content, posts.post_tags, posts.post_view_count, posts.post_date, posts.post_status,
        categories.cat_id, categories.cat_title  
        FROM posts
        LEFT JOIN categories ON posts.post_category_id = categories.cat_id  
        WHERE post_category_id = '{$category}' ORDER BY post_id DESC";
  
    }else{

    $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_image,
    posts.post_content, posts.post_tags, posts.post_view_count, posts.post_date, posts.post_status,
    categories.cat_id, categories.cat_title  
    FROM posts
    LEFT JOIN categories ON posts.post_category_id = categories.cat_id";   
    
    }
}else{
    $username = escape($_SESSION['username']);

    if(isset($_GET['category'])){

        $category = escape($_GET['category']);
        
        $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_image,
        posts.post_content, posts.post_tags, posts.post_view_count, posts.post_date, posts.post_status,
        categories.cat_id, categories.cat_title      
        FROM posts
        LEFT JOIN categories ON posts.post_category_id = categories.cat_id  
        WHERE posts.post_category_id = '{$category}' && posts.post_author = '{$username}' ORDER BY post_id DESC";
  
    }else{

    $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_image,
    posts.post_content, posts.post_tags, posts.post_view_count, posts.post_date, posts.post_status,
    categories.cat_id, categories.cat_title    
    FROM posts
    LEFT JOIN categories ON posts.post_category_id = categories.cat_id
    WHERE posts.post_author = '{$username}' ORDER BY post_id DESC";
    }


}
    $all_posts =mysqli_query($connection,$query);
    checkQuery($all_posts);

    while ($row=mysqli_fetch_assoc($all_posts)){
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'],0,200);
        $post_tags = $row['post_tags'];

        $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
        $counter = mysqli_query($connection, $query);
        $post_comment_count = mysqli_num_rows($counter);
        
        $post_view_count = $row['post_view_count'];
        $post_date = $row['post_date'];
        $post_status = $row['post_status'];

        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
       ?>
        <tr>
        <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $post_id;?>"></td>
       <?php
        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_id}</a></td>
        <td><a href='posts.php?category={$cat_id}'>{$cat_title}</a></td>
        <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
        <td><a href='posts.php?author={$post_author}'>{$post_author}</a></td>
        <td><img width='100' src='../images/$post_image' alt='$post_image'></td>
        <td>{$post_content}</td>";
        echo "<td>{$post_tags}</td>
        <td><a href='comments.php?p_id={$post_id}'>{$post_comment_count}</a></td>
        <td>{$post_view_count}</td>
        <td>{$post_date}</td>
        <td>{$post_status}</td>";      
?>      
        <td class='text-center'>  
            <?php //if(isset($author)) {$author_get = "&author=".$author;} ?>
            <!-- <button class='btn btn-light btn-sm' type='button' onclick="location.href='posts.php?delete=<?php // echo $post_id; if(isset($author)){echo $author_get;} ?>'; javascript: return confirm('are u sure want to delete <?php //echo $post_title; ?>');"><i class='fa fa-trash'></i></button> -->
            <a class='btn btn-light btn-sm delete_link' auth="<?php if(isset($author)){echo '&author=' . $author;} ?>" rel="<?php echo $post_id; ?>" href="javascript:void(0)"><i class='fa fa-trash'></i></a>
            <button class='btn btn-light btn-sm' type='button' onclick="location.href='posts.php?source=edit_post&edit=<?php echo $post_id; ?>';"><i class='fa fa-edit'></i></button>
            <button class='btn btn-light btn-sm' type='button' onclick="location.href='../post.php?p_id=<?php echo $post_id; ?>';"><i class='fa fa-arrow-right'></i></button>
        </td>
        </tr>    
<?php    } ?>    

    </tbody>
</table>
</form>



<?php 
    if (isset($_GET['delete']) && $_SESSION['role'] == 'admin'){
        $delete_post_id = escape($_GET['delete']);

        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
        $delete_post = mysqli_query($connection,$query);

        checkQuery($delete_post);
        if(isset($author)){
        header("Location: posts.php?author={$author}"); 
        }else{
        header("Location: posts.php"); 
        }
    }


?>

<script>

    $(document).ready(function(){
        
        $(".delete_link").on('click', function(){

            var id = $(this).attr("rel");
            var author = $(this).attr("auth");

            var delete_url = "posts.php?delete="+ id + author + " ";


            $(".modal_delete_link").attr("href", delete_url);

            $("#mymodal").modal('show');


        }); 

    });


</script>