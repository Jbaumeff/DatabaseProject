<?php
require 'lib/site.inc.php';

$view = new ProfileView($site, $user, $_REQUEST);

$editMode = false;
if(isset($_POST['edit'])) {
    $editMode = true;
}

$fullName = $user->getFullName();
$privacy = $user->getPrivacy();


?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <?php echo "<title>$fullName</title>"; ?>
</head>
<body>
    <?php
        echo Format::displayNavigationBar();
    ?>

    <div class="main">
        <div class="left">
            <?php
                echo $view->presentPendingFriends($user->getIdUser());
                echo $view->presentAcceptedFriends($user->getIdUser());
                echo $view->presentPendingCollabs($user->getIdUser());
            ?>
        </div>

        <div class="right">
            <?php
                if($editMode) {
                    echo $view->presentEditableAbout();
                } else {
                    echo $view->presentAbout($user->getIdUser());
                }
            ?>
        </div>
    </div>


</body>
</html>