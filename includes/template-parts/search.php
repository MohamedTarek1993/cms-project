<?php 

// if(isset($_POST['submit'])){
//    $search = $_POST['search'];


//        // query for search
//        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
//        $search_query = mysqli_query($connection , $query);

//        if(!$search_query){
//            die('query failed' . mysqli_error($connection));
//        }

//        $count = mysqli_num_rows($search_query);
//        if($count == 0){
//            echo 'no result';
//        }else{
//            echo $count . 'result found';
//        }
       

// }

?>

<form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>