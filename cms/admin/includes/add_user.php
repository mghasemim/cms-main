<?php 
if (isset($_POST['add_user'])){

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp,"../images/$user_image");

    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);
    $enc_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 10]);
    $user_email = escape($_POST['user_email']);
    $user_role = escape($_POST['user_role']);


    $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, 
    user_email, user_image, user_role)
    VALUES ('{$username}', '{$enc_password}', '{$user_firstname}',
     '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}') ";


    $add_users = mysqli_query($connection,$query);
    
    checkQuery($add_users);
    header("Location: users.php");
}


?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="Firstname">First Name</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>


    <div class="form-group">
        <label for="userimage">Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="role">User Role</label><br>
        <select name="user_role" class="form-control">
            <option value="subscriber">--Select a Role--</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_user" value="Add User">  
    <button class="btn btn-outline-primary" onclick="location.href='users.php';" type="button">Cancel</button>
    </div>

</form>