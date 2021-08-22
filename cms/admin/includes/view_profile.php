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

    
        <label for="Firstname">First Name:</label>
        <?php  echo $user_firstname; ?>
        <hr>

    
        <label for="lastname">Last Name:</label>
        <?php  echo $user_lastname; ?>
        <hr>

   
        <label for="userimage">Image:</label><br>
        <img width="100" src="../images/<?php  echo $user_image; ?>" alt="<?php echo $user_image; ?>">
        <hr>

    
        <label for="username">Username:</label>
       <?php  echo $username; ?>
       <hr>

    
        <label for="email">Email:</label>
        <?php  echo $user_email; ?>
        <hr>

    
        <label for="role">Role:</label>
        <?php echo $user_role;?>
        <hr>

   
    
    <button class="btn btn-primary" onclick="location.href='/demo/cms/admin/profile/edit_profile';" type="button">Edit Profile</button>
  

