<?php 
?>

<form action="includes/login.php" method="post">
    <div class="form-group">
        <label for="user_name">Username:</label>
        <input name="user_name" type="text" class="form-control" id="user_name" placeholder="Enter your username"
            required>
    </div>

    <div class="form-group">
        <label for="user_password">Password:</label>
        <input name="user_password" type="password" class="form-control" id="user_password"
            placeholder="Enter your password" required>
    </div>

    <div class="input-group">
        <span class="input-group-btn">
            <button name="login" class="btn btn-default" type="submit">
                <span>Login</span>
            </button>
        </span>
    </div>
</form>