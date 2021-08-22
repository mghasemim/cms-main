<?php
if(isset($_SESSION['id'])){
        
    $edit_profile_id = escape($_SESSION['id']);

    $query = "SELECT * FROM users WHERE user_id = {$edit_profile_id}";
    $update_profile_data =mysqli_query($connection,$query);

    while ($row=mysqli_fetch_assoc($update_profile_data)){
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}
?>

<?php 
if (isset($_POST['update_profile'])){

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    
    $user_image = escape($_FILES['user_image']['name']);
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp,"../images/$user_image");
    if(empty($user_image)){

        $query = "SELECT * FROM users WHERE user_id = {$edit_profile_id}";
        $old_image = mysqli_query($connection,$query);

        while ($row = mysqli_fetch_assoc($old_image)) {
            $user_image = $row['user_image'];
        }
    }

    $user_email = escape($_POST['user_email']);
    $username = escape($_POST['username']);

    $user_password = escape($_POST['user_password']);
    if(!empty($user_password)){
        $query = "SELECT user_password FROM users WHERE user_id = {$edit_profile_id}";
        $find_password = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($find_password);
        $db_user_password = $row['user_password'];

        if($db_user_password != $user_password){
            $enc_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 10]);
        }else {
            $enc_password = $db_user_password;
        }
     

        $query = "UPDATE users SET username = '{$username}', user_password = '{$enc_password}', user_firstname = '{$user_firstname}',
        user_lastname = '{$user_lastname}', user_email ='{$user_email}', user_image = '{$user_image}' WHERE user_id = {$edit_profile_id}";


        $update_profile = mysqli_query($connection,$query);
        
        checkQuery($update_profile);
        header("Location: /demo/cms/admin/profile");
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="Firstname">First Name</label>
        <input type="text" name="user_firstname" value="<?php  echo $user_firstname; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" name="user_lastname" value="<?php  echo $user_lastname; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="userimage">Image</label><br>
        <img width="100" src="../images/<?php  echo $user_image; ?>" alt="<?php echo $user_image; ?>">
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php  echo $username; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input autocomplete="off" type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="user_email" value="<?php  echo $user_email; ?>" class="form-control">
    </div>

   
    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">  
    <button class="btn btn-outline-primary" onclick="location.href='/demo/cms/admin/profile';" type="button">Cancel</button>
    </div>

</form>