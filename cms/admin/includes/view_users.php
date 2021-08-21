<table class="table table-bordered table-hover">
    <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Image</th>
        <th>Role</th>
        <th>Change Role</th>
        <!--<th><a href="users.php?source=add_user"><i class="fa fa-plus"></i></a></th>-->
        <th class="text-center">
            <form method="get" action="">
                <button class="btn btn-light btn-sm" type="submit" name="source" value="add_user"><i class="fa fa-plus"></i></button>
            </form>
        </th>
    </thead>
    <tbody>
<?php 
    $query = "SELECT * FROM users";
    $all_users =mysqli_query($connection,$query);

    while ($row=mysqli_fetch_assoc($all_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
       
        echo "<tr>
        <td>{$user_id}</td>
        <td>{$username}</td>
        <td>{$user_firstname}</td>
        <td>{$user_lastname}</td>
        <td>{$user_email}</td>
        <td><img width='100' src='../images/$user_image' alt='$user_image'></td>
        <td>{$user_role}</td>
        <td><a href='users.php?admin={$user_id}'>Admin</a> / <a href='users.php?sub={$user_id}'>Subscriber</a></td>";      
?>      
        <td class='text-center'>  
            <button class='btn btn-light btn-sm' type='button' onclick="location.href='users.php?delete=<?php echo $user_id; ?>';" ><i class='fa fa-trash'></i></button>
            <button class='btn btn-light btn-sm' type='button' onclick="location.href='users.php?source=edit_user&edit=<?php echo $user_id; ?>';"><i class='fa fa-edit'></i></button>
        </td>
        </tr>    
<?php    } ?>    

    </tbody>
</table>




<?php 
    if (isset($_GET['delete']) && $_SESSION['role'] == 'admin'){
        $delete_user_id = escape($_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
        $delete_user = mysqli_query($connection,$query);

        checkQuery($delete_user);
        header("Location: users.php"); 

    }

    if (isset($_GET['admin']) && $_SESSION['role'] == 'admin'){
        $admin_user_id = escape($_GET['admin']);

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$admin_user_id}";
        $admin_user = mysqli_query($connection,$query);

        checkQuery($admin_user);
        header("Location: users.php"); 

    }

    if (isset($_GET['sub']) && $_SESSION['role'] == 'admin'){
        $sub_user_id = escape($_GET['sub']);

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$sub_user_id}";
        $sub_user = mysqli_query($connection,$query);

        checkQuery($sub_user);
        header("Location: users.php"); 

    }


?>