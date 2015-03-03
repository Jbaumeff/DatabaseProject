<?php
    require "lib/format.inc.php";
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <title>Database Project</title>
</head>
<body>
    <?php
        echo displayNavigationBar();
    ?>

    <div class="loginForm">
        <form method="post" action="post-login.php">
            <p><label for="userNameLabel">Username</label></p>
            <p><input type="text" name="userName" id="userName"</p>
            <p><label for="passwordLabel">Password</label></p>
            <p><input type="text" name="password" id="password"</p>
            <p><input class="buttonForm" type="submit" name="login" value="Login"</p>
        </form>
    </div>
</body>
</html>