<?php 


// add comment function
function addComment($post_id){
    global  $connection ; 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $comment_post_id = $post_id;
        $comment_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
        $comment_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $comment_content = htmlspecialchars(trim($_POST['comment']), ENT_QUOTES);
        $comment_date = date('Y-m-d');;
        $commebt_status = 'unapproved';
        // validate fields
        if(empty($comment_author) || empty($comment_email) || empty($comment_content)){
            echo "<p class='text-danger'>Field must not be empty</p>";
        }
        elseif(!filter_var($comment_email, FILTER_VALIDATE_EMAIL)){
            echo "<p class='text-danger'>Invalid email</p>";
        }
        elseif(strlen($comment_content) < 10){
            echo "<p class='text-danger'>Comment must be at least 10 characters</p>";
        }
        else{
       
        $query = "INSERT INTO comments(comment_post_id ,comment_author, comment_email, comment_content , comment_status, comment_date) VALUES('$comment_post_id', '$comment_author', '$comment_email', '$comment_content' , 'unapproved', '$comment_date')";
        $result = mysqli_query($connection , $query);
    
        if(!$result){
            die('query failed' . mysqli_error($connection));
        }
        else{
           echo "<script> alert('Comment Added') </script>" ;
        }
       
    }
    }
    ?>
<form role="form" method="post">
    <div class="form-group">
        <label for=""> Add Author </label>
        <input type="text" name="author" class="form-control">
    </div>
    <div class="form-group">
        <label for=""> Add Email </label>
        <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for=""> Add Comment </label>
        <textarea name="comment" class="form-control" rows="3"></textarea>
    </div>
    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
</form>

<?php 
}


//SHOW COMMENTS ON POST
function showCommentPost($comment_post_id){
    global  $connection ; 
//selecting all categories in navmenu
$query = "SELECT * FROM comments WHERE comment_post_id = '$comment_post_id' AND comment_status = 'Approved' ORDER BY comment_id DESC";
$select_all_comments = mysqli_query($connection , $query);
if(!$select_all_comments){
    die('query failed' . mysqli_error($connection));
}

while($comment_post = mysqli_fetch_assoc($select_all_comments)) : ?>

<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"> <?php echo $comment_post['comment_author']; ?>
            <small><?php echo $comment_post['comment_date']; ?></small>
        </h4>
        <?php echo $comment_post['comment_content']; ?>
    </div>
</div>
<?php endwhile; 
}