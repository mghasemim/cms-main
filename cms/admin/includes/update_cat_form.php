<?php
$edit_cat_id = escape($_GET ['edit']);

$query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";
$all_cat =mysqli_query($connection,$query);

while ($row=mysqli_fetch_assoc($all_cat)){
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title']; 
?>
<form action="" method="post">

<div class="form-group">
        <label for="cat_title">Edit a Category</label>   
                <input value="<?php if (isset($cat_title)){ echo $cat_title; }?>" type="text" class="form-control" name="cat_title" placeholder="Category Name">
</div>

<div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit" value="Update">
        <button class="btn btn-outline-primary" onclick="location.href='/demo/cms/admin/categories';" type="button">Cancel</button>
</div>
</form>
<?php } ?>   