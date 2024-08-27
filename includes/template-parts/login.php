<?php 

?>

<form action="login.php" method="post">
    <div class="form-group">
        <input name="user_name" type="text" class="form-control">
    </div>

    <div class="input-group">
        <input name="user_password" type="password" class="form-control">
        <span class="input-group-btn">
            <button name="login" class="btn btn-default" type="submit">
                <span> Login</span>
            </button>
        </span>
    </div>
</form>