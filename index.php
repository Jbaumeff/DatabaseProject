<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

$userName = $user->getFullName();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <?php echo "<title>$userName</title>"; ?>
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
            ?>
        </div>
    </div>

</body>
</html>