<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <title>RICHARD IS LAME</title>
</head>
<body>
    <?php
        echo Format::displayNavigationBar();
    ?>

    <div class="main">
        <div class="left">
            <?php
                echo $view->presentPendingFriends();
                echo $view->presentAcceptedFriends();
            ?>
        </div>
    </div>

</body>
</html>