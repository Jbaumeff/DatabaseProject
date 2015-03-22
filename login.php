<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="mystyle.css" type="text/css" rel="stylesheet" />
</head>
<body>
<!-- Header and navigation -->

<div class="loginForm">
    <form method="post" action="./post/login-post.php">
        <p><label for="userNameLabel">Username</label></p>
        <p><input type="text" name="userName" id="userName"></p>
        <p><label for="passwordLabel">Password</label></p>
        <p><input type="text" name="password" id="password"></p>
        <p>
            <input class="buttonForm" type="submit" name="login" value="Login">
            <input class="buttonForm" type="submit" name="create" value="New User">
        </p>
    </form>
</div>
</body>
</html>