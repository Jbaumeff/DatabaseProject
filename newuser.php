<?php
$login = true;
require 'lib/site.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css" media="screen" />
</head>
<body>
    <div class="newUserForm">
        <form>
            <p>User Name *<input type="text" name="user" id="user"></p>
            <p>Password *<input type="password" name="password" id="password"></p>
            <p>Full Name *<input type="text" name="fullName" id="fullName"></p>
            <p>Email Address *<input type="text" name="email" id="email"></p>
            <p>Address *<input type="text" name="address" id="address"></p>
            <p>Birth Year *<input type="text" name="dob" id="dob"></p>
            <p>City and State *<input type="text" name="city" id="city"> <input type="text" name="state" id="state"></p>
            <p>Interests *<input type="text" name="interests"></p>
            <p>Privacy Setting *<input type="text" name="privacy" id="privacy"></p>
            <p><input class="buttonForm" type="submit"></p>
        </form>
    </div>
</body>
</html>