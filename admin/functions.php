<?php 

//SHOW ALL CATEGORIES

function showAllCategories(){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM category ";
$select_all_categories = mysqli_query($connection , $query);
if(!$select_all_categories){
    die('query failed' . mysqli_error($connection));
}

while($all_categories = mysqli_fetch_assoc($select_all_categories)) : ?>
<tr>
    <td><?php echo $all_categories['cat_id']; ?></td>
    <td><?php echo $all_categories['cat_title']; ?></td>
    <td><a href="show.php?delete=<?php echo $all_categories['cat_id']; ?>" class="btn btn-danger">Delete
    </td>
    <td>
        <a href="edit.php?edit=<?php echo $all_categories['cat_id'];?>"> Update </a>
    </td>
</tr>
<?php endwhile; 
}


//DELETE CATEGORY 

function deleteCategory()  {

    global  $connection ;

    
    
if(isset($_GET['delete'])){

    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM category WHERE cat_id = $the_cat_id";
    $result = mysqli_query($connection , $query);
    if(!$result){
        die('query failed' . mysqli_error($connection));
    }
    else{
        echo '<script>alert("Category Deleted")</script>' ;
    }
    
}

}