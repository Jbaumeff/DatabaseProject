<?php
require 'lib/site.inc.php';

//$view = new UserView($site, $user, $_REQUEST);

$idUser = $user->getIdUser();
$fullName = $user->getFullName();
$emailAddress = $user->getEmailAddress();
$birthYear = $user->getBirthYear();
$hometownCity = $user->getHometownCity();
$hometownState = $user->getHometownState();
$privacy = $user->getPrivacy();

$title = "<title>$fullName</title>";


?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <?php echo $title; ?>
</head>
<body>
    <?php
        echo Format::displayNavigationBar();
    ?>

    <div class="main">
        <div class="left">
            <div class="friends">
                <h1>Friends</h1>
            </div>
        </div>

        <div class="right">
            <div class="profile">
                <?php
                echo "<h1>$fullName - ( $idUser )</h1>";
                echo "<h2>Email: $emailAddress";
                echo "<h3>Born in $birthYear</h3>";
                echo "<h3>From $hometownCity, $hometownState</h3>";
                ?>
            </div>
        </div>
    </div>


</body>
</html>