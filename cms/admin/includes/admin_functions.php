<?php

function usersOnline(){

    if(isset($_GET['onlineusers'])){
        global $connection;

    if (!$connection){
        session_start();
        include "../../includes/db.php";
   
    $session = session_id();
    $time = time();
    $timeout_seconds = 05 ;
    $timeout = $time + $timeout_seconds;

    $query = "SELECT * FROM users_online WHERE session = '{$session}'";
    $find_session = mysqli_query($connection, $query);
    $count = mysqli_num_rows($find_session);

    if($count == 0){
        $query = "INSERT INTO users_online (session, time) VALUES ('{$session}', {$time})";
        $session_timer = mysqli_query($connection, $query);
    }else{
        $query = "UPDATE users_online SET time = {$time} WHERE session = '{$session}'";
        $session_timer = mysqli_query($connection, $query);
    }
    
    $query = "SELECT * FROM users_online  WHERE time < {$timeout}";
    $find_online_users = mysqli_query($connection, $query);
   echo $users_online = mysqli_num_rows($find_online_users);
        }
    }   
}
usersOnline();

function checkQuery($result){
    global $connection;

    if(!$result){
                
        die("query failed" . mysqli_error($connection) . "  " . mysqli_errno($connection));
        
    }   
}

function show_categories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $all_cat =mysqli_query($connection,$query);

    while ($row=mysqli_fetch_assoc($all_cat)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "
        <tr>
        <td>{$cat_id}</td>
        <td>{$cat_title}</td>
        <td>
        <form method='get' action=''>
            <button class='btn btn-light btn-sm' type='submit' name='delete' value='{$cat_id}'><i class='fa fa-trash'></i></button>
        |
            <button class='btn btn-light btn-sm' type='submit' name='edit' value='{$cat_id}'><i class='fa fa-edit'></i></button>
        </form>
        </td>
        </tr>" ;
    }
}

function add_category(){
    global $connection;

    if (isset($_POST['submit'])){
        $cat_title= escape($_POST['cat_title']);
        
        if ($cat_title == "" || empty($cat_title)){
            
            echo "<b>*this field cannot be empty</b>";
            
            
            
        }else{
            $query= "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
            $add_category =mysqli_query($connection,$query);
            
            checkQuery($add_category);
        }
    }
}

function delete_category(){
    global $connection;
    
    if(isset($_GET['delete']) && $_SESSION['user_role'] == 'admin'){
        $delete_cat_id = escape($_GET ['delete']);
        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
        $delete_cat = mysqli_query($connection,$query);
        checkQuery($delete_cat);
        header("Location: categories.php");
    }
}

function update_category(){
    global $connection;
    global $edit_cat_id;

    if (isset($_GET['edit'])){
        include "includes/update_cat_form.php";
    
        if (isset($_POST['edit'])){
            $cat_title=escape($_POST['cat_title']);


            if ($cat_title == "" || empty($cat_title)){
            
                echo "<b>*this field cannot be empty</b>";
                
                
                
            }else{
                $query= "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$edit_cat_id}';";
                $edit_category =mysqli_query($connection,$query);
                
                checkQuery($edit_category);
                header("Location: categories.php");    
            }
        }
    }
}
// for widgets count (old one)[DONT USE IT!!!]
function table_row_count($table){
    global $connection;
    global ${$table.'_count'};

    $query="SELECT * FROM $table";
    $select_all_table = mysqli_query($connection,$query);
    ${$table.'_count'} = mysqli_num_rows($select_all_table);        

    echo "{${$table.'_count'}}";
}

// table row counter with optional status check on a collumn
function table_status_count($table, $collumn = NULL, $status = NULL){
    global $connection;
        if($collumn == NULL || $status == NULL){
            $query="SELECT * FROM $table";
            $result = mysqli_query($connection,$query);
            return mysqli_num_rows($result);
        }else{
            $query="SELECT * FROM $table WHERE $collumn = '$status'";
            $result = mysqli_query($connection,$query); 
            return mysqli_num_rows($result);
        }
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