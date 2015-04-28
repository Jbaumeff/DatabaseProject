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

<?php
if(isset($_REQUEST['error'])){
    $error = $_REQUEST['error'];
    $message = '';

    if($error == 0){
        $message = "<p id=\"error\" class=\"center\">Missing information.</p>";
    }elseif($error == 1){
        $message =  "<p id=\"error\" class=\"center\">User already exists.</p>";
    }elseif($error == 2){
        $message =  "<p id=\"error\" class=\"center\">Email must contain an @ sign.</p>";
    }elseif($error == 3){
        $message =  "<p id=\"error\" class=\"center\">Birth year is invalid.</p>";
    }elseif($error == 4){
        $message =  "<p id=\"error\" class=\"center\">The password must be 8 characters or longer.</p>";
    }

}
?>
    <?php echo $message; ?>
    <div class="newUserForm">

        <form method="post" action="./post/new-post.php">
            <p>User Name *<input type="text" name="userName" id="userName"></p>
            <p>Password *<input type="password" name="password" id="password"></p>
            <p>Full Name *<input type="text" name="fullName" id="fullName"></p>
            <p>Email Address *<input type="text" name="email" id="email"></p>
            <p>Birth Year *<input type="text" name="dob" id="dob"></p>
            <p>City and State *<input type="text" name="city" id="city"> <input type="text" name="state" id="state"></p>
            <p>Interests (separate by commas) *<input type="text" name="interests" id="interests"></p>
            <p class="privacySelect">Privacy Setting *
            <select name="privacy" id="privacy">
                <option value="">Select...</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select></p>

            <p><input class="buttonForm" type="submit"></p>
        </form>
    </div>
</body>
</html>