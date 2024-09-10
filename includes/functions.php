<?php 

/**
 * Escapes a string to be used in a SQL query, removing HTML tags and
 * trimming whitespace from the ends. This is the minimum amount of
 * sanitization required to prevent an SQL injection attack.
 *
 * @param string $string The string to be escaped.
 * @return string The sanitized string.
 */
function escape($string){
    global $connection ;
   return  mysqli_real_escape_string($connection , trim(strip_tags($string))) ;
}


// add comment function
/**
 * Adds a comment to the database.
 *
 * @param int $post_id The ID of the post to which the comment belongs.
 *
 * @return string The message to be displayed on the form if the comment was not
 *     added successfully.
 */
function addComment($post_id){

    $messa_comment = '';

    global  $connection ; 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $comment_post_id = $post_id;
        $comment_author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
        $comment_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $comment_content = htmlspecialchars(trim($_POST['comment']), ENT_QUOTES);
        $comment_date = date('Y-m-d');;
        $commebt_status = 'unapproved';
        // validate fields
         // Validate the form inputs
            if (empty($comment_author) || empty($comment_email) || empty($comment_content)) {
                $messa_comment = "Fields must not be empty.";
            } elseif (!filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
                $messa_comment = "Invalid email format.";
            } elseif (strlen($comment_content) < 10) {
                $messa_comment = "Comment is too short.";
            }   else{
       
        $query = "INSERT INTO comments(comment_post_id ,comment_author, comment_email, comment_content , comment_status, comment_date) VALUES('$comment_post_id', '$comment_author', '$comment_email', '$comment_content' , 'unapproved', '$comment_date')";
        $result = mysqli_query($connection , $query);
    
        if(!$result){
            die('query failed' . mysqli_error($connection));

        }
        else{
        //    echo "<script> alert('Comment Added') </script>" ;
           header("Location: " . $_SERVER['PHP_SELF'] . "?post_id=$post_id");
           exit();
        }
       
    }

    }
    return $messa_comment; // Return the message to be displayed on the form

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