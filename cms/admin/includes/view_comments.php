<?php 
if(isset($_POST['checkBoxArray'])){

    foreach ($_POST['checkBoxArray'] as $select_comment_id) {
        $bulk_option = $_POST['bulk_option'];
        $select_comment_id = escape($select_comment_id);
        // $query = "SELECT comment_post_id FROM comments WHERE comment_id = {$select_comment_id}";
        // $find_post_id = mysqli_query($connection,$query);
        // $row=mysqli_fetch_assoc($find_post_id);
        // $p_id = $row['comment_post_id'];
             
        switch ($bulk_option) {
            case 'approved':

                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$select_comment_id}";
                $approve_comment = mysqli_query($connection,$query);
        
                checkQuery($approve_comment);
                
                break;

            case 'unapproved':

                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$select_comment_id}";
                $unapprove_comment = mysqli_query($connection,$query);
        
                checkQuery($unapprove_comment);
                   
                break;
            case 'delete':
                

                $query = "DELETE FROM comments WHERE comment_id = {$select_comment_id}";
                $delete_comment = mysqli_query($connection,$query);
                checkQuery($delete_comment);
                
                
                // $query = "UPDATE posts SET post_comment_count = post_comment_count - 1
                // WHERE post_id = $p_id ";
                // $delete_comment_counter = mysqli_query($connection,$query);
                // checkQuery($delete_comment_counter);
                 
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
    <option value="approved">Approve</option>
    <option value="unapproved">Unapprove</option>
    <option value="delete">Delete</option>
    </select>
        
    </div>

    <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    </div>




    <thead>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Post Name</th>
        <th>Author</th>
        <th>Email</th>
        <th>Content</th>
        <th>Status</th>
        <th>Date</th>
    </thead>
    <tbody>
<?php
if(isadmin()){
    if(isset($_GET['p_id'])){
        $p_id = escape($_GET['p_id']);
        $query = "SELECT comments.comment_id, comments.comment_post_id, comments.comment_author, comments.comment_email,
        comments.comment_content, comments.comment_status, comments.comment_date, posts.post_id, posts.post_title
        FROM comments 
        LEFT JOIN posts ON comments.comment_post_id = posts.post_id
        WHERE comments.comment_post_id = $p_id";
        
    }else{
        $query = "SELECT comments.comment_id, comments.comment_post_id, comments.comment_author, comments.comment_email,
         comments.comment_content, comments.comment_status, comments.comment_date, posts.post_id, posts.post_title
         FROM comments 
         LEFT JOIN posts ON comments.comment_post_id = posts.post_id";
        
        
    }
}else{
    $username = escape($_SESSION['username']);
    if(isset($_GET['p_id'])){
        $p_id = escape($_GET['p_id']);
        $query = "SELECT comments.comment_id, comments.comment_post_id, comments.comment_author, comments.comment_email,
        comments.comment_content, comments.comment_status, comments.comment_date, posts.post_id, posts.post_title, posts.post_author   
        FROM comments 
        LEFT JOIN posts ON comments.comment_post_id = posts.post_id
        WHERE comments.comment_post_id = $p_id && posts.post_author = {$username}";
        
    }else{
        $query = "SELECT comments.comment_id, comments.comment_post_id, comments.comment_author, comments.comment_email,
         comments.comment_content, comments.comment_status, comments.comment_date, posts.post_id, posts.post_title, posts.post_author
         FROM comments 
         LEFT JOIN posts ON comments.comment_post_id = posts.post_id
         WHERE posts.post_author = {$username}";
    }
}
    $all_comments = mysqli_query($connection,$query);
    checkQuery($all_comments);
    while ($row=mysqli_fetch_assoc($all_comments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = substr($row['comment_content'],0,200);
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];

        echo "<tr>"; ?>


        <td><input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="<?php echo $comment_id;?>"></td>
        
        

        <?php
        echo "<td>{$comment_id}</td>
        <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
        <td>{$comment_author}</td>
        <td>{$comment_email}</td>
        <td>{$comment_content}</td>
        <td>{$comment_status}</td>
        <td>{$comment_date}</td>";  
    }
?>      

   

    </tbody>
</table>
</form>
