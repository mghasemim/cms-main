<?php 
    




#for connecting to database

function Connection(){   
    global $con;
    $con= mysqli_connect ('localhost','root','','loginapp');

    if ($con) {
        
        echo  "<h1>Succesfully Connected to Database </h1>";}
    else {
        die ('<h1>database not connected </h1>' ); }
} 

#for query all datas from the table "users"

function QuerryAll(){
    global $con;
    global $result;
    $query="SELECT * FROM users" ;
        
    $result = mysqli_query($con,$query);
        if ($result) {
            echo  "<h2>Querry ALL Succesfull </h2>"; 
        }else {
            die ("<h2>Querry ALL Unsuccesfull </h2>" . mysqli_error($con));
        }
}

#for insert username and password in  table "users"
function InsertData(){

    global $con;
    global $result;
    
    $username= $_POST ['username'];
    $password= $_POST ['password'];
    
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $hashform = "$2y$11$";
    $salt = "ilovewowidontcareyoudont";
    $hash_n_salt = $hashform . $salt ;

    $password = crypt($password , $hash_n_salt);
   

    $query="INSERT INTO users ( Username , Password )
    VALUES ('$username', '$password') " ;

    $result = mysqli_query($con,$query);
        if ($result) {
            echo  "<h2>Signed Up </h2>"; 
        }else {
           die ("<h2>Data Insert Failed </h2>" . mysqli_error($con));
        }
}

#for updating datas in table "users"
    
function UpdateTable(){

    global $con;
    global $result;

    $username= $_POST ['username'];
    $password= $_POST ['password'];
    $id = $_POST ['id'];

    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $hashform = "$2y$11$";
    $salt = "ilovewowidontcareyoudont";
    $hash_n_salt = $hashform . $salt ;
    

    $query="UPDATE users 
    SET Username = '$username' , 
    Password = '$password' 
    WHERE ID = $id " ;

    $result = mysqli_query($con,$query);
    if ($result) {
        echo  "<h2>Succesfully Updated </h2>"; 
    }else {
    die ("<h2>Data Update Failed </h2>" . mysqli_error($con));
    }
} 

#fetches IDs for updating datas 

function FetchID () {

    global $result;
    
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row ['ID'];
        echo "<option value = '$id'>$id<option>";


    } 
}


#for deleting datas in table "users"
    
function DeleteRow (){

    global $con;
    global $result;

    
    $id = $_POST ['id'];
    

    $query="DELETE FROM users 
    WHERE ID = $id " ;

    $result = mysqli_query($con,$query);
    if ($result) {
        echo  "<h2>Succesfully Deleted </h2>"; 
    }else {
    die ("<h2>Data Delete Failed </h2>" . mysqli_error($con));
    }
} 



















?>